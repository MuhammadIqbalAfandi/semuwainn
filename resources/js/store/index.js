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
    roomCartView: [],
    serviceCart: [],
  },
  getters: {
    getRoomId: (state) => {
      return state.roomCart.map((item) => item.roomId)
    },
    getRoomCount: (state) => {
      const roomCounts = state.roomCart.map((item) => item.roomCount)
      return roomCounts.length ? roomCounts.reduce((prev, current) => prev + current) : 0
    },
    getRoomAvailable: (state, getters) => (room) => {
      const { rooms, roomsBooking } = room
      const roomsAvailable = difference(rooms, roomsBooking)
      const roomAvailableTotal = difference(roomsAvailable, flattenDeep(getters.getRoomId))
      return roomAvailableTotal.length
    },
  },
  mutations: {
    addRoomCart(state, room) {
      state.roomCart.push(room)
    },
    addRoomCartView(state, room) {
      // FIXME: room cart changes
      const roomFound = state.roomCartView.find((item) => item.priceId === room.priceId)
      if (roomFound) {
        roomFound.roomCount += room.roomCount
        roomFound.guestCount += room.guestCount
        roomFound.roomId.push(...room.roomId)
      } else {
        state.roomCartView.push(room)
      }
    },
    removeRoomCart(state, priceId) {
      state.roomCart = state.roomCart.filter((item) => item.priceId !== priceId)
      state.roomCartView = state.roomCartView.filter((item) => item.priceId !== priceId)
      if (!state.roomCart.length) {
        state.serviceCart = []
      }
    },
    clearRoomCart(state) {
      state.roomCart = []
      state.roomCartView = []
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
      commit('addRoomCartView', room)
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
