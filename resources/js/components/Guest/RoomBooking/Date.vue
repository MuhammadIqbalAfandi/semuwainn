<script>
import dayjs from 'dayjs'

import Paragraph from '@/shared/Paragraph.vue'

export default {
  components: {
    Paragraph,
  },
  data() {
    return {
      checkin: dayjs().toISOString().substring(0, 10),
      checkinMin: dayjs().toISOString(),
      checkout: null,
    }
  },
  computed: {
    nightCount() {
      return dayjs(this.checkout).diff(this.checkin, 'day')
    },
    checkoutMin() {
      const d = new Date(this.checkin)
      return dayjs(d).add(1, 'day').toISOString()
    },
    checkinDateFormatted() {
      const d = new Date(this.checkin)
      this.checkout = dayjs(d).add(1, 'day').toISOString().substring(0, 10)

      return this.checkin ? dayjs(this.checkin).format('ddd, DD MMM YYYY') : ''
    },
    checkoutDateFormatted() {
      return this.checkout ? dayjs(this.checkout).format('ddd, DD MMM YYYY') : ''
    },
  },
}
</script>

<template>
  <v-card>
    <v-card-text>
      <v-row justify="space-between" align="center">
        <v-col md="auto">
          <v-menu min-width="auto" offset-y>
            <template #activator="{ on, attrs }">
              <v-row>
                <v-col cols="12">
                  <Paragraph class="text-caption text-md-body-2">Checkin</Paragraph>
                  <v-text-field
                    class="text-body-2"
                    v-model="checkinDateFormatted"
                    v-bind="attrs"
                    v-on="on"
                    color="orange lighten-2"
                    prepend-icon="mdi-calendar"
                    hide-details="true"
                    readonly
                  >
                  </v-text-field>
                </v-col>
              </v-row>
            </template>
            <v-date-picker
              v-model="checkin"
              :min="checkinMin"
              :full-width="$vuetify.breakpoint.smAndDown ? true : false"
              locale="id"
              color="orange lighten-2"
              show-adjacent-months
              no-title
              scrollable
            ></v-date-picker>
          </v-menu>
        </v-col>

        <v-col cols="auto">
          <v-row class="text-center text-caption text-md-body-2" no-gutters>
            <v-col cols="12">
              <Paragraph class="text-caption">
                <v-icon :x-small="$vuetify.breakpoint.smAndDown" :small="$vuetify.breakpoint.mdAndUp">
                  mdi-brightness-3
                </v-icon>
                {{ nightCount }}
              </Paragraph>
            </v-col>
            <v-col cols="12">
              <Paragraph>Malam</Paragraph>
            </v-col>
          </v-row>
        </v-col>

        <v-col cols="12" md="auto">
          <v-menu min-width="auto" offset-y>
            <template #activator="{ on, attrs }">
              <v-row>
                <v-col cols="12">
                  <Paragraph class="text-caption text-md-body-2">Checkout</Paragraph>
                  <v-text-field
                    class="text-body-2"
                    v-model="checkoutDateFormatted"
                    v-bind="attrs"
                    v-on="on"
                    color="orange lighten-2"
                    prepend-icon="mdi-calendar"
                    hide-details="true"
                    readonly
                  >
                  </v-text-field>
                </v-col>
              </v-row>
            </template>
            <v-date-picker
              v-model="checkout"
              :min="checkoutMin"
              :full-width="$vuetify.breakpoint.smAndDown ? true : false"
              locale="id"
              color="orange lighten-2"
              show-adjacent-months
              no-title
              scrollable
            ></v-date-picker>
          </v-menu>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>
