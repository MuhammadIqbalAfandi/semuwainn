<script>
import { mapActions, mapState } from 'vuex'

import Paragraph from '@/shared/Paragraph.vue'
import ParagraphSpacing from '@/shared/ParagraphSpacing.vue'
import mixinHelpers from '@/mixins/helpers'

export default {
  props: {
    services: Object,
  },
  mixins: [mixinHelpers],
  components: {
    Paragraph,
    ParagraphSpacing,
  },
  data() {
    return {
      addService: [],
      current_page: this.services.current_page,
    }
  },
  watch: {
    addService(val, oldVal) {
      this.setServiceCart(val)
    },
  },
  methods: {
    ...mapActions(['setServiceCart']),
    next() {
      this.$inertia.get(this.services.next_page_url, '', { preserveScroll: true })
    },
    prev() {
      this.$inertia.get(this.services.prev_page_url, '', { preserveScroll: true })
    },
    input() {
      this.$inertia.get(`${this.services.path}/?page=${this.current_page}`, '', { preserveScroll: true })
    },
  },
}
</script>

<template>
  <v-expansion-panels>
    <v-row dense>
      <v-col v-for="(service, index) in services.data" :key="index" cols="12" sm="6">
        <v-expansion-panel>
          <v-expansion-panel-header>
            <v-checkbox v-model="addService" class="ma-0" :value="service" color="orange lighten-2" hide-details="true">
              <template #label>
                <span class="text-caption text-md-body-2">{{ service.service_name }}</span>
              </template>
            </v-checkbox>
          </v-expansion-panel-header>

          <v-expansion-panel-content>
            <v-row dense>
              <v-col cols="auto">
                <ParagraphSpacing>
                  <template #textLeft> Harga: </template>
                  <template #textRight>
                    <Paragraph class="text-caption text-md-body-2 red--text text--lighten-2">
                      <span class="text-caption">Rp</span> {{ currencyFormat(service.price) }}
                    </Paragraph>
                  </template>
                </ParagraphSpacing>
              </v-col>
              <v-col cols="12">
                <Paragraph class="text-caption text-md-body-2">Satuan: {{ service.unit }}</Paragraph>
              </v-col>
            </v-row>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-col>
    </v-row>
    <v-row v-if="services.per_page !== services.total">
      <v-col cols="12">
        <v-pagination
          v-model="current_page"
          :length="services.last_page"
          :total-visible="services.per_page"
          @input="input()"
          @next="next()"
          @previous="prev()"
          color="orange lighten-2 grey--text text--darken-4"
          circle
        />
      </v-col>
    </v-row>
  </v-expansion-panels>
</template>
