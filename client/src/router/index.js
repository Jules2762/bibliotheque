// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
// import shop from '../views/client/shop.vue';
import connection from '../views/client/connection.vue';
import inscription from '../views/client/inscription.vue';
import accueil from '../views/client/accueil.vue'; 
import home from '../views/client/home.vue'
import shop from '../views/client/shop.vue'
import produit from '../views/admin/produit.vue'
import dashboard from '../views/admin/dashboard.vue'
import bibliotheque from '../views/admin/bibliotheque.vue'
import video from '../views/admin/video.vue'
const routes = [
  {
    path: '/',
    name: 'ACCUEIL',
    component: accueil,
  },
  {
    path: '/signin',
    name: 'CONNECTION',
    component: connection,
  },
  {
    path: '/signup',
    name: 'INSCRIPTION',
    component: inscription,
  },
  {
    path: '/home',
    name: 'HOME',
    component: home,
  },
  {
    path: '/shop',
    name: 'SHOP',
    component: shop,
  },
  {
    path: '/admin/produit',
    name: 'ADMINPRDUIT',
    component: produit,
  },
  {
    path: '/admin/dashboard',
    name: 'ADMINDASHBOARD',
    component: dashboard,
  },
  {
    path: '/admin/video',
    name: 'ADMINVIDEO',
    component: video,
  },
  
  {
    path: '/admin/bibliotheque',
    name: 'ADMINBIBLIOTHEQUE',
    component: bibliotheque,
  },
  // Ajoutez ici d'autres routes
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});


export default router;
