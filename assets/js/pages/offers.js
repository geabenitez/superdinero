new Vue({
  el: '#app',
  created() {
    const slug = window.location.pathname.split('ofertas/')[1]
    const query = JSON.parse(atob(location.search.split('?d=')[1]))
    this.slug = slug
    this.query = query
    this.originalQuery = query
    const headers = { 'token-crf': cs }
    const getCategories = () => axios({ headers, method: 'GET', url: `${site_url}categories` })
    const getCredits = () => axios({ headers, method: 'GET', url: `${site_url}credits` })
    const getDocuments = () => axios({ headers, method: 'GET', url: `${site_url}documents` })
    const getRecords = () => axios({ headers, method: 'GET', url: `${site_url}records` })
    const getStates = () => axios({ headers, method: 'GET', url: `${site_url}states` })
    const getPartners = () => axios({ headers, method: 'GET', url: `${site_url}partners` })


    axios
      .all([getCategories(), getCredits(), getDocuments(), getRecords(), getStates(), getPartners()])
      .then(axios.spread((categories, credits, documents, records, states, partners) => {
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
        this.partners = partners.data
        this.loading = false
      }))
  },
  data: function () {
    return {
      slug: '',
      loading: true,
      showSettings: false,
      spanishLang: false,
      rating: 4.8,
      originalQuery: {},
      query: {},
      credit: {},
      categories: [],
      documents: [],
      records: [],
      states: [],
      partners: []
    }
  },
  methods: {
    characteristics(ES, EN) {
      if (this.spanishLang) {
        return ES.split(',')
      } else {
        return EN.split(',')
      }
    }
  }
})