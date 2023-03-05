import './bootstrap';
import '../css/app.css';

import { createApp } from 'vue'
import App from './App.vue'
import store from './store'
import router from './router'

import { createI18n, useI18n } from 'vue-i18n'
import {defaultLocale} from "./i18n";
import {languages} from "./i18n";

const messages = Object.assign(languages);
const localeStorageLang = localStorage.getItem('lang');

const i18n = createI18n({
    legacy: false,
    locale: localeStorageLang || defaultLocale,
    fallbackLocale: 'kz', // set fallback locale
    globalInjection: true,
    messages,
})

createApp(App)
    .use(store)
    .use(i18n)
    .use(router)
    .mount('#app')
