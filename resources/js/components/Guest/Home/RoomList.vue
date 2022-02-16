<script>
import OriginPrice from '@/components/Shared/OriginPrice.vue'
import Paragraph from '@/components/Shared/Paragraph.vue'
import ParagraphLeftIcon from '@/components/Shared/ParagraphLeftIcon.vue'
import mixinRooms from '@/mixins/rooms'

export default {
  props: {
    roomType: Object,
  },
  components: {
    OriginPrice,
    Paragraph,
    ParagraphLeftIcon,
  },
  mixins: [mixinRooms],
  computed: {
    thumbnail() {
      return this.roomType.thumbnail
    },
  },
}
</script>

<template>
  <v-card hover>
    <v-card-text>
      <v-row>
        <v-col cols="auto">
          <v-img
            :max-width="$vuetify.breakpoint.smAndDown ? '109' : '278'"
            :height="$vuetify.breakpoint.smAndDown ? '100' : '200'"
            class="align-self-center rounded-sm"
            :src="thumbnail"
            alt="Thumbnail Room"
            tile
          />
        </v-col>

        <v-col>
          <v-row class="d-flex">
            <v-col>
              <h3 class="mb-md-4 text-body-2 text-md-h5">{{ roomType.name }}</h3>
              <Paragraph class="mb-md-2 text-caption text-md-body-2">Facility :</Paragraph>
              <v-row dense>
                <v-col cols="auto" v-for="(facility, index) in roomType.facilities" :key="index">
                  <Paragraph class="green--text text--lighten-2 text-caption text-md-body-2">
                    {{ facility }}
                  </Paragraph>
                </v-col>

                <v-col cols="auto">
                  <v-chip v-if="roomType.facilityCount" class="mb-0" tag="p" x-small>
                    <span>+{{ roomType.facilityCount }}</span>
                  </v-chip>
                </v-col>
              </v-row>

              <ParagraphLeftIcon icon="mdi-account-multiple" :text="roomType.numberOfGuest + ' tamu'" />
            </v-col>

            <v-col class="text-end" cols="12" md="auto" align-self="end">
              <Paragraph class="text-caption text-md-body-2">Harga mulai dari</Paragraph>
              <OriginPrice :price="roomType.price" />
              <Paragraph class="text-caption red--text text--lighten-2">{{ roomStatus }}</Paragraph>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>
