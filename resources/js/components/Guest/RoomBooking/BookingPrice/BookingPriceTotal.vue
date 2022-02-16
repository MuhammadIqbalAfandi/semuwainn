<script>
import { mapState, mapGetters } from 'vuex'
import Paragraph from '@/components/Shared/Paragraph.vue'
import ParagraphSpacing from '@/components/Shared/ParagraphSpacing.vue'
import OriginPrice from '@/components/Shared/OriginPrice.vue'
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
      const roomPrice = this.roomCart.map((item) => item.price)
      return roomPrice.reduce((prev, current) => prev + current) * this.nightCount || 0
    },
    servicePrice() {
      const roomPrice = this.serviceCart.map((item) => item.price)
      return roomPrice.length
        ? roomPrice.reduce((prev, current) => prev + current) * this.roomCart.length * this.nightCount
        : 0
    },
    totalPrice() {
      return this.roomPrice + this.servicePrice
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
        <Paragraph class="text-caption red--text">* sudah termasuk jumlah kamar x lama inap</Paragraph>
      </template>
      <template #textRight>
        <OriginPrice class="text-end" :price="roomPrice" />
      </template>
    </ParagraphSpacing>

    <ParagraphSpacing v-if="serviceCart.length">
      <template #textLeft>
        <Paragraph>Total harga layanan</Paragraph>
        <Paragraph class="text-caption red--text">* sudah termasuk jumlah kamar x lama inap</Paragraph>
      </template>
      <template #textRight>
        <OriginPrice class="text-end" :price="servicePrice" />
      </template>
    </ParagraphSpacing>

    <ParagraphSpacing v-if="hideTotalPrice">
      <template #textLeft>
        <Paragraph>Total harga </Paragraph>
        <Paragraph class="text-caption red--text">* harga yang anda harus bayar ketika checkin</Paragraph>
      </template>
      <template #textRight>
        <OriginPrice class="text-end" :price="totalPrice" />
      </template>
    </ParagraphSpacing>
  </div>
</template>
