new Vue({
  el: '#app',
  created() {
    const headers = { 'token-crf': cs }
    function getCategories() {
      return axios({ headers, method: 'GET', url: `${site_url}categories` })
    }

    function getAmounts() {
      return axios({ headers, method: 'GET', url: `${site_url}amounts` })
    }

    function getStates() {
      return axios({ headers, method: 'GET', url: `${site_url}states` })
    }

    axios
      .all([getCategories(), getAmounts(), getStates()])
      .then(axios.spread((categories, amounts, states) => {
        this.categories = categories.data
        this.amounts = amounts.data
        this.states = states.data
        console.log(this.categories)
      }))
  },
  data: function () {
    return {
      partners: [],
      searchValue: '',
      showNewPartner: false,
      categories: [],
      amounts: [],
      states: [],
      newAsociateForm: {
        nameES: '',
        nameEN: '',
        categories: [],
        rate: 0,
        states: [],
        onlyAgent: false,
        characteristicsES: ["", "", "", ""],
        characteristicsEN: ["", "", "", ""],
        amounts: []
      }
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
                this.categories = res.data.categories
                instance.confirmButtonLoading = false;
                instance.confirmButtonText = "Yes, please";
                this.showNewCategory = false
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