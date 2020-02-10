import Vue from 'vue'
import Vuex from 'vuex'
import orderForm from './modules/OrderForm/index'

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    orderForm,
  },
  strict: false,
})
