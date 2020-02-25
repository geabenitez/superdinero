new Vue({
  el: '#app',
  data: function () {
    return {
      questionNumber: 1,
      spanishLang: false,
      questions: {
        1: {
          nameES: '¿Qué cantidad necesitas?',
          nameEN: 'how much do you need?'
        }
      }
    }
  }
})