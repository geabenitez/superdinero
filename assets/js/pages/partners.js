new Vue({
  el: '#app',
  data: function () {
    return {
      partners: [
        {
          index: 1,
          nameES: 'Nombre en español',
          nameEN: 'Name in english',
          states: new Array(13).fill(''),
          onlyAgent: true,
          categories: new Array(4).fill(''),
          rate: '4.25',
          active: true,
          characteristics: new Array(4).fill(''),
          amounts: new Array(4).fill(''),
        },
        {
          index: 2,
          nameES: 'Segundo nombre de asociado',
          nameEN: 'Second associate name',
          states: new Array(25).fill(''),
          onlyAgent: true,
          categories: new Array(6).fill(''),
          rate: '3.50',
          active: false,
          characteristics: new Array(4).fill(''),
          amounts: new Array(4).fill(''),
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
        onlyAgent: false,
        characteristicsES: ["", "", "", ""],
        characteristicsEN: ["", "", "", ""],
        amounts: ["", "", "", ""]
      }
    }
  }
})