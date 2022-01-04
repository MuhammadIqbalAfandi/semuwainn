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
    setText(state, data) {
      const { text, icon } = data
      if (!icon) {
        state.flashIcon = null
      } else {
        state.flashIcon = icon
      }

      state.flashText = text
    },
  },
  actions: {
    showFlashMessage({ commit }) {
      commit('showFlashMessage')
    },
    hideFlashMessage({ commit }) {
      commit('hideFlashMessage')
    },
    setText({ commit }, data) {
      commit('setText', data)
    },
  },
}
