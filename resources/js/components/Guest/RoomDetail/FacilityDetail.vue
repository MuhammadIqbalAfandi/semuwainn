<script>
import Paragraph from '@/shared/Paragraph.vue'

export default {
  props: {
    facilities: Array,
  },
  components: {
    Paragraph,
  },
}
</script>

<template>
  <v-card>
    <v-card-text>
      <v-row>
        <v-col cols="12">
          <Paragraph class="text-body-2 text-md-h5 font-weight-bold">Fasilitas</Paragraph>
        </v-col>

        <v-col cols="12">
          <v-row class="facility-detail text-center">
            <v-col v-for="(facility, index) in facilities" :key="index" cols="auto">
              <Paragraph class="text-caption text-md-body-2 green--text text--lighten-2">{{ facility }}</Paragraph>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<style lang="scss">
.facility-detail {
  display: grid;
  grid-template-columns: repeat(6, 1fr);
}

@media screen and (max-width: 960px) {
  .facility-detail {
    grid-template-columns: repeat(4, 1fr);
  }
}

@media screen and (max-width: 600px) {
  .facility-detail {
    grid-template-columns: repeat(3, 1fr);
  }
}
</style>
