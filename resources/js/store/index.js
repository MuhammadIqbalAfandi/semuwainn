import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    shoppingCart: [],
    checkIn: null,
    checkOut: null,
    nightCount: null,
  },
  actions: {
    addShoppingCart({ state }, room) {
      state.shoppingCart.push(room)
    },
    removeShoppingCart({ state }, id) {
      state.shoppingCart = state.shoppingCart.filter((item) => item.price.id !== id)
    },
    setCheckIn({ state }, date) {
      state.checkIn = date
    },
    setCheckOut({ state }, date) {
      state.checkOut = date
    },
    setNightCount({ state }, night) {
      state.nightCount = night
    },
  },
})
