new Vue({
  el: '#app',
  created() {
    axios(this.createHeader('GET'))
      .then(res => {
        this.records = res.data
        this.loading = false
      })
  },
  data: function () {
    return {
      action: 'Nuevo record',
      records: [],
      searchValue: '',
      loading: true,
      showNewRecord: false,
      newRecordForm: {
        nameES: '',
        nameEN: '',
      }
    }
  },
  methods: {
    createRecord() {
      this.action = 'Nuevo record'
      this.newRecordForm = {
        nameES: '',
        nameEN: '',
      }
      this.showNewRecord = true
    },
    editRecord(record) {
      this.action = 'Editar record'
      this.newRecordForm = {
        ...record
      }
      this.showNewRecord = true
    },
    createHeader(METHOD, data, id = '') {
      return {
        method: METHOD,
        headers: { 'token-crf': cs },
        url: `${site_url}records/${id}`,
        data
      }
    },
    saveRecord({ nameES, nameEN, id }) {
      if (nameES == '' || nameEN == '') {
        this.$notify.error({
          title: 'Error',
          message: 'All fields are required.'
        });
        return false
      }
      this.$msgbox({
        type: 'warning',
        title: 'Confirmation',
        message: `Are you sure you want to ${id != null ? 'update' : 'save'} this record?`,
        showCancelButton: true,
        confirmButtonText: "Yes, please",
        cancelButtonText: 'Cancel',
        beforeClose: (action, instance, done) => {
          if (action === 'confirm') {
            instance.confirmButtonLoading = true;
            instance.confirmButtonText = 'Processing...';
            const METHOD = id != null ? 'PUT' : 'POST'
            const recordId = id != null ? id : ''
            axios(this.createHeader(METHOD, { nameES, nameEN, active: 1 }, recordId))
              .then(res => {
                this.$notify({
                  title: res.data.success ? 'SUCCESS' : 'ERROR',
                  message: res.data.msj,
                  type: res.data.success ? 'success' : 'error',
                });
                this.records = res.data.records
                instance.confirmButtonLoading = false;
                instance.confirmButtonText = "Yes, please";
                this.showNewRecord = false
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
                this.records = res.data.records
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
    deleteRecord(id) {
      this.$msgbox({
        type: 'error',
        title: 'Confirmation',
        message: 'Are you sure you want to delete this record?',
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
                this.records = res.data.records
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
    filteredRecords() {
      const value = this.searchValue.toLowerCase()
      return this.records.filter(c => (
        c.nameES.toLowerCase().includes(value) ||
        c.nameEN.toLowerCase().includes(value)
      ))
    }
  }
})