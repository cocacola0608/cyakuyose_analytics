require('./bootstrap');

import Vue from 'vue'  // requireからimportに変更
import DailyStatisticsChart from './components/DailyStatisticsChart.vue';

// Vueコンポーネントの登録
//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    components: {
        DailyStatisticsChart,
    },
});
