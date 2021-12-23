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
      //   const roomDuplicate = state.roomCart.find((item) => item.id === room.id)
      //   const newRoom = state.roomCart.filter((item) => item.id !== room.id)
      //   if (roomDuplicate !== undefined) {
      //     const roomCount = room.roomCount + roomDuplicate.roomCount
      //     const guestCount = room.guestCount + roomDuplicate.guestCount
      //     console.log(newRoom)
      //     state.roomCart.push({ ...newRoom, ...room, roomCount, guestCount })
      //   } else {
      //     state.roomCart.push(room)
      //   }
      state.roomCart.push(room)
    },
    removeRoomCart({ state }, id) {
      state.roomCart = state.roomCart.filter((item) => item.id !== id)
    },
    addServiceCart({ state }, service) {
      state.serviceCart = service
    },
    removeServiceCart({ state }, id) {
      state.serviceCart = state.serviceCart.filter((item) => item.id !== id)
    },
  },
})
