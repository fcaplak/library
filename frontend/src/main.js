import Vue, { createApp } from '@vue/compat'
import BootstrapVue from 'bootstrap-vue'
import SimpleTypeahead from 'vue3-simple-typeahead';
import 'vue3-simple-typeahead/dist/vue3-simple-typeahead.css'; //Optional default CSS

import App from './App.vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)

const app = createApp(App)
app.use(SimpleTypeahead);
app.mount('#app')
