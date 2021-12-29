export default {
  namespaced: true,
  state: {
    flashMessage: false,
    flashText: null,
    flashIcon: null,
  },
  mutations: {
    showFlashMessage(state) {
      state.flashMessage = true
    },
    hideFlashMessage(state) {
      state.flashMessage = false
    },
    setText(state, text) {
      state.flashText = text
    },
    setIcon(state, icon) {
      state.flashIcon = icon
    },
  },
}
