import Vue from 'vue'
import App from './App.vue'

import 'vue-event-calendar/dist/style.css' //^1.1.10, CSS has been extracted as one file, so you can easily update it.
import vueEventCalendar from 'vue-event-calendar/src/vue-event-calendar.vue'
Vue.use(vueEventCalendar, {locale: 'pt-br'}) //locale can be 'zh' , 'en' , 'es', 'pt-br', 'ja', 'ko', 'fr'

new Vue({
  el: '#app',
  render: h => h(App)
})
