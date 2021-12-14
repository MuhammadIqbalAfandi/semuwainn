export default {
  methods: {
    currencyFormat: (v) => new Intl.NumberFormat({ minimumFractionDigits: 3 }).format(v),
  },
}
