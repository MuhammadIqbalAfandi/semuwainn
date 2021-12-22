<script>
import Paragraph from '@/shared/Paragraph.vue'
import OriginPrice from '@/shared/OriginPrice.vue'
import MoneySeparator from '@/shared/MoneySeparator.vue'
import ParagraphLeftIcon from '@/shared/ParagraphLeftIcon.vue'

export default {
  props: {
    priceRange: Object,
    roomName: String,
    numberOfGuest: Number,
  },
  components: {
    Paragraph,
    OriginPrice,
    MoneySeparator,
    ParagraphLeftIcon,
  },
}
</script>

<template>
  <v-card class="rounded-b-md" tile>
    <v-card-text>
      <v-row align="center" justify="space-between">
        <v-col cols="12" md="auto">
          <v-row align="center" dense>
            <v-col cols="12">
              <Paragraph class="text-body-2 text-md-h5 font-weight-bold">{{ roomName }}</Paragraph>
            </v-col>
            <v-col cols="12">
              <ParagraphLeftIcon icon="mdi-account-multiple" :text="numberOfGuest + ' tamu'" />
            </v-col>
          </v-row>
        </v-col>

        <v-col cols="12" md="auto">
          <v-row class="text-end" justify="end" align="center" no-gutters>
            <v-col cols="12">
              <Paragraph class="text-caption text-md-body-2">Harga mulai dari</Paragraph>
            </v-col>

            <v-col cols="auto"><OriginPrice :price="priceRange.minPrice" /></v-col>
            <v-col cols="auto"><MoneySeparator /></v-col>
            <v-col cols="auto"><OriginPrice :price="priceRange.maxPrice" /></v-col>

            <v-col cols="12">
              <Paragraph class="text-caption text-md-body-2">Per malam per kamar</Paragraph>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>
