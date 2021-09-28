<script>
import Paragraph from '@/shared/Paragraph.vue'

export default {
  props: {
    services: {
      type: Array,
    },
  },
  components: {
    Paragraph,
  },
}
</script>

<template>
  <v-expansion-panels>
    <v-row dense>
      <v-col v-for="(service, index) in services" :key="index" cols="12" sm="6">
        <v-expansion-panel>
          <v-expansion-panel-header>
            <v-checkbox class="ma-0" :value="service.id" color="orange lighten-2" hide-details="true">
              <template #label>
                <span class="text-caption text-md-body-2">{{ service.name }}</span>
              </template>
            </v-checkbox>
          </v-expansion-panel-header>
          <v-expansion-panel-content>
            <v-row dense>
              <v-col cols="12">
                <Paragraph class="text-caption text-md-body-2">IDR: {{ service.price }}</Paragraph>
                <Paragraph class="text-caption text-md-body-2">Satuan: {{ service.unit }}</Paragraph>
              </v-col>

              <v-col cols="12">
                <Paragraph class="text-caption text-md-body-2 text--secondary">{{ service.description }}</Paragraph>
              </v-col>
            </v-row>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-col>
    </v-row>
  </v-expansion-panels>
</template>
