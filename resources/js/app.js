import './bootstrap';
import '../sass/app.scss'

import { createApp } from 'vue/dist/vue.esm-bundler';

import AdminPanel from './AdminPanel.vue'


let app=createApp()
app.component('admin-panel', AdminPanel)

app.mount('#app');
