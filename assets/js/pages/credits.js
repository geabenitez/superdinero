new Vue({
  el: '#app',
  created() {
    const headers = { 'token-crf': cs }

    const getCredits = () => {
      return axios({ headers, method: 'GET', url: `${site_url}credits` })
    }

    const getCategories = () => {
      return axios({ headers, method: 'GET', url: `${site_url}categories` })
    }

    axios
      .all([getCredits(), getCategories()])
      .then(axios.spread((credits, categories) => {
        this.credits = credits.data
        this.categories = categories.data
        this.loading = false
      }))
  },
  data: function () {
    return {
      action: 'Nuevo credito',
      credits: [],
      searchValue: '',
      showNewCredit: false,
      categories: [],
      newCreditForm: {
        nameES: '',
        nameEN: '',
        maxAmount: '',
        categories: []
      },
      loading: true
    }
  },
  methods: {
    createCredit() {
      this.action = 'Nuevo credito'
      this.newCreditForm = {
        nameES: '',
        nameEN: '',
        maxAmount: '',
        categories: []
      }
      this.showNewCredit = true
    },
    editCredit(state) {
      this.action = 'Editar credito'
      this.newCreditForm = {
        ...state
      }
      this.showNewCredit = true
    },
    createHeader(METHOD, data, id = '') {
      return {
        method: METHOD,
        headers: { 'token-crf': cs },
        url: `${site_url}credits/${id}`,
        data
      }
    },
    saveCredit({ nameES, nameEN, categories, maxAmount, id }) {
      if (nameES == '' || nameEN == '' || categories.length == 0 || parseFloat(maxAmount) <= 0) {
        this.$notify.error({
          title: 'Error',
          message: 'All fields are required.'
        });
        return false
      }
      this.$msgbox({
        type: 'warning',
        title: 'Confirmation',
        message: `Are you sure you want to ${id != null ? 'update' : 'save'} this credit?`,
        showCancelButton: true,
        confirmButtonText: "Yes, please",
        cancelButtonText: 'Cancel',
        beforeClose: (action, instance, done) => {
          if (action === 'confirm') {
            instance.confirmButtonLoading = true;
            instance.confirmButtonText = 'Processing...';
            const METHOD = id != null ? 'PUT' : 'POST'
            const stateId = id != null ? id : ''
            axios(this.createHeader(METHOD, { nameES, nameEN, categories, maxAmount, active: 1 }, stateId))
              .then(res => {
                this.$notify({
                  title: res.data.success ? 'SUCCESS' : 'ERROR',
                  message: res.data.msj,
                  type: res.data.success ? 'success' : 'error',
                });
                this.credits = res.data.credits
                instance.confirmButtonLoading = false;
                instance.confirmButtonText = "Yes, please";
                this.showNewCredit = false
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
                this.credits = res.data.credits
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
    deleteCredit(id) {
      this.$msgbox({
        type: 'error',
        title: 'Confirmation',
        message: 'Are you sure you want to delete this state?',
        showCancelButton: true,
        confirmButtonText: "DELETE",
        cancelButtonText: 'Cancel',
        beforeClose: (action, instance, done) => {
          if (action === 'confirm') {
            instance.confirmButtonLoading = true;
            instance.confirmButtonText = 'Processing...';
            const active = status == '1'
            axios(this.createHeader('DELETE', {}, id))
              .then(res => {
                this.$notify({
                  title: res.data.success ? 'SUCCESS' : 'ERROR',
                  message: res.data.msj,
                  type: res.data.success ? 'success' : 'error',
                });
                this.credits = res.data.credits
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
    filteredCredits() {
      const value = this.searchValue.toLowerCase()
      return this.credits.filter(c => (
        c.nameES.toLowerCase().includes(value) ||
        c.nameEN.toLowerCase().includes(value)
      ))
    }
  }
})