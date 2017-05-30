
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-default/index.css';
import lang from 'element-ui/lib/locale/lang/pt-BR';
import locale from 'element-ui/lib/locale';
import Axios from 'axios';

import Form from './components/Form.vue';
import Login from './components/Login.vue';
import Navbar from './components/Navbar.vue';
import Sidenav from './components/Sidenav.vue';
import Gerenciadores from './components/Gerenciadores.vue';
import Datatable from './components/Datatable.vue';

window.axios = Axios;

locale.use(lang);

Vue.use(ElementUI);

import './tinymce';
import VueTinymce from 'vue-tinymce';
Vue.use(VueTinymce);

Vue.component('login', Login);
Vue.component('navbar', Navbar);
Vue.component('sidenav', Sidenav);
Vue.component('gerenciador-form', Form);
Vue.component('gerenciadores', Gerenciadores);
Vue.component('datatable', Datatable);

const app = new Vue({
    el: '#app',
    data: {
        isActive: false,
        form: typeof campos == 'undefined' ? '' : campos,
        editorOptions: window.editorOptions
    },
    mounted: function() {
        this.isActive = true;
    }
});
