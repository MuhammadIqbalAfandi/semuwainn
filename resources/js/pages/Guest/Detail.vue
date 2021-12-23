<script>
import { Head } from '@inertiajs/inertia-vue'

import GuestLayout from '@/layouts/Guest.vue'
import Paragraph from '@/shared/Paragraph.vue'
import ParagraphLeftIcon from '@/shared/ParagraphLeftIcon.vue'
import TextField from '@/shared/TextField.vue'
import PhotoGridDetail from '@/components/Guest/Detail/PhotoGridDetail.vue'
import PriceRangeDetail from '@/components/Guest/Detail/PriceRangeDetail.vue'
import PriceDetail from '@/components/Guest/Detail/PriceDetail.vue'
import FacilityDetail from '@/components/Guest/Detail/FacilityDetail.vue'
import mixinRules from '@/mixins/rules'

export default {
  layout: GuestLayout,
  props: {
    room: Object,
  },
  components: {
    Paragraph,
    ParagraphLeftIcon,
    TextField,
    PhotoGridDetail,
    PriceRangeDetail,
    PriceDetail,
    FacilityDetail,
    Head,
  },
  mixins: [mixinRules],
  data() {
    return {
      valid: true,
      roomCount: 1,
      guestCount: 1,
      rules: {
        lessOrEqualThanRoomAvailable: (v) => {
          return v <= this.room.prices[0].roomAvailable || `Jumlah kamar melebihi kamar yang tersediah.`
        },
        lessOrEqualThanNumberOfGuestAvailable: (v) => {
          return v <= this.room.numberOfGuest || `Jumlah tamu melebihi jumlah yang diperbolehkan.`
        },
      },
    }
  },
}
</script>

<template>
  <div>
    <Head title="Detail Ruangan" />

    <v-row no-gutters>
      <v-col cols="12">
        <PhotoGridDetail :photoGrid="room.thumbnail" />
      </v-col>

      <v-col cols="12">
        <PriceRangeDetail :priceRange="room.priceRange" :roomName="room.name" :numberOfGuest="room.numberOfGuest" />
      </v-col>
    </v-row>

    <v-row dense>
      <v-col cols="12">
        <FacilityDetail :facilities="room.facilities" />
      </v-col>

      <v-col cols="12" md="4">
        <v-card height="fit-content">
          <v-card-text>
            <v-form v-model="valid">
              <v-row justify="center" dense>
                <v-col cols="12">
                  <ParagraphLeftIcon
                    class="text-caption"
                    icon="mdi-information"
                    text="Tamu umur berapapun dianggap sebagai
                    dewasa."
                    :warning="true"
                  />
                </v-col>

                <v-col cols="12">
                  <TextField
                    v-model="roomCount"
                    class="text-caption text-sm-subtitle-1"
                    :rules="[rules.numeric, rules.notZero, rules.lessOrEqualThanRoomAvailable]"
                    label="Jumlah kamar"
                    hint="Jumlah Kamar yang akan dipesan"
                    autofocus
                  />
                </v-col>

                <v-col cols="12">
                  <TextField
                    v-model="guestCount"
                    class="text-caption text-sm-subtitle-1"
                    :rules="[rules.numeric, rules.notZero, rules.lessOrEqualThanNumberOfGuestAvailable]"
                    label="Banyak Tamu"
                    hint="Tamu yang akan meginap disatu kamar"
                  />
                </v-col>
              </v-row>
            </v-form>
          </v-card-text>
        </v-card>
      </v-col>

      <v-col sm="12" md="8">
        <PriceDetail :room="room" />
      </v-col>
    </v-row>
  </div>
</template>
