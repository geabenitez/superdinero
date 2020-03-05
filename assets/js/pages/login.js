new Vue({
  el: '#app',
  data: function () {
    return {
      email: 'admin@superdinero.com',
      password: '123456'
    }
  },
  methods: {
    processLogin(email, password) {
      axios
        .post(`${site_url}process_login`, { email, password })
        .then(function(res){

          if (res.data.result.success) {
            console.log('entre');
            
            window.location=`${site_url}admin/generator`;
          }else{
            console.log('no entre');
          }
          
          
        })
    }
  }
})