
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'

import TinyMce from '@tinymce/tinymce-vue'

import {routes} from './routes'
import StoreData from './store'
import MainContent from './components/MainContent.vue';

import BootstrapVue from 'bootstrap-vue'

// Vuetify
import Vuetify from 'vuetify'
import colors from 'vuetify/es5/util/colors'

Vue.use(Vuetify)

import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'

import { swiper, swiperSlide } from 'vue-awesome-swiper'
import mobile from 'is-mobile'
// require swiper styles
import 'swiper/dist/css/swiper.css'

Vue.use(VueRouter)
Vue.use(Vuex)

Vue.use(BootstrapVue)
Vue.component('tinyMce', TinyMce)

Vue.component('swiper', swiper)
Vue.component('swiperSlide', swiperSlide)

// import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
/* ============================================================================
 * Atoms
 * ========================================================================= */
Vue.component('primaryBtn', require('./Atoms/Button/primaryBtn.vue').default)
Vue.component('secondaryBtn', require('./Atoms/Button/secondaryBtn.vue').default)

/* ============================================================================
 * Molecules
 * ========================================================================= */
Vue.component('cardTop', require('./Molecules/CardTop.vue').default)

const store = new Vuex.Store(StoreData)
const router = new VueRouter({
  routes,
  mode: 'history'
})


const app = new Vue({
  el: '#app',
  data() {
    return {
    }
  },
  router,
  store,
  components: {
    MainContent,
  }
})
