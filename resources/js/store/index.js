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
  getters: {
    getRoomId: (state) => {
      return state.roomCart.map((room) => room.roomId)
    },
    getRoomCount: (state) => {
      const roomCounts = state.roomCart.map((item) => item.roomCount)
      return roomCounts.length ? roomCounts.reduce((prev, current) => prev + current) : 0
    },
    getRoomAvailable: (state) => (room) => {
      const filteredRoom = state.roomCart.filter((item) => item.id === room.id)
      const roomCounts = filteredRoom.map((item) => item.roomCount)
      const roomCountTotal = roomCounts.length ? roomCounts.reduce((prev, current) => prev + current) : 0
      if (!state.roomCart.length) {
        return room.roomAvailable
      } else {
        return room.roomAvailable - roomCountTotal
      }
    },
  },
  mutations: {
    addRoomCart(state, room) {
      const roomFound = state.roomCart.find((item) => item.priceId === room.priceId)
      if (roomFound) {
        roomFound.roomCount += room.roomCount
        roomFound.guestCount += room.guestCount
        roomFound.roomId.push(...room.roomId)
      } else {
        state.roomCart.push(room)
      }
    },
    removeRoomCart(state, priceId) {
      state.roomCart = state.roomCart.filter((item) => item.priceId !== priceId)
    },
    addServiceCart(state, service) {
      state.serviceCart = service
    },
    removeServiceCart(state, id) {
      state.serviceCart = state.serviceCart.filter((item) => item.id !== id)
    },
  },
})
