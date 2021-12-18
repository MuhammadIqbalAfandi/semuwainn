import Vue from 'vue'
import Vuex from 'vuex'

import roomBooking from '@/store/modules/room-booking'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    roomBooking,
  },
  state: {
    roomCart: [],
    serviceCart: [],
  },
  actions: {
    addRoomCart({ state }, room) {
      state.roomCart.push(room)
    },
    removeRoomCart({ state }, id) {
      state.roomCart = state.roomCart.filter((item) => item.price.id !== id)
    },
    addServiceCart({ state }, service) {
      state.serviceCart = service
    },
    removeServiceCart({ state }, id) {
      state.serviceCart = state.serviceCart.filter((item) => item.id !== id)
    },
  },
})
