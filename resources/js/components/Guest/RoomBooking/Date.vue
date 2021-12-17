<script>
import { mapActions } from 'vuex'
import dayjs from 'dayjs'

import Paragraph from '@/shared/Paragraph.vue'

export default {
  components: {
    Paragraph,
  },
  data() {
    return {
      checkIn: dayjs().toISOString().substring(0, 10),
      checkOut: null,
    }
  },
  methods: {
    ...mapActions(['setCheckIn', 'setCheckOut', 'setNightCount']),
  },
  computed: {
    nightCount() {
      const dr = dayjs(this.checkOut).diff(this.checkIn, 'day')
      this.setNightCount(dr)
      return dr
    },
    checkInMin() {
      return dayjs().toISOString()
    },
    checkOutMin() {
      const d = new Date(this.checkIn)
      return dayjs(d).add(1, 'day').toISOString()
    },
    checkInDateFormatted() {
      const d = new Date(this.checkIn)
      const df = this.checkIn ? dayjs(this.checkIn).format('ddd, DD MMM YYYY') : ''
      this.checkOut = dayjs(d).add(1, 'day').toISOString().substring(0, 10)
      this.setCheckIn(df)
      return df
    },
    checkOutDateFormatted() {
      const df = this.checkOut ? dayjs(this.checkOut).format('ddd, DD MMM YYYY') : ''
      this.setCheckOut(df)
      return df
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
                    v-model="checkInDateFormatted"
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
              v-model="checkIn"
              :min="checkInMin"
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
                    v-model="checkOutDateFormatted"
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
              v-model="checkOut"
              :min="checkOutMin"
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
