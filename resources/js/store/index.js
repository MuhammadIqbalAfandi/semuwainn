import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    shoppingCart: [],
  },
  actions: {
    addShoppingCart({ state }, room) {
      state.shoppingCart.push(room)
    },
    removeShoppingCart({ state }, id) {
      state.shoppingCart = state.shoppingCart.filter((item) => item.id !== id)
    },
  },
})
