new Vue({
  el: '#app',
  created() {
    const headers = { 'token-crf': cs }

    const getPartners = () => {
      return axios({ headers, method: 'GET', url: `${site_url}partners` })
    }

    const getDocuments = () => {
      return axios({ headers, method: 'GET', url: `${site_url}documents` })
    }

    const getCategories = () => {
      return axios({ headers, method: 'GET', url: `${site_url}categories` })
    }

    const getCredits = () => {
      return axios({ headers, method: 'GET', url: `${site_url}credits` })
    }

    const getAmounts = () => {
      return axios({ headers, method: 'GET', url: `${site_url}amounts` })
    }

    const getStates = () => {
      return axios({ headers, method: 'GET', url: `${site_url}states` })
    }

    const getRecords = () => {
      return axios({ headers, method: 'GET', url: `${site_url}records` })
    }

    axios
      .all([getPartners(), getDocuments(), getCategories(), getCredits(), getAmounts(), getStates(), getRecords()])
      .then(axios.spread((partners, documents, categories, credits, amounts, states, records) => {
        this.partners = partners.data
        this.documents = documents.data
        this.categories = categories.data
        this.credits = credits.data
        this.amounts = amounts.data
        this.states = states.data
        this.records = records.data
        this.loading = false
      }))
  },
  data: function () {
    return {
      loading: true,
      partners: [],
      searchValue: '',
      showNewPartner: false,
      categories: [],
      credits: [],
      amounts: [],
      documents: [],
      states: [],
      records: [],
      newAsociateForm: {
        nameES: '',
        nameEN: '',
        documents: [],
        credits: [],
        categories: [],
        records: [],
        rate: 0,
        states: [],
        onlyAgent: false,
        requiresCar: false,
        requiresHouse: false,
        characteristicsES: ["", "", "", ""],
        characteristicsEN: ["", "", "", ""],
        amounts: [],
        url: ''
      },
      action: 'Nuevo asociado'
    }
  },
  methods: {
    createHeader(METHOD, data, id = '', multipart = false) {
      const headers = { 'token-crf': cs }
      if (multipart) {
        headers['Content-Type'] = 'multipart/form-data'
      }
      return {
        method: METHOD,
        headers,
        url: `${site_url}partners/${id}`,
        data
      }
    },
    formatMoney(amount) {
      return new Intl.NumberFormat("en-US", { style: "currency", currency: "USD", maximumSignificantDigits: 2 }).format(amount)
    },
    createPartner() {
      this.action = 'Nuevo asociado'
      this.newAsociateForm = {
        nameES: '',
        nameEN: '',
        documents: [],
        credits: [],
        categories: [],
        records: [],
        rate: 0,
        states: [],
        onlyAgent: false,
        requiresCar: false,
        requiresHouse: false,
        characteristicsES: ["", "", "", ""],
        characteristicsEN: ["", "", "", ""],
        amounts: []
      }
      this.showNewPartner = true
    },
    savePartner({
      id,
      nameES,
      nameEN,
      documents,
      credits,
      categories,
      records,
      rate,
      states,
      onlyAgent,
      requiresCar,
      requiresHouse,
      characteristicsES,
      characteristicsEN,
      amounts,
      url
    }) {
      if (
        nameES == '' ||
        nameEN == '' ||
        categories.length == 0 ||
        states.length == 0 ||
        amounts.length == 0
      ) {
        this.$notify.error({
          title: 'Error',
          message: 'All fields are required.'
        });
        return false
      }
      this.$msgbox({
        type: 'warning',
        title: 'Confirmation',
        message: `Are you sure you want to ${id != null ? 'update' : 'save'} this partner?`,
        showCancelButton: true,
        confirmButtonText: "Yes, please",
        cancelButtonText: 'Cancel',
        beforeClose: (action, instance, done) => {
          if (action === 'confirm') {
            instance.confirmButtonLoading = true;
            instance.confirmButtonText = 'Processing...';
            const METHOD = id != null ? 'PUT' : 'POST'
            const categoryId = id != null ? id : ''

            const formData = {
              nameES,
              nameEN,
              documents,
              credits,
              categories,
              records,
              rate,
              states,
              onlyAgent,
              requiresCar,
              requiresHouse,
              characteristicsES,
              characteristicsEN,
              amounts,
              url,
              active: 1
            }
            axios(this.createHeader(METHOD, formData, categoryId, true))
              .then(res => {
                this.$notify({
                  title: res.data.success ? 'SUCCESS' : 'ERROR',
                  message: res.data.msj,
                  type: res.data.success ? 'success' : 'error',
                });
                this.partners = res.data.partners
                instance.confirmButtonLoading = false;
                instance.confirmButtonText = "Yes, please";
                this.showNewPartner = false
                done()
              })
          } else {
            done();
          }
        }
      })
    },
    changeStatus(id, status) {
      this.$msgbox({
        type: 'warning',
        title: 'Confirmation',
        message: 'Are you sure you want to change the status?',
        showCancelButton: true,
        confirmButtonText: "Let's go",
        cancelButtonText: 'Cancel',
        beforeClose: (action, instance, done) => {
          if (action === 'confirm') {
            instance.confirmButtonLoading = true;
            instance.confirmButtonText = 'Processing...';
            const active = status == '1'
            axios(this.createHeader('PUT', { active: !active }, id))
              .then(res => {
                this.$notify({
                  title: res.data.success ? 'SUCCESS' : 'ERROR',
                  message: res.data.msj,
                  type: res.data.success ? 'success' : 'error',
                });
                this.partners = res.data.partners
                instance.confirmButtonLoading = false;
                instance.confirmButtonText = "Let's go";
                done()
              })
          } else {
            done();
          }
        }
      })
    },
    deletePartner(id) {
      this.$msgbox({
        type: 'error',
        title: 'Confirmation',
        message: 'Are you sure you want to delete this partner?',
        showCancelButton: true,
        confirmButtonText: "DELETE",
        cancelButtonText: 'Cancel',
        beforeClose: (action, instance, done) => {
          if (action === 'confirm') {
            instance.confirmButtonLoading = true;
            instance.confirmButtonText = 'Processing...';
            axios(this.createHeader('DELETE', {}, id))
              .then(res => {
                this.$notify({
                  title: res.data.success ? 'SUCCESS' : 'ERROR',
                  message: res.data.msj,
                  type: res.data.success ? 'success' : 'error',
                });
                this.partners = res.data.partners
                instance.confirmButtonLoading = false;
                instance.confirmButtonText = "DELETE";
                done()
              })
          } else {
            done();
          }
        }
      })
    }
  },
  computed: {
    filteredCategories() {
      const filtered = this.newAsociateForm.credits
        .map(id => this.credits.find(credit => credit.id === id))
        .map(credit => {
          const categories = credit.categories.map(id => this.categories.find(category => (category.id === id && category.active === '1')))
          return {
            ...credit,
            categories
          }
        })
      console.log(filtered)
      return filtered
    }
  }
})