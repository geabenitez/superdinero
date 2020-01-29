new Vue({
  el: '#app',
  created() {
    axios(this.createHeader('GET'))
      .then(res => {
        this.categories = res.data
      })
  },
  data: function () {
    return {
      action: 'Nueva categoria',
      headers: {},
      categories: [],
      searchValue: '',
      showNewCategory: false,
      newCategoryForm: {
        nameES: '',
        nameEN: '',
      }
    }
  },
  methods: {
    editCategory(category) {
      this.action = 'Editar categoria'
      this.newCategoryForm = {
        ...category
      }
      this.showNewCategory = true
    },
    createHeader(METHOD, data, id = '') {
      return {
        method: METHOD,
        headers: { 'token-crf': cs },
        url: `${site_url}categories/${id}`,
        data
      }
    },
    saveCategory({ nameES, nameEN, id }) {
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
        message: `Are you sure you want to ${id != null ? 'update' : 'save'} this category?`,
        showCancelButton: true,
        confirmButtonText: "Yes, please",
        cancelButtonText: 'Cancel',
        beforeClose: (action, instance, done) => {
          if (action === 'confirm') {
            instance.confirmButtonLoading = true;
            instance.confirmButtonText = 'Processing...';
            const METHOD = id != null ? 'PUT' : 'POST'
            const categoryId = id != null ? id : ''
            axios(this.createHeader(METHOD, { nameES, nameEN, active: 1 }, categoryId))
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
                this.categories = res.data.categories
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
    deleteCategory(id) {
      this.$msgbox({
        type: 'error',
        title: 'Confirmation',
        message: 'Are you sure you want to delete this category?',
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
                this.categories = res.data.categories
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
      const value = this.searchValue.toLowerCase()
      return this.categories.filter(c => (
        c.nameES.toLowerCase().includes(value) ||
        c.nameEN.toLowerCase().includes(value)
      ))
    }
  }
})