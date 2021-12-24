import Vue from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress'
import dayjs from 'dayjs'
import id from 'dayjs/locale/id'
import vuetify from '@/plugins/vuetify'
import store from '@/store'

dayjs.locale(id)

InertiaProgress.init({
  color: '#bdad8f',
})

Vue.prototype.$route = route

createInertiaApp({
  resolve: (name) => require(`./pages/${name}`),
  setup({ el, App, props }) {
    new Vue({
      vuetify,
      store,
      render: (h) => h(App, props),
    }).$mount(el)
  },
})
