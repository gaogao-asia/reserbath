
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

Vue.use(VueRouter)
Vue.use(Vuex)

Vue.component('tinyMce', TinyMce)

const store = new Vuex.Store(StoreData)

const router = new VueRouter({
  routes,
  mode: 'history'
})


const app = new Vue({
  el: '#app',
  router,
  store,
  components: {
    MainContent,
  }
})
