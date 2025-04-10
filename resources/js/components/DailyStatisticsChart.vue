<template>
  <div>
    <h2>日別契約数チャート</h2>
    <Bar :chart-data="chartData" :options="chartOptions" />
  </div>
</template>

<script>
import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js';

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

export default {
  components: {
    Bar,
  },
  data() {
    return {
      chartData: {
        labels: [], // 日付ラベル
        datasets: [
          {
            label: '契約数',
            backgroundColor: '#42A5F5',
            data: [], // 契約数データ
          },
        ],
      },
      chartOptions: {
        responsive: true,
        maintainAspectRatio: false,
      },
    };
  },
  mounted() {
    this.fetchDailyStatistics();
  },
  methods: {
    async fetchDailyStatistics() {
      try {
        const response = await axios.get('/api/daily-statistics');
        const data = response.data;

        this.chartData.labels = data.map(item => item.date);
        this.chartData.datasets[0].data = data.map(item => item.contract_count);
      } catch (error) {
        console.error('Error fetching daily statistics:', error);
      }
    },
  },
};
</script>

<style scoped>
.chart-container {
  position: relative;
  height: 40vh;
  width: 80vw;
}
</style> 