require('./bootstrap')

import { createApp } from 'vue'
import Welcome from './components/Welcome'
import router from './router'
import Auth from './Auth.js';
import store from "./store/store";
import Toast from "vue-toastification";
import {globalMixin} from "./mixin/mixin";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";

const app = createApp({})
app.config.globalProperties.auth = Auth

// app.component('welcome', Welcome)
app.use(router)
app.use(store)
app.mixin(globalMixin)
const options = {
    // You can set your default options here
};

app.use(Toast, options);
app.mount('#app')
