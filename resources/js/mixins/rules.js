export default {
  data() {
    return {
      rules: {
        notZero: (v) => v >= 1 || 'Nilai tidak boleh 0.',
        required: (v) => !!v || 'Nilai tidak boleh kosong.',
        lessThan50: (v) => v.length <= 50 || 'Nilai tidak boleh lebih dari 50.',
        lessThan250: (v) => v.length <= 250 || 'Nilai tidak boleh lebih dari 255.',
        lessThan16: (v) => v.length === 16 || 'Nilai harus 16 angka.',
        lessThan12: (v) => v.length >= 12 || 'Nilai mininal 12 angka.',
        numeric: (v) => {
          const pattern = /^[0-9\b]+$/
          return pattern.test(v) || 'Nilai harus angka.'
        },
        email: (v) => {
          const pattern =
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
          return pattern.test(v) || 'Format e-mail salah.'
        },
        digitsLessThan100: (v) => v <= 100 || 'Nilai tidak boleh lebih dari 100.',
      },
    }
  },
}
