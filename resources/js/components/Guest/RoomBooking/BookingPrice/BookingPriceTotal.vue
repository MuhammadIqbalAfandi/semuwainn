<script>
import { mapState } from 'vuex'

import Paragraph from '@/shared/Paragraph.vue'
import ParagraphSpacing from '@/shared/ParagraphSpacing.vue'
import OriginPrice from '@/shared/OriginPrice.vue'
import mixinHelpers from '@/mixins/helpers'

export default {
  components: {
    ParagraphSpacing,
    Paragraph,
    OriginPrice,
  },
  mixins: [mixinHelpers],
  computed: {
    ...mapState('roomBooking', ['checkIn', 'checkOut', 'nightCount']),
    ...mapState(['roomCart', 'serviceCart']),
    roomPrice() {
      const pricesRoom = this.roomCart.map((item) => Number(item.price) * Number(item.roomCount))
      const totalPrice = pricesRoom.length
        ? pricesRoom.reduce((prev, current) => Number(prev) + Number(current)) * Number(this.nightCount)
        : '0'
      return totalPrice
    },
    servicePrice() {
      const priceService = []
      this.serviceCart.forEach((item) => {
        priceService.push(item.price)
      })
      const totalPrice = priceService.length
        ? priceService.reduce((prev, current) => Number(prev) + Number(current))
        : '0'
      return totalPrice
    },
    totalPrice() {
      return Number(this.roomPrice) + Number(this.servicePrice) || '0'
    },
    hideTotalPrice() {
      return this.roomCart.length || this.serviceCart.length
    },
  },
}
</script>

<template>
  <div class="text-body-2 text-md-subtitle-2">
    <ParagraphSpacing textLeft="Checkin" :textRight="dateFormat(checkIn)" />
    <ParagraphSpacing textLeft="Checkout" :textRight="dateFormat(checkOut)" />
    <ParagraphSpacing textLeft="Lama inap" :textRight="`${nightCount} malam`" />

    <v-divider class="my-2" />

    <ParagraphSpacing v-if="roomCart.length">
      <template #textLeft>
        <Paragraph>Total harga kamar</Paragraph>
        <Paragraph class="text-caption red--text">sudah termasuk jumlah kamar x lama inap</Paragraph>
      </template>
      <template #textRight>
        <OriginPrice class="text-end" :price="roomPrice" />
      </template>
    </ParagraphSpacing>

    <ParagraphSpacing v-if="serviceCart.length">
      <template #textLeft>
        <Paragraph>Total harga layanan</Paragraph>
      </template>
      <template #textRight>
        <OriginPrice class="text-end" :price="servicePrice" />
      </template>
    </ParagraphSpacing>

    <ParagraphSpacing v-if="hideTotalPrice">
      <template #textLeft>
        <Paragraph>Total harga </Paragraph>
        <Paragraph class="text-caption red--text">harga yang anda harus bayar ketika checkin</Paragraph>
      </template>
      <template #textRight>
        <OriginPrice class="text-end" :price="totalPrice" />
      </template>
    </ParagraphSpacing>
  </div>
</template>
