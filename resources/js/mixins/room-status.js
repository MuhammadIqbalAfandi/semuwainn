export default {
  methods: {
    roomStatus(room) {
      return this.getRoomAvailable(room) ? `Sisa ${this.getRoomAvailable(room)} kamar lagi!` : 'Kamar penuh!'
    },
  },
}
