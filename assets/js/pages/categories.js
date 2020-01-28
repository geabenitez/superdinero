new Vue({
  el: '#app',
  created() {
    axios
      .get(`${site_url}categories`)
      .then(res => {
        this.categories = res.data
      })
  },
  data: function () {
    return {
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
    saveCategory({ nameES, nameEN }) {
      this.$msgbox({
        type: 'warning',
        title: 'Confirmation',
        message: 'Are you sure you want to save this new category?',
        showCancelButton: true,
        confirmButtonText: "Yes, please",
        cancelButtonText: 'Cancel',
        beforeClose: (action, instance, done) => {
          if (action === 'confirm') {
            instance.confirmButtonLoading = true;
            instance.confirmButtonText = 'Processing...';
            axios
              .post(`${site_url}categories`, { nameES, nameEN, active: 1 })
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
            axios
              .put(`${site_url}categories/${id}`, { active: !active })
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
      console.log('test')
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
            axios
              .delete(`${site_url}categories/${id}`)
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
  }
})