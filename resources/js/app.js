require('./bootstrap');
import { createApp } from 'vue';
import DailyStatisticsChart from './components/DailyStatisticsChart.vue';

const app = createApp({});

// コンポーネントを登録
app.component('daily-statistics-chart', DailyStatisticsChart);

// アプリケーションをマウント
app.mount('#app');