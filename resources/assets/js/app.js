
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue';
import ElementUI from 'element-ui';
import '../theme/build/index.css';
import lang from 'element-ui/lib/locale/lang/pt-br';
import locale from 'element-ui/lib/locale';
import Axios from 'axios';

import Layout from './components/Layout.vue';
import Login from './components/Login.vue';
import Navbar from './components/Navbar.vue';
import Sidenav from './components/Sidenav.vue';
import Gerenciadores from './components/Gerenciadores.vue';
import Datatable from './components/Datatable.vue';
import Tree from './components/Tree.vue';
import NestedSelect from './components/NestedSelect.vue';

window.axios = Axios;
window.vue = Vue;

locale.use(lang);
Vue.use(ElementUI);

import './tinymce';
import Helpers from './helpers';
import VueTinymce from 'vue-tinymce';
Vue.use(VueTinymce);
window.helpers = Helpers;

Vue.component('login', Login);
Vue.component('navbar', Navbar);
Vue.component('sidenav', Sidenav);
Vue.component('gerenciadores', Gerenciadores);
Vue.component('datatable', Datatable);
Vue.component('layout', Layout);
Vue.component('tree', Tree);
Vue.component('nestedselect', NestedSelect);

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
