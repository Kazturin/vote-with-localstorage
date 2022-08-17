import './bootstrap';
import '../css/app.css';

import { createApp } from 'vue'
import App from './App.vue'
import store from './store'
import router from './router'


createApp(App)
    .use(store)
    .use(router)
    .mount('#app')
