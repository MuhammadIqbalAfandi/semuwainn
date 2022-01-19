import Vue from 'vue'
import Vuex from 'vuex'
import difference from 'lodash/difference'
import flattenDeep from 'lodash/flattenDeep'
import roomBooking from '@/store/modules/room-booking'
import flashMessage from '@/store/modules/flash-message'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    roomBooking,
    flashMessage,
  },
  state: {
    roomCart: [],
    serviceCart: [],
  },
  getters: {
    getRoomId: (state) => {
      return state.roomCart.map((item) => item.roomId)
    },
    getRoomAvailable: (state, getters) => (roomsId) => {
      const roomAvailableTotal = difference(roomsId, flattenDeep(getters.getRoomId))
      return roomAvailableTotal.length
    },
    getRoomView(state) {
      return state.roomCart
    },
  },
  mutations: {
    addRoomCart(state, room) {
      state.roomCart.push(room)
    },
    removeRoomCart(state, roomId) {
      state.roomCart = state.roomCart.filter((item) => item.roomId !== roomId)
      if (!state.roomCart.length) {
        state.serviceCart = []
      }
    },
    clearRoomCart(state) {
      state.roomCart = []
      if (!state.roomCart.length) {
        state.serviceCart = []
      }
    },
    addServiceCart(state, service) {
      state.serviceCart = service
    },
    removeServiceCart(state, id) {
      state.serviceCart = state.serviceCart.filter((item) => item.id !== id)
    },
  },
  actions: {
    addRoomCart({ commit }, room) {
      commit('addRoomCart', room)
    },
    removeRoomCart({ commit }, priceId) {
      commit('removeRoomCart', priceId)
    },
    clearRoomCart({ commit }) {
      commit('clearRoomCart')
    },
    addServiceCart({ commit }, service) {
      commit('addServiceCart', service)
    },
    removeServiceCart({ commit }, id) {
      commit('removeServiceCart', id)
    },
  },
})
