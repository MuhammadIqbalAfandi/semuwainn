<script>
import { mapActions, mapState } from 'vuex'

import Paragraph from '@/shared/Paragraph.vue'
import ParagraphSpacing from '@/shared/ParagraphSpacing.vue'
import mixinHelpers from '@/mixins/helpers'

export default {
  props: {
    services: Object,
  },
  components: {
    Paragraph,
    ParagraphSpacing,
  },
  mixins: [mixinHelpers],
  mounted() {
    this.addService = this.serviceCart
  },
  data() {
    return {
      addService: [],
      current_page: this.services.current_page,
    }
  },
  watch: {
    addService: {
      handler(val, oldVal) {
        this.addServiceCart(val)
      },
    },
    serviceCart: {
      handler(val, oldVal) {
        this.addService = val
      },
    },
  },
  computed: {
    ...mapState(['serviceCart']),
  },
  methods: {
    ...mapActions(['addServiceCart']),
    next() {
      this.$inertia.get(this.services.next_page_url, '')
    },
    prev() {
      this.$inertia.get(this.services.prev_page_url, '')
    },
    input() {
      this.$inertia.get(`${this.services.path}/?page=${this.current_page}`, '')
    },
  },
}
</script>

<template>
  <v-card>
    <v-card-title class="text-body-2 text-md-h5" tag="h3">Pelayanan tambahan</v-card-title>
    <v-card-subtitle class="mb-0 text-caption text-md-body-2" tag="p">
      Mau menambah pelayanan yang membuatmu makin nyaman? Pilih disini. Layanan tergantung persediaan dan mungkin
      dikenakan biaya tambahan.
    </v-card-subtitle>

    <v-divider />

    <v-card-text>
      <v-expansion-panels>
        <v-row dense>
          <v-col v-for="service in services.data" :key="service.id" cols="12" sm="6">
            <v-expansion-panel>
              <v-expansion-panel-header>
                <v-checkbox
                  v-model="addService"
                  class="ma-0"
                  :value="service"
                  color="orange lighten-2"
                  hide-details="true"
                >
                  <template #label>
                    <span class="text-caption text-md-body-2">{{ service.service_name }}</span>
                  </template>
                </v-checkbox>
              </v-expansion-panel-header>

              <v-expansion-panel-content>
                <v-row dense>
                  <v-col cols="12">
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
                    <ParagraphSpacing>
                      <template #textLeft>Satuan:</template>
                      <template #textRight>
                        <Paragraph class="text-caption text-md-body-2">{{ service.unit }}</Paragraph>
                      </template>
                    </ParagraphSpacing>
                  </v-col>
                </v-row>
              </v-expansion-panel-content>
            </v-expansion-panel>
          </v-col>
        </v-row>
      </v-expansion-panels>

      <v-row v-if="services.per_page !== services.total" class="mt-2" dense>
        <v-col cols="12">
          <v-pagination
            v-model="current_page"
            :length="services.last_page"
            :total-visible="services.per_page"
            @input="input"
            @next="next"
            @previous="prev"
            color="orange lighten-2 grey--text text--darken-4"
            circle
          />
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>
