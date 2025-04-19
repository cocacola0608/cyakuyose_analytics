<template>
  <div>
    <h2>日別契約数チャート</h2>
    <Line :data="data"  />
  </div>
</template>

<script>
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
} from 'chart.js'
import { Line } from 'vue-chartjs'
import Axios from 'axios'

ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
)

export default {
  components: {
    Line
  },
  data() {
    return {
      data: {
        labels: [],
        datasets: [
          {
            label: 'キャクヨセ',
            backgroundColor: '#f87979',
            data: []
          },
          {
            label: 'キャクヨセplus',
            backgroundColor: '#aaaaaa',
            data: []
          }
        ]
      }
   }
  },
  mounted () {
    const self = this
    Axios.get('/api/daily-statistics')
    .then((response) => {
      if (response && response.data.length > 0) {
        var countBasic = 0;
        var countPlus = 0;
        for (let i = 0; i < response.data.length; i++) {
          if (response.data[i]["type"] == "basic") {
            self.data.datasets[0].data[countBasic] = response.data[i]["contract_count"];
            self.data.labels[countBasic] = response.data[i]["date"];
            countBasic++;
          } else {
            self.data.datasets[1].data[countPlus] = response.data[i]["contract_count"];
            countPlus++;
          }
        }
      } else {
        self.data.labels = [];
        self.data.datasets[0].data = [];
        self.data.datasets[1].data = [];
      }
    })
  }
}

</script>

<style scoped>
.chart-container {
  position: relative;
  height: 40vh;
  width: 80vw;
}
</style> 