export const data = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
      {
        label: 'Data One',
        backgroundColor: '#f87979',
        data: [40, 39, 10, 40, 39, 80, 40]
      }
    ]

    const fetchDailyStatistics = async () => {
        try {
          const response = await axios.get('/api/daily-statistics');
          const data = response.data;
  
          if (data && data.length > 0) {
            chartData.value.labels = data.map(item => item.date);
            chartData.value.datasets[0].data = data.map(item => item.contract_count);
          } else {
            chartData.value.labels = [];
            chartData.value.datasets[0].data = [];
          }
        } catch (error) {
          console.error('Error fetching daily statistics:', error);
        }
    };
  
    mounted(() => {
    fetchDailyStatistics();
    });




  }


/*
export default {
    components: {
      Line,
    },
    data() {
      const data = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [
          {
            label: '契約数',
            borderColor: '#42A5F5',
            fill: false, // 塗りつぶしを無効にする
            data: [40, 39, 10, 40, 39, 80, 40]
          },
        ],
      };
  
      const chartOptions = {
        responsive: true,
        plugins: {
          legend: {
            display: true,
          },
          title: {
            display: true,
            text: '日別契約数チャート',
          },
        },
        scales: {
          x: {
            type: 'time', // x軸を時間軸に設定
            time: {
              unit: 'day', // 単位を日付に設定
              tooltipFormat: 'YYYY-MM-DD', // ツールチップのフォーマット
              displayFormats: {
                day: 'YYYY-MM-DD', // x軸の表示フォーマット
              },
            },
            title: {
              display: true,
              text: '日付',
            },
          },
          y: {
            title: {
              display: true,
              text: '契約数',
            },
            ticks: {
              min: 0,
            },
          },
        },
      };
  
      const fetchDailyStatistics = async () => {
        try {
          const response = await axios.get('/api/daily-statistics');
          const data = response.data;
  
          if (data && data.length > 0) {
            chartData.value.labels = data.map(item => item.date);
            chartData.value.datasets[0].data = data.map(item => item.contract_count);
          } else {
            chartData.value.labels = [];
            chartData.value.datasets[0].data = [];
          }
        } catch (error) {
          console.error('Error fetching daily statistics:', error);
        }
      };
  
      mounted(() => {
        fetchDailyStatistics();
      });
  
      return {
        chartData,
        chartOptions,
      };
  
    },
  };

      */