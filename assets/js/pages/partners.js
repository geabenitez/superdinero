new Vue({
  el: '#app',
  created() {
    const headers = { 'token-crf': cs }

    const getPartners = () => {
      return axios(this.createHeader('GET'))
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
      }))
  },
  data: function () {
    return {
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
        amounts: []
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
    savePartner({ id, nameES, nameEN, categories, rate, states, onlyAgent, characteristicsES, characteristicsEN, amounts }) {
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

            const formData = new FormData();
            formData.append("nameES", nameES);
            formData.append("nameEN", nameEN);
            formData.append("categories", categories);
            formData.append("rate", rate);
            formData.append("states", states);
            formData.append("onlyAgent", onlyAgent);
            formData.append("characteristicsES", characteristicsES);
            formData.append("characteristicsEN", characteristicsEN);
            formData.append("amounts", amounts);
            axios(this.createHeader(METHOD, formData, categoryId, true))
              .then(res => {
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
  }
})