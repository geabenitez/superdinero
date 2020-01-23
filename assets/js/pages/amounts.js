new Vue({
  el: '#app',
  data: function () {
    return {
      amounts: [
        {
          index: 1,
          from: 1000,
          until: 10000,
          active: true,
        },
        {
          index: 2,
          from: 10000,
          until: 50000,
          active: false,
        }
      ],
      searchValue: '',
      showNewAmount: false,
      newAmountForm: {
        from: '',
        until: '',
      }
    }
  }
})