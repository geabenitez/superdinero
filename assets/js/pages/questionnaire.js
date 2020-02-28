new Vue({
  el: '#app',
  created() {
    const slug = window.location.pathname.split('cuestionario/')[1]
    this.slug = slug
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

    const getStates = () => {
      return axios({ headers, method: 'GET', url: `${site_url}states` })
    }

    axios
      .all([getCategories(), getCredits(), getDocuments(), getRecords(), getStates()])
      .then(axios.spread((categories, credits, documents, records, states) => {
        this.credit = credits.data.find(d => d.slug == slug)
        this.categories = this.credit.categories.map(id => {
          const nameEN = categories.data.find(c => c.id === id).nameEN
          const nameES = categories.data.find(c => c.id === id).nameES
          return {
            id,
            nameEN,
            nameES
          }
        })
        this.documents = documents.data
        this.records = records.data
        this.states = states.data
        this.marks = {
          1: this.formatMoney(this.credit.minAmount),
          100: this.formatMoney(this.credit.maxAmount)
        }
        this.loading = false
      }))
  },
  data: function () {
    return {
      slug: '',
      questionNumber: 1,
      spanishLang: true,
      credit: {},
      categories: [],
      documents: [],
      records: [],
      states: [],
      value: 1,
      marks: {},
      paymentOptions: [
        {
          nameEN: 'Direct deposit',
          nameES: 'Deposito directo'
        },
        {
          nameEN: 'Check',
          nameES: 'Cheque'
        },
        {
          nameEN: 'Cash',
          nameES: 'Efectivo'
        },
        {
          nameEN: "I don't have earnings",
          nameES: 'No tengo ingresos'
        }
      ],
      questions: {
        1: {
          nameES: '¿Qué cantidad necesitas?',
          nameEN: 'how much do you need?'
        },
        2: {
          nameES: '¿Para qué lo necesita?',
          nameEN: 'What do you need it for?'
        },
        3: {
          nameES: '¿Qué tipo de documento tiene?',
          nameEN: 'What type of document do you have?'
        },
        4: {
          nameES: 'Aproximado puntaje de crédito',
          nameEN: 'Approximate credit score'
        },
        5: {
          nameES: '¿En qué estado se encuentra?',
          nameEN: 'What state are you in?'
        },
        6: {
          nameES: '¿Posee auto propio o arrendado?',
          nameEN: 'Do you own or lease your car?'
        },
        7: {
          nameES: '¿Posee casa propia o arrendada?',
          nameEN: 'Do you own or lease a house?'
        },
        8: {
          nameES: '¿Cuanto gana mensualmente?',
          nameEN: 'how much are your monthly earnings?'
        },
        9: {
          nameES: '¿Como te pagan?',
          nameEN: 'how do you get paid?'
        }
      },
      responses: {
        amount: 0,
        category: '',
        document: '',
        record: '',
        state: '',
        has_car: '',
        has_house: '',
        earnings: '',
        payform: ''
      },
      loading: true,
      totalQuestions: 9
    }
  },
  methods: {
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
      if (questionNumber >= 1 && questionNumber <= 10) {
        this.questionNumber++
      }
    },
    prev(questionNumber) {
      if (questionNumber <= 10 && questionNumber > 1) {
        this.questionNumber--
      }
    }
  },
  computed: {
    uri() {
      location.href = `${site_url}ofertas/${this.slug}?d=${btoa(JSON.stringify(this.responses))}`
    }
  }
})