<script>
import Paragraph from '@/shared/Paragraph.vue'
import Button from '@/shared/Button.vue'

export default {
  components: { Paragraph, Button },
  props: {
    room: Object,
  },
}
</script>

<template>
  <v-card outlined hover>
    <v-card-text>
      <v-row>
        <v-col cols="12">
          <v-row>
            <v-col cols="auto">
              <v-img
                class="align-self-center rounded-sm"
                :max-width="$vuetify.breakpoint.smAndDown ? 50 : 70"
                :max-height="$vuetify.breakpoint.smAndDown ? 50 : 70"
                :src="room.thumbnail"
                alt="Thumbnail Room"
                tile
              />
            </v-col>

            <v-col>
              <Paragraph>{{ room.roomName }}</Paragraph>
              <v-row class="text-caption" dense>
                <v-col cols="auto">
                  <Paragraph>{{ room.roomCount }}x kamar</Paragraph>
                </v-col>
                <v-col cols="auto">
                  <Paragraph>{{ room.guestCount }} tamu</Paragraph>
                </v-col>
              </v-row>
            </v-col>

            <v-col cols="auto" align-self="end">
              <Button @click="$emit('orderDelete', room.id)" text x-small>Hapus</Button>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>
