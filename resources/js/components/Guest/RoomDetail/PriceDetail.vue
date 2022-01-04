<script>
import { mapActions, mapGetters } from 'vuex'
import difference from 'lodash/difference'
import head from 'lodash/head'
import flattenDeep from 'lodash/flattenDeep'
import Paragraph from '@/shared/Paragraph.vue'
import OriginPrice from '@/shared/OriginPrice.vue'
import Button from '@/shared/Button.vue'
import mixinRooms from '@/mixins/rooms'

export default {
  props: {
    room: Object,
  },
  components: {
    Paragraph,
    OriginPrice,
    Button,
  },
  mixins: [mixinRooms],
  computed: {
    ...mapGetters(['getRoomId']),
  },
  methods: {
    ...mapActions(['addRoomCart']),
    roomOrder(priceId) {
      if (this.$parent.valid && this.roomAvailable >= 1) {
        const { id, prices, thumbnail, name, roomsId } = this.room
        const price = prices.find((price) => price.id === priceId)
        const roomId = head(difference(roomsId, this.getRoomId))
        const data = {
          id,
          roomId,
          name,
          thumbnail,
          priceId: Number(price.id),
          price: Number(price.price),
          roomCount: Number(this.$parent.roomCount),
          guestCount: Number(this.$parent.guestCount),
        }

        this.addRoomCart(data)
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
            {{ roomStatus }}
          </Paragraph>
        </v-card-text>

        <v-card-actions>
          <Button :disabled="!roomAvailable" @click="roomOrder(price.id)">Pilih!</Button>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>
