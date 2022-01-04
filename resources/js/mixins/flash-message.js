import { mapActions } from 'vuex'

export default {
  methods: {
    ...mapActions('flashMessage', ['hideFlashMessage', 'showFlashMessage', 'setText']),
    activeFlashMessage(data) {
      this.hideFlashMessage()
      this.$nextTick(() => {
        this.setText(data)
        this.showFlashMessage()
      })
    },
  },
}
