new Vue({
  el: '#app',
  created() {
    axios(this.createHeader('GET'))
      .then(res => {
        this.amounts = res.data
      })
  },
  data: function () {
    return {
      action: 'Nueva cantidad',
      amounts: [],
      searchValue: '',
      showNewAmount: false,
      newAmountForm: {
        from: '',
        until: '',
      }
    }
  },
  methods: {
    createAmount() {
      this.action = 'Nueva cantidad'
      this.newAmountForm = {
        from: '',
        until: '',
      }
      this.showNewAmount = true
    },
    editAmount(amount) {
      console.log(amount)
      this.action = 'Editar cantidad'
      this.newAmountForm = {
        ...amount
      }
      this.showNewAmount = true
    },
    createHeader(METHOD, data, id = '') {
      return {
        method: METHOD,
        headers: { 'token-crf': cs },
        url: `${site_url}amounts/${id}`,
        data
      }
    },
    saveAmount({ from, until, id }) {
      if (from == '' || until == '') {
        this.$notify.error({
          title: 'Error',
          message: 'All fields are required.'
        });
        return false
      }
      this.$msgbox({
        type: 'warning',
        title: 'Confirmation',
        message: `Are you sure you want to ${id != null ? 'update' : 'save'} this amount?`,
        showCancelButton: true,
        confirmButtonText: "Yes, please",
        cancelButtonText: 'Cancel',
        beforeClose: (action, instance, done) => {
          if (action === 'confirm') {
            instance.confirmButtonLoading = true;
            instance.confirmButtonText = 'Processing...';
            const METHOD = id != null ? 'PUT' : 'POST'
            const amountId = id != null ? id : ''
            axios(this.createHeader(METHOD, { from, until, active: 1 }, amountId))
              .then(res => {
                this.amounts = res.data.amounts
                instance.confirmButtonLoading = false;
                instance.confirmButtonText = "Yes, please";
                this.showNewAmount = false
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
                this.amounts = res.data.amounts
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
    deleteAmount(id) {
      this.$msgbox({
        type: 'error',
        title: 'Confirmation',
        message: 'Are you sure you want to delete this amount?',
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
                this.amounts = res.data.amounts
                instance.confirmButtonLoading = false;
                instance.confirmButtonText = "DELETE";
                done()
              })
          } else {
            done();
          }
        }
      })
    },
    formatMoney(amount) {
      return new Intl.NumberFormat("en-US", { style: "currency", currency: "USD", maximumSignificantDigits: 2 }).format(amount)
    }
  },
  computed: {
    filteredAmounts() {
      const value = this.searchValue.toLowerCase()
      return this.amounts
        .filter(c => (
          c.from.toLowerCase().includes(value) ||
          c.until.toLowerCase().includes(value)
        ))
    }
  }
})