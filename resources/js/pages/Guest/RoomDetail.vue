<script>
import { mapActions } from 'vuex'
import { Head } from '@inertiajs/inertia-vue'

import GuestLayout from '@/layouts/Guest.vue'
import Paragraph from '@/shared/Paragraph.vue'
import TextField from '@/shared/TextField.vue'
import PhotoGrid from '@/components/Guest/RoomDetail/PhotoGrid.vue'
import PriceRange from '@/components/Guest/RoomDetail/PriceRange.vue'
import Price from '@/components/Guest/RoomDetail/Price.vue'
import Facilities from '@/components/Guest/RoomDetail/Facilities.vue'
import mixinRules from '@/mixins/rules'

export default {
  layout: GuestLayout,
  props: {
    room: Object,
  },
  components: {
    Paragraph,
    TextField,
    PhotoGrid,
    PriceRange,
    Price,
    Facilities,
    Head,
  },
  mixins: [mixinRules],
  data() {
    return {
      roomCount: 1,
      guestCount: 1,
      rules: {
        lessOrEqualThanRoomAvailable: (v) =>
          v <= this.room.prices[0].roomAvailable || 'Nilai melebihi ruangan yang tersediah',
      },
    }
  },
  methods: {
    ...mapActions(['addRoomCart']),
    roomOrder(id) {
      if (this.$refs.form.validate()) {
        const { prices, thumbnail, roomName } = this.room
        const price = prices.find((price) => price.id === id)
        this.addRoomCart({
          price,
          thumbnail,
          roomName,
          roomCount: this.roomCount,
          guestCount: this.guestCount,
        })
      }
    },
  },
}
</script>

<template>
  <div>
    <Head title="Detail Ruangan" />

    <v-row no-gutters>
      <v-col cols="12">
        <PhotoGrid :photoGrid="room.thumbnail" />
      </v-col>

      <v-col cols="12">
        <PriceRange
          :priceRange="room.priceRange"
          :roomName="room.roomName"
          :typeBedRoom="room.typeBedRoom"
          :numberOfGuest="room.numberOfGuest"
        />
      </v-col>
    </v-row>

    <v-row dense>
      <v-col cols="12">
        <v-card>
          <v-card-text>
            <v-row>
              <v-col cols="12">
                <Paragraph class="text-body-2 text-md-h5 font-weight-bold">Fasilitas</Paragraph>
              </v-col>

              <v-col cols="12">
                <Facilities :facilities="room.facilities" />
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
      </v-col>

      <v-col cols="12" md="4">
        <v-card height="fit-content">
          <v-card-text>
            <v-form ref="form">
              <v-row justify="center" dense>
                <v-col cols="12">
                  <TextField
                    v-model="roomCount"
                    class="text-caption text-sm-subtitle-1"
                    :rules="[rules.numeric, rules.notZero, rules.lessOrEqualThanRoomAvailable]"
                    placeholder="Jumlah Kamar"
                    hint="Jumlah Kamar yang akan dipesan"
                  />
                </v-col>

                <v-col cols="12">
                  <TextField
                    v-model="guestCount"
                    class="text-caption text-sm-subtitle-1"
                    :rules="[rules.numeric, rules.notZero]"
                    placeholder="Banyak Tamu"
                    hint="Tamu yang akan meginap disatu kamar"
                  />
                </v-col>
              </v-row>
            </v-form>
          </v-card-text>
        </v-card>
      </v-col>

      <v-col sm="12" md="8">
        <Price @roomOrder="roomOrder" :prices="room.prices" />
      </v-col>
    </v-row>
  </div>
</template>
