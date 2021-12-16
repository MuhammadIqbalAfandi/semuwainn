<script>
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
}
</script>

<template>
  <v-card outlined hover>
    <v-card-text>
      <v-row>
        <v-col cols="12">
          <v-row>
            <v-col cols="auto">
              <v-img
                class="align-self-center rounded-sm"
                :max-width="$vuetify.breakpoint.smAndDown ? 50 : 70"
                :max-height="$vuetify.breakpoint.smAndDown ? 50 : 70"
                :src="room.photoGrid.defaultImage"
                alt="Thumbnail Room"
                tile
              />
            </v-col>

            <v-col>
              <Paragraph>{{ room.roomName }}</Paragraph>
              <v-row class="text-caption" dense>
                <v-col cols="auto">
                  <Paragraph>{{ room.guestCount }} tamu</Paragraph>
                </v-col>
              </v-row>
              <v-row class="text-caption" dense>
                <v-col cols="auto">
                  <Paragraph class="text-caption red--text text--lighten-2">
                    <span class="text-caption">Rp</span> {{ currencyFormat(room.price.originPrice) }}
                  </Paragraph>
                </v-col>
                <v-col cols="auto">
                  <Paragraph>{{ room.roomCount }}x kamar</Paragraph>
                </v-col>
              </v-row>
            </v-col>

            <v-col cols="auto" align-self="end">
              <Button @click="$emit('orderDelete', room.price.id)" text x-small>Hapus</Button>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>
