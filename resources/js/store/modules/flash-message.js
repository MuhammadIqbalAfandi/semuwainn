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
    setText(state, { text, icon }) {
      if (!icon) {
        state.flashIcon = null
      } else {
        state.flashIcon = icon
      }

      state.flashText = text
    },
  },
}
