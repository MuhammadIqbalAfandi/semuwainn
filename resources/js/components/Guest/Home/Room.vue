<script>
import OriginPrice from '@/shared/OriginPrice.vue'
import Discount from '@/shared/Discount.vue'
import DiscountPrice from '@/shared/DiscountPrice.vue'
import Paragraph from '@/shared/Paragraph.vue'
import ParagraphLeftIcon from '@/shared/ParagraphLeftIcon.vue'

export default {
  props: {
    roomType: Object,
  },
  components: {
    OriginPrice,
    Discount,
    DiscountPrice,
    Paragraph,
    ParagraphLeftIcon,
  },
}
</script>

<template>
  <v-card hover>
    <v-card-text>
      <v-row>
        <v-col cols="auto">
          <v-img
            class="align-self-center rounded-sm"
            :max-width="$vuetify.breakpoint.smAndDown ? '109' : '278'"
            :height="$vuetify.breakpoint.smAndDown ? '100' : '200'"
            src="/img/default-room.webp"
            alt="Thumbnail Room"
            tile
          />
        </v-col>

        <v-col>
          <v-row class="d-flex">
            <v-col>
              <h3 class="mb-md-4 text-body-2 text-md-h5">{{ roomType.roomName }}</h3>
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
            </v-col>

            <v-col class="text-end" cols="12" md="auto" align-self="end">
              <Paragraph class="text-caption text-md-body-2">Harga mulai dari</Paragraph>
              <OriginPrice :price="roomType.originPrice" />
              <Paragraph class="text-caption red--text text--lighten-2">
                Sisa {{ roomType.roomAvailable }} kamar lagi!
              </Paragraph>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>
