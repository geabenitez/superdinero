new Vue({
  el: '#app',
  created() {
    axios(this.createHeader('GET'))
      .then(res => {
        this.categories = res.data
      })
  },
  data() {
    return {
      action: 'Nueva categoria',
      categories: [],
      searchValue: '',
      showNewCategory: false,
      newCategoryForm: {
        nameES: '',
        nameEN: '',
        image: ''
      }
    }
  },
  methods: {
    createCategory() {
      this.action = 'Nueva categoria'
      this.newCategoryForm = {
        nameES: '',
        nameEN: '',
      }
      if (this.$refs.imagePreview) {
        this.$refs.imagePreview.src = 'https://via.placeholder.com/250'
      }
      this.showNewCategory = true
    },
    editCategory(category) {
      this.action = 'Editar categoria'
      this.newCategoryForm = {
        ...category
      }
      this.showNewCategory = true
      setTimeout(() => {
        this.$refs.imagePreview.src = `${site_url}/assets/images/categories/${category.image}`
      }, 300);
    },
    createHeader(METHOD, data, id = '', multipart = false) {
      const headers = { 'token-crf': cs }
      if (multipart) {
        headers['Content-Type'] = `multipart/form-data; boundary=${data._boundary}`
      }
      return {
        method: METHOD,
        headers,
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

            const formData = new FormData();
            formData.append("image", this.$refs.image.files[0]);
            formData.append("nameES", nameES);
            formData.append("nameEN", nameEN);
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
    },
    beforeUpload() {
      const files = this.$refs.image.files
      if (files && files[0]) {
        if ((files[0].size / 1000) > 200) {
          this.$notify.error({
            title: 'Error',
            message: 'The image needs to be less than 500KB.'
          });
          this.$refs.image.value = ''
          return false
        }
        const reader = new FileReader()
        reader.onload = (e) => {
          this.newCategoryForm.image = e.target.result
          this.$refs.imagePreview.src = e.target.result
        }
        reader.readAsDataURL(files[0]);
      }
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