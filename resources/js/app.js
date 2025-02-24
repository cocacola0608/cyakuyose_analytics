require('./bootstrap');

import Vue from 'vue'  // requireからimportに変更

// Vueコンポーネントの登録
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// Vueインスタンスの作成
const app = new Vue({
    el: '#app'
});
