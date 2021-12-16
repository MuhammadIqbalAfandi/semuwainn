<script>
import TextField from '@/shared/TextField.vue'

export default {
  components: {
    TextField,
  },
  computed: {},
}
</script>

<template>
  <v-card>
    <v-card-title class="text-body-2 text-md-h5">Detail Pemesanan</v-card-title>
    <v-card-text>
      <TextField
        class="text-caption text-sm-subtitle-1"
        placeholder="Nama"
        hint="Seperti di KTP/Paspor/SIM (tanpa tanda baca dan gelar)"
        outlined
      />
      <TextField
        class="text-caption text-sm-subtitle-1"
        placeholder="Nik"
        hint="NIK (kami menjamin kerahasiaan nik)"
        outlined
      />
      <TextField class="text-caption text-sm-subtitle-1" placeholder="Nomor Telepon" hint="Nomor Telepon" outlined />
      <TextField
        class="text-caption text-sm-subtitle-1"
        placeholder="Email"
        hint="E-ticket akan dikirim ke alamat Email ini, simpan sebagai bukti pemesanan."
        outlined
      />
    </v-card-text>
  </v-card>
</template>
