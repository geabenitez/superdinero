new Vue({
  el: '#app',
  created() {
    const headers = { 'token-crf': cs }

    const getCategories = () => {
      return axios({ headers, method: 'GET', url: `${site_url}categories` })
    }

    const getCredits = () => {
      return axios({ headers, method: 'GET', url: `${site_url}credits` })
    }

    const getDocuments = () => {
      return axios({ headers, method: 'GET', url: `${site_url}documents` })
    }

    const getRecords = () => {
      return axios({ headers, method: 'GET', url: `${site_url}records` })
    }

    const getMethods = () => {
      return axios({ headers, method: 'GET', url: `${site_url}methods` })
    }

    const getStates = () => {
      return axios({ headers, method: 'GET', url: `${site_url}states` })
    }

    axios
      .all([getCategories(), getCredits(), getDocuments(), getRecords(), getStates(), getMethods()])
      .then(axios.spread((categories, credits, documents, records, states, paymentOptions) => {
        this.credits = credits.data
        this.rawCategories = categories.data
        this.credit = { minAmount: 0, maxAmount: 0 }
        this.documents = documents.data
        this.records = records.data
        this.states = states.data
        this.paymentOptions = paymentOptions.data
        this.loading = false
      }))
  },
  data: function () {
    return {
      questionNumber: 1,
      spanishLang: true,
      credits: {},
      credit: {},
      categories: [],
      rawCategories: [],
      documents: [],
      records: [],
      states: [],
      generatedCode: null,
      marks: { 1: 0, 100: 100 },
      paymentOptions: [],
      questions: {
        1: {
          nameES: '¿Qué tipo de prestamos necesitas?',
          nameEN: 'What kind of credit do you need?',
          field: 'credit'
        },
        2: {
          nameES: '¿Qué cantidad necesitas?',
          nameEN: 'how much do you need?',
          field: 'amount'
        },
        3: {
          nameES: '¿Para qué lo necesita?',
          nameEN: 'What do you need it for?',
          field: 'category'
        },
        4: {
          nameES: '¿Qué tipo de documento tiene?',
          nameEN: 'What typenumber of document do you have?',
          field: 'document'
        },
        5: {
          nameES: 'Aproximado puntaje de crédito',
          nameEN: 'Approximate credit score',
          field: 'record'
        },
        6: {
          nameES: '¿En qué estado se encuentra?',
          nameEN: 'What state are you in?',
          field: 'state'
        },
        7: {
          nameES: '¿Posee auto propio o arrendado?',
          nameEN: 'Do you own or lease your car?',
          field: 'has_car'
        },
        8: {
          nameES: '¿Posee casa propia o arrendada?',
          nameEN: 'Do you own or lease a house?',
          field: 'has_house'
        },
        9: {
          nameES: '¿Cuanto gana mensualmente?',
          nameEN: 'how much are your monthly earnings?',
          field: 'earnings'
        },
        10: {
          nameES: '¿Como te pagan?',
          nameEN: 'how do you get paid?',
          field: 'payform'
        }
      },
      aditionalQuestions: [],
      responses: {
        names: '',
        lastnames: '',
        email: '',
        phone: '',
        amount: 0,
        credit: '',
        category: '',
        document: '',
        record: '',
        state: '',
        has_car: '',
        has_house: '',
        earnings: '',
        payform: ''
      },
      loading: true
    }
  },
  methods: {
    createHeader(METHOD, data, id = '') {
      return {
        method: METHOD,
        headers: { 'token-crf': cs },
        url: `${site_url}codes/${id}?fr=nodial`,
        data
      }
    },
    calculatePorcentage(number) {
      return parseInt(number * (100 / this.totalQuestions))
    },
    formatTooltip(val) {
      return this.formatMoney(Math.ceil(this.calcValue(val)))
    },
    calcValue(val) {
      return val == 1 ? this.credit.minAmount : (val * (this.credit.maxAmount) / 100)
    },
    formatMoney(amount) {
      return new Intl.NumberFormat("en-US", { style: "currency", currency: "USD" }).format(amount)
    },
    next(questionNumber) {
      if (this.responses[this.questions[questionNumber].field] === '') {
        this.$notify.error({
          title: 'Error',
          message: 'Se necesita contestar la pregunta'
        });
        return false
      }
      if (questionNumber >= 1 && questionNumber < this.totalQuestions) {
        this.questionNumber++
      }
    },
    prev(questionNumber) {
      if (questionNumber <= this.totalQuestions && questionNumber > 1) {
        this.questionNumber--
      }
    },
    changeCredit(id) {
      const credit = this.credits.find(d => d.id == id)
      this.marks = {
        1: this.formatMoney(credit.minAmount),
        100: this.formatMoney(credit.maxAmount)
      }
      this.categories = credit.categories.map(id => {
        const nameEN = this.rawCategories.find(c => c.id === id).nameEN
        const nameES = this.rawCategories.find(c => c.id === id).nameES
        return {
          id,
          nameEN,
          nameES
        }
      })
      this.aditionalQuestions = this.credits.filter(d => d.askAlways == 1 && d.id !== id)
      this.credit = credit
    },
    getCategories(credit) {
      return credit.categories.map(id => {
        const nameEN = this.rawCategories.find(c => c.id === id).nameEN
        const nameES = this.rawCategories.find(c => c.id === id).nameES
        return {
          id,
          nameEN,
          nameES
        }
      })
    },
    generate(responses) {
      // Check last response to be answered
      if (this.responses[this.questions[Object.keys(this.questions).slice(-1)[0]].field] === '') {
        this.$notify.error({
          title: 'Error',
          message: 'Se necesita contestar la pregunta'
        });
        return false
      }

      // Verifica que l informacion de contacto exista
      if (responses.names == '' || responses.lastnames == '' || responses.email == '' || responses.phone == '') {
        this.$notify.error({
          title: 'Error',
          message: 'Debes completar la informacion de contacto primero'
        });
        return false
      }
      this.$msgbox({
        type: 'warning',
        title: 'Confirmation',
        message: `Are you sure you want to generate a code?`,
        showCancelButton: true,
        confirmButtonText: "Yes, please",
        cancelButtonText: 'Cancel',
        beforeClose: (action, instance, done) => {
          if (action === 'confirm') {
            instance.confirmButtonLoading = true;
            instance.confirmButtonText = 'Processing...';
            axios(this.createHeader('POST', { configuracion: responses }))
              .then(res => {
                this.$notify({
                  title: res.data.success ? 'SUCCESS' : 'ERROR',
                  message: res.data.msj,
                  type: res.data.success ? 'success' : 'error',
                });
                instance.confirmButtonLoading = false;
                instance.confirmButtonText = "Yes, please";
                this.generatedCode = res.data.code
                done()
              })
              .catch(err => {
                this.$notify({
                  title: 'ERROR',
                  message: 'Your session has expired.',
                  type: 'error',
                });
                setTimeout(() => {
                  location.reload()
                }, 1000);
              })
          } else {
            done();
          }
        }
      })
    },
    reload() {
      location.reload()
    }
  },
  computed: {
    totalQuestions() {
      return Object.keys(this.questions).length + this.aditionalQuestions.length
    },
    sortedStates() {
      return this.states.sort((a, b) => {
        if (a.nameES < b.nameES) return -1
        if (b.nameES < a.nameES) return 1
        return 0
      })
    }
  }
})
