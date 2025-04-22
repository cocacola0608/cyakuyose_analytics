<template>
  <div style="
        width: 90%;
        max-width: 1000px;
        margin: auto;
    ">
    <h1 style="text-align: center;font-size: 24px;">キャクヨセ日別総友だち数グラフ</h1>
    <div id="app">
      <canvas id="myChart"></canvas>
      <canvas id="myPlusChart"></canvas>
    </div>
    <div class="memo">
      \そのほか情報はブログに記載しております/<br>
      <a href="https://cyakuyose.com/">https://cyakuyose.com/</a><br>
      LINEでのお問い合わせも受付中！<br>
      <a href="https://lin.ee/Hasj0DR"><img src="https://scdn.line-apps.com/n/line_add_friends/btn/ja.png" alt="友だち追加" height="36" border="0"></a>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import Chart from 'chart.js/auto';
export default {
  data() {
    return {
      labels: [],
      data: [],
      labelsPlus: [],
      dataPlus: [],
    };
  },
  methods: {
    displayGraph() {
      const ctx = document.getElementById('myChart').getContext('2d');
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: this.labels,
          datasets: [
            {
              label: 'キャクヨセ',
              data: this.data,
              borderColor: "#8EC21F",
            },
          ],
        },
      });
    },
    displayPlusGraph() {
      const ctxPlus = document.getElementById('myPlusChart').getContext('2d');
      new Chart(ctxPlus, {
        type: 'line',
        data: {
          labels: this.labelsPlus,
          datasets: [
            {
              label: 'キャクヨセplus',
              data: this.dataPlus,
              borderColor: "#CBA846",
            },
          ],
        },
      });
    },
  },
  mounted() {
    axios.get('/api/daily-statistics').then((response) => {
      this.data = response.data.map((sale) => sale.number);
      this.labels = response.data.map((sale) => sale.month);

      this.displayGraph();
    });
    axios.get('/api/daily-plus-statistics').then((response) => {
      this.dataPlus = response.data.map((sale) => sale.number);
      this.labelsPlus = response.data.map((sale) => sale.month);

      this.displayPlusGraph();
    });
  }
}

</script>

<style>
.memo {
  position: relative;
  padding: 1.5rem 1.5rem calc(1.5rem + 10px);
  border: 2px solid #000;
  margin-top: 10px;
}

.memo:after {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 10px;
  content: '';
  border-top: 2px solid #000;
  background-image: -webkit-repeating-linear-gradient(135deg, #000, #000 1px, transparent 2px, transparent 5px);
  background-image: repeating-linear-gradient(-45deg, #000, #000 1px, transparent 2px, transparent 5px);
  background-size: 7px 7px;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}

</style>