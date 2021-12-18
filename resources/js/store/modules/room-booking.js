export default {
  namespaced: true,
  state: {
    checkIn: null,
    checkOut: null,
    nightCount: null,
  },
  actions: {
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
}
