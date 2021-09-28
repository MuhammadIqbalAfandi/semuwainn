import Vue from 'vue'
import Vuetify from 'vuetify'
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)

const opts = {
  theme: {
    dark: true,
  },
}

export default new Vuetify(opts)
