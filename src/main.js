import Vue from 'vue';
import axios from 'axios';
import App from './App.vue';

Vue.config.productionTip = false;

axios.interceptors.request.use(
  config => {
    config.baseURL = 'http://skylogik.test/api/';
    config.timeout = 5000;
    // config.headers = { 'Content-Type': 'application/x-www-form-urlencoded' };

    return config;
  },
  err => {
    console.log(err);
  },
);

new Vue({
  render: h => h(App),
}).$mount('#app');
