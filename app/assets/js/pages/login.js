new Vue({
  el: '#app',
  data: function () {
    return {
      email: '',
      password: ''
    }
  },
  methods: {
    processLogin(email, password) {
      axios
        .post(`${site_url}process_login`, { email, password })
        .then(function (res) {

          if (res.data.result.success) {
            console.log('entre');

            window.location = `${site_url}admin/generator`;
          } else {
            console.log('no entre');
          }


        })
    }
  }
})