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
      const totalPrice = pricesRoom.length
        ? pricesRoom.reduce((prev, current) => prev + current) * this.nightCount
        : '0'
      return totalPrice
    },
    servicePrice() {
      const priceService = []
      this.serviceCart.forEach((item) => {
        priceService.push(item.price)
      })
      const totalPrice = priceService.length ? priceService.reduce((prev, current) => prev + current) : '0'
      return totalPrice
    },
    totalPrice() {
      return Number(this.roomPrice) + Number(this.servicePrice) || '0'
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
      <template #textLeft>
        <Paragraph>Total harga kamar</Paragraph>
        <Paragraph class="text-caption red--text">sudah termasuk jumlah kamar x lama menginap</Paragraph>
      </template>
      <template #textRight>
        <OriginPrice class="text-end" :price="roomPrice" />
      </template>
    </ParagraphSpacing>

    <ParagraphSpacing>
      <template #textLeft>
        <Paragraph>Total harga layanan</Paragraph>
      </template>
      <template #textRight>
        <OriginPrice class="text-end" :price="servicePrice" />
      </template>
    </ParagraphSpacing>

    <ParagraphSpacing>
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
