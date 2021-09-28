export default {
  methods: {
    currencyFormat: (v) => new Intl.NumberFormat('id', { style: 'currency', currency: 'IDR' }).format(v),
  },
}
