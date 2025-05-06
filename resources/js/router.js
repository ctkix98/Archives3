// resources/js/router.js
import { createRouter, createWebHistory } from 'vue-router';
import ChapterView from '@/pages/ChapterView.vue';

const routes = [
  {
    path: '/',
    redirect: '/chapter/1' // Commencer par le chapitre 1
  },
  {
    path: '/chapter/:id',
    name: 'ChapterView',
    component: ChapterView,
    props: true
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
