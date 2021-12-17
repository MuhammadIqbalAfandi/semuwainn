import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    roomCart: [],
    serviceCart: [],
    checkIn: null,
    checkOut: null,
    nightCount: null,
  },
  actions: {
    addRoomCart({ state }, room) {
      state.roomCart.push(room)
    },
    removeRoomCart({ state }, id) {
      state.roomCart = state.roomCart.filter((item) => item.price.id !== id)
    },
    removeServiceCart({ state }, id) {
      state.serviceCart = state.serviceCart.filter((item) => item.id !== id)
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
    setServiceCart({ state }, service) {
      state.serviceCart = service
    },
  },
})
