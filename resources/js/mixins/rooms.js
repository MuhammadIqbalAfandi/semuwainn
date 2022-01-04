import { mapGetters } from 'vuex'

export default {
  computed: {
    ...mapGetters(['getRoomAvailable']),
    roomAvailable() {
      return this.getRoomAvailable(this.room.roomsId)
    },
    roomStatus() {
      return this.getRoomAvailable(this.room.roomsId)
        ? `Sisa ${this.getRoomAvailable(this.room.roomsId)} kamar lagi!`
        : 'Kamar penuh!'
    },
  },
}
