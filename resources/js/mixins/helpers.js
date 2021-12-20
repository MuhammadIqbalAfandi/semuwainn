import dayjs from 'dayjs'

export default {
  methods: {
    currencyFormat: (v) => new Intl.NumberFormat({ minimumFractionDigits: 3 }).format(v),
    dateFormat: (v) => dayjs(v).format('dddd, DD MMM YYYY'),
  },
}
