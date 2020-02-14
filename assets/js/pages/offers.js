new Vue({
  el: '#app',
  data: function () {
    return {
      showSettings: false,
      rating: 4.8,
      spanishLang: false,
      form: {
        state: "",
        category: ""
      },
      states: [],
      categories: []
    }
  },
})