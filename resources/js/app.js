require('./bootstrap');

window.Vue = require('vue');

import App from './App'
import router from './router'
import store from './store'
import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/en'
import wysiwyg from "vue-wysiwyg";

Vue.use(ElementUI, { locale });
Vue.use(wysiwyg, {
    hideModules: {
        "image": true,
        "headings": true,
        // "removeFormat": true,
        "code": true
    },
});

const app = new Vue({
    el: '#app',
    router, store,
    render: h => h(App)
});
