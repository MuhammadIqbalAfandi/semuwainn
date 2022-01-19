import { mapGetters } from 'vuex'

export default {
  computed: {
    ...mapGetters(['getRoomAvailable']),
    roomAvailable() {
      return this.getRoomAvailable(this.roomType.roomsId)
    },
    roomStatus() {
      return this.getRoomAvailable(this.roomType.roomsId)
        ? `Sisa ${this.getRoomAvailable(this.roomType.roomsId)} kamar lagi!`
        : 'Kamar penuh!'
    },
  },
}
