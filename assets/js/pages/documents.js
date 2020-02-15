new Vue({
  el: '#app',
  created() {
    axios(this.createHeader('GET'))
      .then(res => {
        this.documents = res.data
      })
  },
  data: function () {
    return {
      action: 'Nuevo documento',
      documents: [],
      searchValue: '',
      showNewDocument: false,
      newDocumentForm: {
        nameES: '',
        nameEN: '',
      }
    }
  },
  methods: {
    createDocument() {
      this.action = 'Nuevo documento'
      this.newDocumentForm = {
        nameES: '',
        nameEN: '',
      }
      this.showNewDocument = true
    },
    editDocument(document) {
      this.action = 'Editar documento'
      this.newDocumentForm = {
        ...document
      }
      this.showNewDocument = true
    },
    createHeader(METHOD, data, id = '') {
      return {
        method: METHOD,
        headers: { 'token-crf': cs },
        url: `${site_url}documents/${id}`,
        data
      }
    },
    saveDocument({ nameES, nameEN, id }) {
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
        message: `Are you sure you want to ${id != null ? 'update' : 'save'} this document?`,
        showCancelButton: true,
        confirmButtonText: "Yes, please",
        cancelButtonText: 'Cancel',
        beforeClose: (action, instance, done) => {
          if (action === 'confirm') {
            instance.confirmButtonLoading = true;
            instance.confirmButtonText = 'Processing...';
            const METHOD = id != null ? 'PUT' : 'POST'
            const documentId = id != null ? id : ''
            axios(this.createHeader(METHOD, { nameES, nameEN, active: 1 }, documentId))
              .then(res => {
                this.documents = res.data.documents
                instance.confirmButtonLoading = false;
                instance.confirmButtonText = "Yes, please";
                this.showNewDocument = false
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
                this.documents = res.data.documents
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
    deleteDocument(id) {
      this.$msgbox({
        type: 'error',
        title: 'Confirmation',
        message: 'Are you sure you want to delete this document?',
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
                this.documents = res.data.documents
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
    filteredDocuments() {
      const value = this.searchValue.toLowerCase()
      return this.documents.filter(c => (
        c.nameES.toLowerCase().includes(value) ||
        c.nameEN.toLowerCase().includes(value)
      ))
    }
  }
})