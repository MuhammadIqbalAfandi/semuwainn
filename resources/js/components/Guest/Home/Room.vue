<script>
import OriginPrice from '@/shared/OriginPrice.vue'
import Paragraph from '@/shared/Paragraph.vue'
import ParagraphLeftIcon from '@/shared/ParagraphLeftIcon.vue'

export default {
  props: {
    room: Object,
  },
  components: {
    OriginPrice,
    Paragraph,
    ParagraphLeftIcon,
  },
  computed: {
    thumbnail() {
      return this.room.thumbnail.images[0] ?? this.room.thumbnail.defaultImage
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
              <h3 class="mb-md-4 text-body-2 text-md-h5">{{ room.roomName }}</h3>
              <Paragraph class="mb-md-2 text-caption text-md-body-2">Facility :</Paragraph>
              <v-row dense>
                <v-col cols="auto" v-for="(facility, index) in room.facilities" :key="index">
                  <Paragraph class="green--text text--lighten-2 text-caption text-md-body-2">
                    {{ facility }}
                  </Paragraph>
                </v-col>

                <v-col cols="auto">
                  <v-chip v-if="room.facilityCount" class="mb-0" tag="p" x-small>
                    <span>+{{ room.facilityCount }}</span>
                  </v-chip>
                </v-col>
              </v-row>
            </v-col>

            <v-col class="text-end" cols="12" md="auto" align-self="end">
              <Paragraph class="text-caption text-md-body-2">Harga mulai dari</Paragraph>
              <OriginPrice :price="room.originPrice" />
              <Paragraph class="text-caption red--text text--lighten-2">
                Sisa {{ room.roomAvailable }} kamar lagi!
              </Paragraph>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>
