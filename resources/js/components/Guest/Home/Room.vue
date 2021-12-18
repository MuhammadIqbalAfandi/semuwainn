<script>
import OriginPrice from '@/shared/OriginPrice.vue'
import Paragraph from '@/shared/Paragraph.vue'
import ParagraphLeftIcon from '@/shared/ParagraphLeftIcon.vue'
import Link from '@/shared/Link.vue'

export default {
  props: {
    rooms: Object,
  },
  components: {
    OriginPrice,
    Paragraph,
    ParagraphLeftIcon,
    Link,
  },
  data() {
    return {
      current_page: this.rooms.current_page,
    }
  },
  methods: {
    next() {
      this.$inertia.get(this.rooms.next_page_url, '', { preserveScroll: true })
    },
    prev() {
      this.$inertia.get(this.rooms.prev_page_url, '', { preserveScroll: true })
    },
    input() {
      this.$inertia.get(`${this.rooms.path}/?page=${this.current_page}`, '', { preserveScroll: true })
    },
    thumbnail(id) {
      const room = this.rooms.data.find((item) => item.id === id)
      return room.thumbnail.images[0] ?? room.thumbnail.defaultImage
    },
  },
}
</script>

<template>
  <v-row dense>
    <v-col cols="12">
      <h2 class="text-subtitle-1 text-md-h5">Kamar Tersedia</h2>
    </v-col>

    <v-col v-for="room in rooms.data" :key="room.id" cols="12">
      <Link :href="$route('room-detail.show', room.id)">
        <v-card hover>
          <v-card-text>
            <v-row>
              <v-col cols="auto">
                <v-img
                  :max-width="$vuetify.breakpoint.smAndDown ? '109' : '278'"
                  :height="$vuetify.breakpoint.smAndDown ? '100' : '200'"
                  class="align-self-center rounded-sm"
                  :src="thumbnail(room.id)"
                  alt="Thumbnail Room"
                  tile
                />
              </v-col>

              <v-col>
                <v-row class="d-flex">
                  <v-col>
                    <h3 class="mb-md-4 text-body-2 text-md-h5">{{ room.roomName }}</h3>
                    <Paragraph class="mb-md-2 text-caption text-md-body-2">Facility :</Paragraph>
                    <v-row dense>
                      <v-col cols="auto" v-for="(facility, index) in room.facilities" :key="index">
                        <Paragraph class="green--text text--lighten-2 text-caption text-md-body-2">
                          {{ facility }}
                        </Paragraph>
                      </v-col>

                      <v-col cols="auto">
                        <v-chip v-if="room.facilityCount" class="mb-0" tag="p" x-small>
                          <span>+{{ room.facilityCount }}</span>
                        </v-chip>
                      </v-col>
                    </v-row>
                  </v-col>

                  <v-col class="text-end" cols="12" md="auto" align-self="end">
                    <Paragraph class="text-caption text-md-body-2">Harga mulai dari</Paragraph>
                    <OriginPrice :price="room.originPrice" />
                    <Paragraph class="text-caption red--text text--lighten-2">
                      Sisa {{ room.roomAvailable }} kamar lagi!
                    </Paragraph>
                  </v-col>
                </v-row>
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
      </Link>
    </v-col>

    <v-col cols="12">
      <v-pagination
        v-model="current_page"
        :length="rooms.last_page"
        :total-visible="rooms.per_page"
        @input="input"
        @next="next"
        @previous="prev"
        color="orange lighten-2 grey--text text--darken-4"
        circle
      />
    </v-col>
  </v-row>
</template>
