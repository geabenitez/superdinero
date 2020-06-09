const app = new Vue({
  el: '#app',
  created() {
    const slug = window.location.pathname.split('ofertas/')[1]
    const query = JSON.parse(atob(location.search.split('?d=')[1]))
    this.agent = query.agent
    this.slug = slug
    this.query = JSON.parse(query.data)
    this.originalQuery = JSON.parse(query.data)
    const headers = { 'token-crf': cs }
    const getCategories = () => axios({ headers, method: 'GET', url: `${site_url}categories` })
    const getCredits = () => axios({ headers, method: 'GET', url: `${site_url}credits` })
    const getDocuments = () => axios({ headers, method: 'GET', url: `${site_url}documents` })
    const getRecords = () => axios({ headers, method: 'GET', url: `${site_url}records` })
    const getStates = () => axios({ headers, method: 'GET', url: `${site_url}states` })
    const getPartners = () => axios({ headers, method: 'GET', url: `${site_url}partners` })
    const getMethods = () => axios({ headers, method: 'GET', url: `${site_url}methods` })

    axios
      .all([getCategories(), getCredits(), getDocuments(), getRecords(), getStates(), getPartners(), getMethods()])
      .then(axios.spread((categories, credits, documents, records, states, partners, methods) => {
        this.credit = credits.data.find(d => d.slug == slug)
        this.categories = this.credit.categories.map(id => {
          const nameEN = categories.data.find(c => c.id === id).nameEN
          const nameES = categories.data.find(c => c.id === id).nameES
          return {
            id,
            nameEN,
            nameES
          }
        })
        this.documents = documents.data
        this.records = records.data
        this.states = states.data
        this.methods = methods.data
        this.partners = partners.data
        setTimeout(() => {
          this.toRender = true
          this.loading = false
        }, 1000);
      }))
  },
  data: function () {
    return {
      toRender: false,
      advancedOptions: false,
      slug: '',
      loading: true,
      showSettings: false,
      spanishLang: true,
      rating: 4.8,
      originalQuery: {},
      query: {},
      credit: {},
      categories: [],
      documents: [],
      records: [],
      states: [],
      methods: [],
      partners: [],
      showCount: 3,
      questions: {
        1: {
          nameES: '¿Qué cantidad necesitas?',
          nameEN: 'how much do you need?',
          listType: false,
          showDefault: true,
          key: 'amount',
          data: function () {
            return []
          }
        },
        2: {
          nameES: '¿Para qué lo necesita?',
          nameEN: 'What do you need it for?',
          listType: true,
          showDefault: true,
          key: 'category',
          data() {
            return app.credit.categories.map(id => {
              const nameEN = app.categories.find(c => c.id === id).nameEN
              const nameES = app.categories.find(c => c.id === id).nameES
              return {
                id,
                nameEN,
                nameES
              }
            })
          }
        },
        3: {
          nameES: '¿Qué tipo de documento tiene?',
          nameEN: 'What type of document do you have?',
          listType: true,
          showDefault: true,
          key: 'document',
          data() {
            return app.documents
          }
        },
        4: {
          nameES: 'Aproximado puntaje de crédito',
          nameEN: 'Approximate credit score',
          listType: true,
          showDefault: true,
          key: 'record',
          data() {
            return app.records
          }
        },
        5: {
          nameES: '¿En qué estado se encuentra?',
          nameEN: 'What state are you in?',
          listType: true,
          showDefault: false,
          key: 'state',
          data() {
            return app.states
          }
        },
        6: {
          nameES: '¿Posee auto propio o arrendado?',
          nameEN: 'Do you own or lease your car?',
          listType: true,
          showDefault: false,
          key: 'has_car',
          data() {
            return [
              {
                nameES: 'SI',
                nameEN: 'YES',
                id: true
              },
              {
                nameES: 'NO',
                nameEN: 'NO',
                id: false
              }
            ]
          }
        },
        7: {
          nameES: '¿Posee casa propia o arrendada?',
          nameEN: 'Do you own or lease a house?',
          listType: true,
          showDefault: false,
          key: 'has_house',
          data() {
            return [
              {
                nameES: 'SI',
                nameEN: 'YES',
                id: true
              },
              {
                nameES: 'NO',
                nameEN: 'NO',
                id: false
              }
            ]
          }
        },
        8: {
          nameES: '¿Cuanto gana mensualmente?',
          nameEN: 'how much are your monthly earnings?',
          listType: true,
          showDefault: false,
          key: 'earnings',
          data() {
            return [
              {
                nameEN: '$0.00 - $500.00',
                nameES: '$0.00 - $500.00',
                id: '0 - 500'
              },
              {
                nameEN: '$501.00 - $1,000.00',
                nameES: '$501.00 - $1,000.00',
                id: '501 - 1000'
              },
              {
                nameEN: '$1,001.00 - $1,500.00',
                nameES: '$1,001.00 - $1,500.00',
                id: '1001 - 1500'
              },
              {
                nameEN: '$1,501.00 - $2,000.00',
                nameES: '$1,501.00 - $2,000.00',
                id: '1501 - 2000'
              },
              {
                nameEN: '$2,001.00 - $2,500.00',
                nameES: '$2,001.00 - $2,500.00',
                id: '2001 - 2500'
              },
              {
                nameEN: '$2,501.00 - $3,000.00',
                nameES: '$2,501.00 - $3,000.00',
                id: '2501 - 3000'
              },
              {
                nameEN: '$3,001.00 - $3,500.00',
                nameES: '$3,001.00 - $3,500.00',
                id: '3001 - 3500'
              },
              {
                nameEN: '$3,501.00 - $4,000.00',
                nameES: '$3,501.00 - $4,000.00',
                id: '3501 - 4000'
              },
              {
                nameEN: '$4,001.00 - $4,500.00',
                nameES: '$4,001.00 - $4,500.00',
                id: '4001 - 4500'
              },
              {
                nameEN: '$4,501.00 - $5,000.00',
                nameES: '$4,501.00 - $5,000.00',
                id: '4501 - 5000'
              },
              {
                nameEN: '$5,001.00 - $6,000.00',
                nameES: '$5,001.00 - $6,000.00',
                id: '5001 - 6000'
              },
              {
                nameEN: '$6,001.00 - $7,000.00',
                nameES: '$6,001.00 - $7,000.00',
                id: '6001 - 7000'
              },
              {
                nameEN: '$7,001.00 - $8,000.00',
                nameES: '$7,001.00 - $8,000.00',
                id: '7001 - 8000'
              },
              {
                nameEN: '$8,001.00 - $9,000.00',
                nameES: '$8,001.00 - $9,000.00',
                id: '8001 - 9000'
              },
              {
                nameEN: '$9,001.00 - $10,000.00',
                nameES: '$9,001.00 - $10,000.00',
                id: '9001 - 10000'
              },
              {
                nameEN: '$10,001.00 - $15,000.00',
                nameES: '$10,001.00 - $15,000.00',
                id: '10001 - 15000'
              },
              {
                nameEN: '$15,001.00 - $20,000.00',
                nameES: '$15,001.00 - $20,000.00',
                id: '15001 - 20000'
              },
              {
                nameEN: '$20,001.00 - $25,000.00',
                nameES: '$20,001.00 - $25,000.00',
                id: '20001 - 25000'
              },
              {
                nameEN: '$25,001.00 - $30,000.00',
                nameES: '$25,001.00 - $30,000.00',
                id: '25001 - 30000'
              },
              {
                nameEN: '$30,001.00 - $40,000.00',
                nameES: '$30,001.00 - $40,000.00',
                id: '30001 - 40000'
              },
              {
                nameEN: '$40,001.00 - $50,000.00',
                nameES: '$40,001.00 - $50,000.00',
                id: '40001 - 50000'
              },
              {
                nameEN: '$50,000.00 - mas',
                nameES: '$50,000.00 - mas',
                id: '50000 - mas'
              },
            ]
          }
        },
        9: {
          nameES: '¿Como te pagan?',
          nameEN: 'how do you get paid?',
          listType: true,
          showDefault: false,
          key: 'payform',
          data() {
            return app.methods
          }
        }
      }
    }
  },
  methods: {
    characteristics(ES, EN) {
      if (this.spanishLang) {
        return ES.split('-&-')
      } else {
        return EN.split('-&-')
      }
    },
    loadMore() {
      this.loading = true
      setTimeout(() => {
        this.showCount = this.showCount + 3
        this.loading = false
      }, 1500);
    },
    formatTooltip(val) {
      return this.formatMoney(Math.ceil(this.calcValue(val)))
    },
    calcValue(val) {
      return val == 1 ? this.credit.minAmount : (val * (this.credit.maxAmount) / 100)
    },
    formatMoney(amount) {
      return new Intl.NumberFormat("en-US", { style: "currency", currency: "USD" }).format(amount)
    },
    resetFilters() {
      this.query = this.originalQuery
    },
    formedURL(partner) {
      let url = `/redirect?redirect=${btoa(partner.url)}&partner=${partner.id}`
      const params = []
      if (partner.paramName1 != null && partner.paramName1 != '') {
        const values = partner.paramValues1
          .split(',')
          .map(p => {
            switch (p) {
              case 'utm_source':
                return app.query.source
                break;
              case 'agent':
                return app.agent
                break;
            }
          })
          .filter(p => p != null)
        if (values.length > 0) {
          params.push(
            `${partner.paramName1}=${values.length > 1 ? values.join('-') : values[0]}`
          )
        }
      }
      if (partner.paramName2 != null && partner.paramName2 != '') {
        const values = partner.paramValues2
          .split(',')
          .map(p => {
            switch (p) {
              case 'utm_source':
                return app.query.source
                break;
              case 'agent':
                return app.agent
                break;
            }
          })
          .filter(p => p != null)
        if (values.length > 0) {
          params.push(
            `${partner.paramName2}=${values.length > 1 ? values.join('-') : values[0]}`
          )
        }
      }
      if (params.length > 0) {
        url += `&params=${btoa(params.join('&'))}`
      }
      return url
    },
    sesameLink(link) {
      let url = link
      if (this.query.source != null) {
        url += `&aff_sub=${this.query.source}`
      }
      if (this.agent != null) {
        url += `&aff_sub2=${this.agent}`
      }
      return url
    },
    karmaLink(link) {
      let url = link
      let source = false
      if (this.query.source != null) {
        url += `?subId1=${this.query.source}`
        source = true
      }
      if (this.agent != null) {
        url += `${source ? '&' : '?'}subId2=${this.agent}`
      }
      return url
    }
  },
  computed: {
    filteredPartners() {
      const partners = this.partners.filter(partner => {

        // Verifica que este habilitado
        const active = partner.active == 1

        // Verifica que se pueda mostrar (no solo para agentes)
        const display = partner.onlyAgent == 0

        // Verifica si el proveedor require carro
        let noCarRequired = true
        if (partner.requiresCar == 1) {
          noCarRequired = this.query.has_car
        }

        // Verifica si el proveedor require casa
        let noHouseRequired = true
        if (partner.requiresHouse == 1) {
          noHouseRequired = this.query.has_house
        }

        // Verifica si el proveedor puede proveer la cantidad
        const moneyAvailable = partner.amounts.filter(a => {
          const amount = this.calcValue(this.query.amount)
          return amount >= parseFloat(a.from) && amount <= parseFloat(a.until)
        }).length > 0

        // check that the provider works with the selected state estado
        const stateAvailable = partner.states.filter(a => a.id == this.query.state).length > 0

        // Checks the credit is duable record
        const recordAvailable = partner.records.filter(a => a.id == this.query.record).length > 0

        // check if the document is valid document
        const documentAvailable = partner.documents.filter(a => a.id == this.query.document).length > 0

        // check the category
        const categoryAvailable = partner.categories.filter(a => a.id == this.query.category).length > 0

        // check the method
        const methodAvailable = partner.methods.filter(a => a.id == this.query.payform).length > 0

        if (
          display &&
          active &&
          noCarRequired &&
          noHouseRequired &&
          moneyAvailable &&
          stateAvailable &&
          recordAvailable &&
          documentAvailable &&
          categoryAvailable &&
          methodAvailable
        ) {
          return partner
        }

      }).sort((a, b) => {
        if (parseFloat(a.rate) < parseFloat(b.rate)) return 1
        if (parseFloat(a.rate) > parseFloat(b.rate)) return -1
        return 0
      })

      return partners
    }
  }
})