import dayjs from 'dayjs'

export default {
  namespaced: true,
  state: {
    checkIn: dayjs().toISOString().substring(0, 10),
    checkOut: null,
    nightCount: null,
    valid: true,
    name: '',
    nik: '',
    phone: '',
    email: '',
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
    setValid({ state }, valid) {
      state.valid = valid
    },
    setName({ state }, name) {
      state.name = name
    },
    setNik({ state }, nik) {
      state.nik = nik
    },
    setPhone({ state }, phone) {
      state.phone = phone
    },
    setEmail({ state }, email) {
      state.email = email
    },
  },
}
