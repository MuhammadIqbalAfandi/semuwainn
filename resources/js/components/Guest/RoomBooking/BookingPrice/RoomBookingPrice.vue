<script>
import { mapMutations } from 'vuex'
import Paragraph from '@/shared/Paragraph.vue'
import Button from '@/shared/Button.vue'
import OriginPrice from '@/shared/OriginPrice.vue'
import mixinHelper from '@/mixins/helpers'

export default {
  components: { Paragraph, Button, OriginPrice },
  props: {
    room: Object,
  },
  mixins: [mixinHelper],
  computed: {
    thumbnail() {
      return this.room.thumbnail.images[0] ?? this.room.thumbnail.defaultImage
    },
  },
  methods: {
    ...mapMutations(['removeRoomCart', 'clearServiceCart']),
    roomDelete(priceId) {
      this.removeRoomCart(priceId)
    },
  },
}
</script>

<template>
  <v-card hover>
    <v-card-text>
      <v-row align="center" dense>
        <v-col cols="auto">
          <v-img
            class="align-self-center rounded-sm"
            :max-width="$vuetify.breakpoint.smAndDown ? 50 : 70"
            :max-height="$vuetify.breakpoint.smAndDown ? 50 : 70"
            :src="thumbnail"
            alt="Thumbnail Room"
            tile
          />
        </v-col>

        <v-col>
          <Paragraph>{{ room.name }}</Paragraph>
          <Paragraph>{{ room.guestCount }} tamu</Paragraph>

          <v-row dense>
            <v-col cols="auto">
              <Paragraph class="text-caption red--text text--lighten-2">
                <span class="text-caption">Rp</span> {{ currencyFormat(room.price) }}
              </Paragraph>
            </v-col>

            <v-col cols="auto">
              <Paragraph>
                <span>(x {{ room.roomCount }} kamar)</span>
              </Paragraph>
            </v-col>
          </v-row>
        </v-col>

        <v-col cols="auto">
          <Button @click="roomDelete(room.priceId)" text x-small>Hapus</Button>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>
