new Vue({
  el: '#app',
  created() {
    const headers = { 'token-crf': cs }
    function getCategories() {
      return axios({ headers, method: 'GET', url: `${site_url}categories` })
    }

    function getAmounts() {
      return axios({ headers, method: 'GET', url: `${site_url}amounts` })
    }

    function getStates() {
      return axios({ headers, method: 'GET', url: `${site_url}states` })
    }

    axios
      .all([getCategories(), getAmounts(), getStates()])
      .then(axios.spread((categories, amounts, states) => {
        this.categories = categories.data
        this.amounts = amounts.data
        this.states = states.data
        console.log(this.categories)
      }))
  },
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
      categories: [],
      amounts: [],
      states: [],
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
  },
  methods: {
    formatMoney(amount) {
      return new Intl.NumberFormat("en-US", { style: "currency", currency: "USD", maximumSignificantDigits: 2 }).format(amount)
    }
  }
})