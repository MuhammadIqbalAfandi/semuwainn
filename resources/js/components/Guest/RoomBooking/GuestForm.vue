<script>
import { mapActions, mapState } from 'vuex'

import TextField from '@/shared/TextField.vue'
import mixinRules from '@/mixins/rules'

export default {
  components: {
    TextField,
  },
  mixins: [mixinRules],
  mounted() {
    this.$refs.form.validate()
  },
  methods: {
    ...mapActions('roomBooking', ['setValid', 'setName', 'setNik', 'setPhone', 'setEmail']),
  },
  computed: {
    ...mapState('roomBooking', ['valid', 'name', 'nik', 'phone', 'email', 'valid']),
    updateValid: {
      get() {
        return this.valid
      },
      set(v) {
        this.setValid(v)
      },
    },
    updateName: {
      get() {
        return this.name
      },
      set(v) {
        this.setName(v)
      },
    },
    updateNik: {
      get() {
        return this.nik
      },
      set(v) {
        this.setNik(v)
      },
    },
    updatePhone: {
      get() {
        return this.phone
      },
      set(v) {
        this.setPhone(v)
      },
    },
    updateEmail: {
      get() {
        return this.email
      },
      set(v) {
        this.setEmail(v)
      },
    },
  },
}
</script>

<template>
  <v-form ref="form" v-model="updateValid">
    <v-card>
      <v-card-title class="text-body-2 text-md-h5">Detail Pemesanan</v-card-title>

      <v-card-text>
        <TextField
          v-model="updateName"
          :rules="[rules.required, rules.lessThan50]"
          :error-messages="$parent.errors.name"
          class="text-caption text-sm-subtitle-1"
          label="Nama"
          hint="Seperti di KTP/Paspor/SIM (tanpa tanda baca dan gelar)"
          autofocus
        />

        <TextField
          v-model="updateNik"
          :rules="[rules.required, rules.numeric, rules.lessThan16]"
          :error-messages="$parent.errors.nik"
          class="text-caption text-sm-subtitle-1"
          label="Nik"
          hint="NIK (kami menjamin kerahasiaan nik)"
        />

        <TextField
          v-model="updatePhone"
          :rules="[rules.required, rules.numeric, rules.lessThan12]"
          :error-messages="$parent.errors.phone"
          class="text-caption text-sm-subtitle-1"
          label="Nomor Telepon"
          hint="Nomor Telepon"
        />

        <TextField
          v-model="updateEmail"
          :rules="[rules.required, rules.email]"
          :error-messages="$parent.errors.email"
          class="text-caption text-sm-subtitle-1"
          label="Email"
          hint="E-ticket akan dikirim ke alamat Email ini, simpan sebagai bukti pemesanan."
        />
      </v-card-text>
    </v-card>
  </v-form>
</template>
