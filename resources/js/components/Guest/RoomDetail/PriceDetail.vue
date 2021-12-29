<script>
import { mapMutations, mapGetters } from 'vuex'
import difference from 'lodash/difference'
import head from 'lodash/head'
import flattenDeep from 'lodash/flattenDeep'
import Paragraph from '@/shared/Paragraph.vue'
import OriginPrice from '@/shared/OriginPrice.vue'
import Button from '@/shared/Button.vue'
import mixinRoomStatus from '@/mixins/room-status'

export default {
  props: {
    room: Object,
  },
  components: {
    Paragraph,
    OriginPrice,
    Button,
  },
  mixins: [mixinRoomStatus],
  computed: {
    ...mapGetters(['getRoomAvailable', 'getRoomId']),
  },
  methods: {
    ...mapMutations(['addRoomCart']),
    ...mapMutations('flashMessage', ['showFlashMessage', 'hideFlashMessage', 'setIcon', 'setText']),
    roomOrder(priceId) {
      if (this.$parent.valid && this.getRoomAvailable(this.room) >= 1) {
        const { id, prices, thumbnail, name, rooms, roomsBooking } = this.room
        const roomsAvailable = difference(rooms, roomsBooking)
        const price = prices.find((price) => price.id === priceId)
        const roomId = [head(difference(roomsAvailable, flattenDeep(this.getRoomId)))]
        this.addRoomCart({
          id,
          roomId,
          name,
          thumbnail,
          priceId: Number(price.id),
          price: Number(price.price),
          roomCount: Number(this.$parent.roomCount),
          guestCount: Number(this.$parent.guestCount),
        })

        this.hideFlashMessage()
        this.$nextTick(() => {
          this.setText('Berhasil ditambahkan ke keranjang')
          this.setIcon('mdi-cart')
          this.showFlashMessage()
        })
      }
    },
  },
}
</script>

<template>
  <v-row dense>
    <v-col v-for="price in room.prices" :key="price.id" cols="6">
      <v-card class="d-flex flex-column align-end text-end" height="100%" hover>
        <v-card-text>
          <Paragraph class="text-caption text-md-body-2">{{ price.description }}</Paragraph>
        </v-card-text>

        <v-spacer />

        <v-card-text>
          <OriginPrice :price="price.price" />
          <Paragraph class="text-caption red--text text--lighten-2">
            {{ roomStatus(room) }}
          </Paragraph>
        </v-card-text>

        <v-card-actions>
          <Button @click="roomOrder(price.id)">Pilih!</Button>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>
