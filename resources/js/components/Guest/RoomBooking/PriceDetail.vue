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
    ...mapState(['roomCart', 'checkIn', 'checkOut', 'nightCount']),
    totalPrice() {
      const pricesRoom = this.roomCart.map((item) => item.price.originPrice * item.roomCount)
      const totalPrice = pricesRoom.length
        ? pricesRoom.reduce((prev, current) => prev + current) * this.nightCount
        : '0'
      return totalPrice
    },
  },
}
</script>

<template>
  <div class="text-body-2 text-md-subtitle-2">
    <ParagraphSpacing textLeft="Checkin" :textRight="checkIn" />
    <ParagraphSpacing textLeft="Checkout" :textRight="checkOut" />
    <ParagraphSpacing textLeft="Lama inap" :textRight="`${nightCount} malam`" />
    <v-divider />
    <ParagraphSpacing>
      <template #textLeft><Paragraph>Total harga</Paragraph></template>
      <template #textRight>
        <OriginPrice :price="totalPrice" />
      </template>
    </ParagraphSpacing>
  </div>
</template>
