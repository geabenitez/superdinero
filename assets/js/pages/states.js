new Vue({
  el: '#app',
  data: function () {
    return {
      states: [
        {
          index: 1,
          nameES: 'Nombre en español',
          nameEN: 'Name in english',
          active: true,
        },
        {
          index: 2,
          nameES: 'Segundo nombre de asociado',
          nameEN: 'Second associate name',
          active: false,
        }
      ],
      searchValue: '',
      showNewState: false,
      newStateForm: {
        nameES: '',
        nameEN: '',
      }
    }
  }
})