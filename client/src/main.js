import { createApp } from 'vue'
import App from './App.vue'
import router from './router';
import './assets/tailwind.css'
import './assets/fontawesome/css/all.css'
// import './assets/css/modal.css'
// import VueSession from 'vue-session';
// var connected = JSON.parse(localStorage.getItem('connected'))
// router.beforeEach((to)=>{
//   if(to.path=='/'){
//     return true 
//   } else if (to.path=='/signin'){
//     return true
//   } else if (to.path=='/signup'){
//     return true
//   } else {

//     if(connected){
//       return true
//     } else {
//       return '/'
//     }
//   }
// })
createApp(App).use(router).mount('#app')

