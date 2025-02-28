document.addEventListener('DOMContentLoaded', function () {
  chartOppByStage();
  chartOppPipeline();
});

function chartOppByStage() {
  const canvaOppByStage = document.getElementById('chartOppByStage');
  const dataOppStage = JSON.parse(canvaOppByStage.dataset.oppstage);
  const labelsStage = Object.keys(dataOppStage);
  const dataStage = Object.values(dataOppStage);

  new Chart( canvaOppByStage.getContext('2d'), {
    type: 'pie',
    data: {
      labels: labelsStage,
      datasets: [{
        label: 'Opportunities by Stage',
        data: dataStage,
        backgroundColor: ['#88352b', '#d0755c', '#ebceb1', '#eee9de', '#929489', '#798187', '#576169'],
        borderColor: '#edf2fb',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      legend: {
        position: 'left',
      },
    }
  });

}

function chartOppPipeline() {
  const canvaOppPipeline = document.getElementById('chartOppPipeline');
  const dataPipeline = JSON.parse(canvaOppPipeline.dataset.opppipeline);
  const labelsPipeline = dataPipeline.map( item => item.stage );
  const valuesPipeline = dataPipeline.map( item => item.total_value );
  
  console.log( valuesPipeline )

  new Chart( canvaOppPipeline.getContext('2d'), {
    type: 'horizontalBar',
    data: {
      labels: ['Stage 1', 'Stage 2', 'Stage 3', 'Stage 4', 'Stage 5', 'Stage 6', 'Stage 7'],
      //labels: labelsPipeline,
      datasets: [{
        label: 'Opportunities by Pipeline',
        data: [700000, 600000, 500000, 400000, 300000, 200000, 100000],
        //data: valuesPipeline,
        backgroundColor: ['#f94144', '#577590', '#f3722c', '#43aa8b', '#f8961e', '#90be6d', '#f9c74f'],
        borderColor: '#FFF',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      legend: false,
      scales: {
        xAxes: [{
          ticks: {
            callback: function(value) {
              return value.toLocaleString('en-EN');
            }
          }
        }]
      },
      tooltips: {
        callbacks: {
          label: function(tooltipItem, data) {
            let value = tooltipItem.xLabel;
            return '$' + value.toLocaleString('en-EN');
          }
        }
      },
    }
  });

}