
require('./bootstrap');

window.Vue        = require('vue');
window.VueRouter  = require('vue-router').default;
window.VueAxios   = require('vue-axios').default;
window.Axios      = require('axios').default;
window.Datatable  = require('vue2-datatable-component');
let AppLayout     = require('./components/App.vue');

// untuk template
const Login   = Vue.component('Login',require('./components/Login.vue'));
const Home   = Vue.component('Home',require('./components/Home.vue'));

Vue.use(VueRouter,VueAxios,Axios,Datatable);

const routes = [
  {
    name :'Login',
    path : '/',
    component : Login
  },
  {
  name :'Home',
  path : '/home',
  component : Home
},
];




const router = new VueRouter({mode:'history',routes:routes});

new Vue(
  Vue.util.extend(
    {router},
    AppLayout
  )
).$mount('#app');
