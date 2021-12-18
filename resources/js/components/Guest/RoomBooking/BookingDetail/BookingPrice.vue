<script>
import { mapState } from 'vuex'

import Paragraph from '@/shared/Paragraph.vue'
import ParagraphSpacing from '@/shared/ParagraphSpacing.vue'
import OriginPrice from '@/shared/OriginPrice.vue'

export default {
  components: {
    ParagraphSpacing,
    Paragraph,
    OriginPrice,
  },
  computed: {
    ...mapState('roomBooking', ['checkIn', 'checkOut', 'nightCount']),
    ...mapState(['roomCart', 'serviceCart']),
    roomPrice() {
      const pricesRoom = this.roomCart.map((item) => item.price.originPrice * item.roomCount)
      const roomPrice = pricesRoom.length ? pricesRoom.reduce((prev, current) => prev + current) * this.nightCount : '0'
      return roomPrice
    },
    servicePrice() {
      return '0'
    },
  },
}
</script>

<template>
  <div class="text-body-2 text-md-subtitle-2">
    <ParagraphSpacing textLeft="Checkin" :textRight="checkIn" />
    <ParagraphSpacing textLeft="Checkout" :textRight="checkOut" />
    <ParagraphSpacing textLeft="Lama inap" :textRight="`${nightCount} malam`" />

    <v-divider class="my-2" />

    <ParagraphSpacing>
      <template #textLeft
        ><Paragraph>Total harga kamar</Paragraph>
        <Paragraph class="text-caption red--text"> sudah termasuk jumlah kamar dan lama menginap </Paragraph>
      </template>
      <template #textRight>
        <OriginPrice class="text-end" :price="roomPrice" />
      </template>
    </ParagraphSpacing>

    <ParagraphSpacing>
      <template #textLeft
        ><Paragraph>Total harga layanan</Paragraph>
        <Paragraph class="text-caption red--text"> sudah termasuk lama menginap </Paragraph>
      </template>
      <template #textRight>
        <OriginPrice class="text-end" :price="servicePrice" />
      </template>
    </ParagraphSpacing>
  </div>
</template>
