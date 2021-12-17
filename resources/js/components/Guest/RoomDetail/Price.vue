<script>
import Paragraph from '@/shared/Paragraph.vue'
import OriginPrice from '@/shared/OriginPrice.vue'
import Button from '@/shared/Button.vue'

export default {
  props: {
    prices: Array,
  },
  components: {
    Paragraph,
    OriginPrice,
    Button,
  },
}
</script>

<template>
  <v-row dense>
    <v-col v-for="price in prices" :key="price.id" cols="6">
      <v-card class="d-flex flex-column align-end text-end" height="100%" hover>
        <v-card-text>
          <Paragraph class="text-caption text-md-body-2">{{ price.description }}</Paragraph>
        </v-card-text>

        <v-spacer />

        <v-card-text>
          <OriginPrice :price="price.originPrice" />
          <Paragraph class="text-caption red--text text--lighten-2">
            Sisa {{ price.roomAvailable }} kamar lagi!
          </Paragraph>
        </v-card-text>

        <v-card-actions>
          <Button @click="$emit('roomOrder', price.id)">Pilih!</Button>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>
