import { createApp } from 'vue';
import App from './App.vue';
import router from './routes';
import './assets/main.css'; // seu Tailwind + globals
import 'flowbite/dist/flowbite.css'; // Flowbite CSS
import "./assets/main.css";

createApp(App).use(router).mount('#app');