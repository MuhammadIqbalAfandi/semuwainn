<script>
import Paragraph from '@/shared/Paragraph.vue'
import ParagraphSpacing from '@/shared/ParagraphSpacing.vue'
import OriginPrice from '@/shared/OriginPrice.vue'

export default {
  props: {
    priceDetail: Object,
  },
  components: {
    ParagraphSpacing,
    Paragraph,
    OriginPrice,
  },
}
</script>

<template>
  <div class="text-body-2 text-md-subtitle-2">
    <ParagraphSpacing textLeft="Checkin" :textRight="priceDetail.checkinDate" />
    <ParagraphSpacing textLeft="Checkout" :textRight="priceDetail.checkoutDate" />
    <ParagraphSpacing textLeft="Lama inap" :textRight="priceDetail.stayingDate + ' malam'" />
    <v-divider />
    <ParagraphSpacing>
      <template #textLeft><Paragraph>Total harga</Paragraph></template>
      <template #textRight><OriginPrice id="IDR" :price="priceDetail.totalPrice" /></template>
    </ParagraphSpacing>
  </div>
</template>
