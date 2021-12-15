export default {
  data() {
    return {
      rules: {
        notZero: (v) => v >= 1 || 'Nilai tidak boleh 0',
        required: (v) => !!v || 'Nilai tidak boleh kosong',
        lessThan50: (v) => v.length <= 50 || 'Nilai tidak boleh lebih dari 50',
        lessThan250: (v) => v.length <= 250 || 'Nilai tidak boleh lebih dari 255',
        numeric: (v) => {
          const re = /^[0-9\b]+$/
          return re.test(v) || 'Nilai harus angka'
        },
        digitsLessThan100: (v) => v <= 100 || 'Nilai tidak boleh lebih dari 100',
      },
    }
  },
}
