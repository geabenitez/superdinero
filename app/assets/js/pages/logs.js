const app = new Vue({
  el: '#app',
  created() {
    const headers = { 'token-crf': cs }

    const getCodes = () => {
      return axios({ headers, method: 'GET', url: `${site_url}codes` })
    }

    const getAgents = () => {
      return axios({ headers, method: 'GET', url: `${site_url}users` })
    }


    axios
      .all([getCodes(), getAgents()])
      .then(axios.spread((codes, agents) => {
        this.codes = codes.data
          .map(code => {
            const conf = JSON.parse(code.configuracion)
            const options = {
              year: 'numeric', month: 'numeric', day: 'numeric',
              hour: 'numeric', minute: 'numeric', second: 'numeric',
              hour12: false,
            };
            return {
              codigo: code.codigo,
              name: `${conf.names} ${conf.lastnames}`,
              email: conf.email,
              phone: conf.phone,
              agent: code.agent,
              date: new Intl.DateTimeFormat('en-US', options).format(new Date(code.created_at)),
              type: code.agent != null ? 'Agente' : conf.source
            }
          })
        this.agents = agents.data
        this.loading = false
      }))
  },
  data: function () {
    return {
      loading: true,
      codes: [],
      agents: [],
      filter: {
        agent: '',
        search: ''
      }
    }
  },
  methods: {
    findName(id) {
      const user = Object.values(this.agents).find(agent => agent.id == id)
      if (user) {
        return `${user.names} ${user.lastnames}`
      }
      return ''
    }
  },
  computed: {
    filtered() {
      let passByName = true
      let passBySearch = true
      return this.codes.filter(c => {
        const agentId = this.filter.agent
        const searchValue = this.filter.search.toLowerCase()
        if (agentId) {
          passByName = agentId == c.agent
        }
        if (searchValue) {
          passBySearch =
            c.codigo.toLowerCase().includes(searchValue) ||
            c.name.toLowerCase().includes(searchValue) ||
            c.email.toLowerCase().includes(searchValue) ||
            c.phone.toLowerCase().includes(searchValue) ||
            c.type.toLowerCase().includes(searchValue)

        }
        return passByName && passBySearch
      })
    }
  }
})