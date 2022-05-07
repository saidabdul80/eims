
const store = new Vuex.Store({
    state () {
        return {
            totalNumber:0,
            pay_stack_key:"pk_test_8a64fe980594cadf1c3bd2e513d941cd300d3aba"
        }
      },
      mutations: {
        totalNumber (state, n) {
          state.totalNumber = n
        }
      },
      getters: {
        totalNumber: function (state) {
          return state.totalNumber
            },
        payStackKey: function (state) {
              return state.pay_stack_key
        }
        }


})