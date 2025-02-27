document.addEventListener('DOMContentLoaded', function () {
  chartOppByStage();
});

function chartOppByStage() {
  const canvaOppByStage = document.getElementById('chartOppByStage').getContext('2d')
  const dataOppStage = JSON.parse(document.getElementById('opp-stages-data').textContent);
  const labelsStage = Object.keys(dataOppStage);
  const dataStage = Object.values(dataOppStage);

  new Chart( canvaOppByStage, {
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