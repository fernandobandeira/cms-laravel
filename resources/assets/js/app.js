
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue';
import Vuetify from 'vuetify'
import Axios from 'axios';

import Layout from './components/Layout.vue';
import Login from './components/Login.vue';
import Navbar from './components/Navbar.vue';
import Sidenav from './components/Sidenav.vue';
import Gerenciadores from './components/Gerenciadores.vue';
import Datatable from './components/Datatable.vue';

window.axios = Axios;

Vue.use(Vuetify);

import './tinymce';
import TinyMCE from 'tinymce-vue-2';
Vue.component('tinymce', TinyMCE);

Vue.component('login', Login);
Vue.component('navbar', Navbar);
Vue.component('sidenav', Sidenav);
Vue.component('gerenciadores', Gerenciadores);
Vue.component('datatable', Datatable);
Vue.component('layout', Layout);

import GenericoProdutoIndex from './components/modules/generico/produto/Index.vue';
import GenericoProdutoForm from './components/modules/generico/produto/Form.vue';
import GenericoCategoriaProdutoIndex from './components/modules/generico/categoriaproduto/Index.vue';
import GenericoCategoriaProdutoForm from './components/modules/generico/categoriaproduto/Form.vue';

Vue.component('generico-produto-index', GenericoProdutoIndex);
Vue.component('generico-produto-form', GenericoProdutoForm);
Vue.component('generico-categoriaproduto-index', GenericoCategoriaProdutoIndex);
Vue.component('generico-categoriaproduto-form', GenericoCategoriaProdutoForm);

const app = new Vue({
    el: '#app',
    data: {
        isActive: false
    },
    mounted: function() {
        this.isActive = true;
    }
});
