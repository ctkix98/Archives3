import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
//import { setDefaultHeaders, setDefaultBaseUrl } from '@/utils/fetchJson.js';

const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '';
const urlApi = document.querySelector('meta[name="api-base-url"]')?.getAttribute('content') ?? '';

setDefaultHeaders({ 'X-CSRF-TOKEN': csrfToken });
setDefaultBaseUrl(urlApi);

const app = createApp(App);
app.use(router); // ✅ Ajouter le router ici
app.mount('#app');
