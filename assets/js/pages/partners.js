new Vue({
  el: '#app',
  data: function () {
    return {
      partners: [
        {
          nameES: 'Nombre en español',
          nameEN: 'Name in english',
          states: new Array(13).fill(''),
          onlyAgent: true,
          categories: new Array(4).fill(''),
          rate: 4.25,
          active: true
        },
        {
          nameES: 'Segundo nombre de asociado',
          nameEN: 'Second associate name',
          states: new Array(25).fill(''),
          onlyAgent: true,
          categories: new Array(6).fill(''),
          rate: 3.5,
          active: false
        }
      ],
      searchValue: '',
      showNewPartner: false,
      newAsociateForm: {
        nameES: '',
        nameEN: '',
        categories: [],
        rate: 0,
        states: [],
        onlyAgent: false
      }
    }
  }
})