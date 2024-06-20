
// Global defaults
Chart.defaults.global.animation.duration = 2000; // Animation duration
Chart.defaults.global.title.display = false; // Remove title
Chart.defaults.global.defaultFontColor = '#71748c'; // Font color
Chart.defaults.global.defaultFontSize = 13; // Font size for every label

// Tooltip global resets
Chart.defaults.global.tooltips.backgroundColor = '#111827'
Chart.defaults.global.tooltips.borderColor = 'blue'

// Gridlines global resets
Chart.defaults.scale.gridLines.zeroLineColor = '#3b3d56'
Chart.defaults.scale.gridLines.color = '#3b3d56'
Chart.defaults.scale.gridLines.drawBorder = false

// // Legend global resets
// Chart.defaults.global.legend.labels.padding = 20;
// Chart.defaults.global.legend.display = true;

// Ticks global resets
Chart.defaults.scale.ticks.fontSize = 12
Chart.defaults.scale.ticks.fontColor = '#71748c'
Chart.defaults.scale.ticks.beginAtZero = false
Chart.defaults.scale.ticks.padding = 10

// Elements globals
Chart.defaults.global.elements.point.radius = 0

// Responsivess
Chart.defaults.global.responsive = true
Chart.defaults.global.maintainAspectRatio = false

//--------------------------------------------------------------//

// The line chart
// var chart = new Chart(document.getElementById('myChart2'), {
//   type: 'line',
//   data: {
//     labels: ["January", "February", "March", "April", 'May', 'June', 'August', 'September'],
//     datasets: [{
//       label: "My First dataset",
//       data: [4, 20, 5, 20, 5, 25, 9, 18],
//       backgroundColor: 'transparent',
//       borderColor: '#0d6efd',
//       lineTension: .4,
//       borderWidth: 1.5,
//     }, {
//       label: "Month",
//       data: [11, 25, 10, 25, 10, 30, 14, 23],
//       backgroundColor: 'transparent',
//       borderColor: '#dc3545',
//       lineTension: .4,
//       borderWidth: 1.5,
//     }, {
//       label: "Month",
//       data: [16, 30, 16, 30, 16, 36, 21, 35],
//       backgroundColor: 'transparent',
//       borderColor: '#f0ad4e',
//       lineTension: .4,
//       borderWidth: 1.5,
//     }]
//   },
//   options: {
//     scales: {
//       yAxes: [{
//         gridLines: {
//           drawBorder: false
//         },
//         ticks: {
//           stepSize: 12,
//         }
//       }],
//       xAxes: [{
//         gridLines: {
//           display: false,
//         },
//       }]
//     }
//   }
// })




//----------------------------------------------------------------------------------------------//
// Function to fetch data from PHP script
async function fetchData() {
  try {
    const response = await fetch('conf/bar-chart.php');
    const jsonData = await response.json();

    if (jsonData.error) {
      console.error('Error fetching data:', jsonData.error);
      return { data1: [], data2: [] };
    }

    // Merge interventions, demands, and cncInter
    const data1 = mergeData(jsonData.interventions, jsonData.demands, jsonData.cncInter);
    // Process department interventions
    const data2 = processDepartmentInterventions(jsonData.departmentInterventions);
    return { data1, data2 };
  } catch (error) {
    console.error('There was a problem with the fetch operation:', error);
    return { data1: [], data2: [] };
  }
}

// Function to merge interventions, demands, and cncInter
function mergeData(interventions, demands, cncInter) {
  const mergedData = [];
  const monthSet = new Set();

  interventions.forEach(item => monthSet.add(item.month));
  demands.forEach(item => monthSet.add(item.month));
  cncInter.forEach(item => monthSet.add(item.month));

  const months = Array.from(monthSet);

  months.forEach(month => {
    const intervention = interventions.find(item => item.month === month);
    const demand = demands.find(item => item.month === month);
    const third = cncInter.find(item => item.month === month);
    mergedData.push({
      month: month,
      interventions: intervention ? intervention.count : 0,
      demands: demand ? demand.count : 0,
      cncInter: third ? third.count : 0
    });
  });

  return mergedData;
}

// Function to process department interventions
function processDepartmentInterventions(departmentInterventions) {
  const departmentData = {};
  
  departmentInterventions.forEach(item => {
    if (!departmentData[item.department]) {
      departmentData[item.department] = [];
    }
    departmentData[item.department].push({
      month: item.month,
      count: item.count
    });
  });

  return departmentData;
}

// Function to create the charts
async function createCharts() {
  const { data1, data2 } = await fetchData();
  if (data1.length === 0) {
    console.error('No data available for the first chart');
    return;
  }

  createChart1(data1);
  if (Object.keys(data2).length === 0) {
    console.error('No data available for the second chart');
    return;
  }
  createChart2(data2);
}

// Function to create the first chart
function createChart1(data) {
  const labels = data.map(item => item.month);
  const interventionsData = data.map(item => item.interventions);
  const demandsData = data.map(item => item.demands);
  const cncInter = data.map(item => item.cncInter);

  const ctx = document.getElementById('myChart').getContext('2d');
  const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        label: 'Interventions',
        data: interventionsData,
        backgroundColor: '#0d6efd',
        borderColor: 'transparent',
        borderWidth: 2.5,
        barPercentage: 0.4,
      }, {
        label: 'Demands',
        data: demandsData,
        backgroundColor: '#dc3545',
        borderColor: 'transparent',
        borderWidth: 2.5,
        barPercentage: 0.4,
      }, {
        label: 'CNC Intervs',
        data: cncInter,
        backgroundColor: '#28a745',
        borderColor: 'transparent',
        borderWidth: 2.5,
        barPercentage: 0.4,
      }]
    },
    options: {
      scales: {
        yAxes: [{
          gridLines: {},
          ticks: {
            stepSize: 15,
          },
        }],
        xAxes: [{
          gridLines: {
            display: false,
          }
        }]
      }
    }
  });
}

// Function to create the second chart
function createChart2(data) {
  const departments = Object.keys(data);
  const months = Array.from(new Set(Object.values(data).flatMap(depData => depData.map(item => item.month))));
  
  const datasets = departments.map(department => {
    const departmentData = data[department];
    const counts = months.map(month => {
      const item = departmentData.find(i => i.month === month);
      return item ? item.count : 0;
    });
    return {
      label: department,
      data: counts,
      backgroundColor: getRandomColor(),
      borderColor: 'transparent',
      borderWidth: 2.5,
      barPercentage: 0.4,
    };
  });

  const ctx = document.getElementById('myChart2').getContext('2d');
  const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: months,
      datasets: datasets,
    },
    options: {
      scales: {
        yAxes: [{
          gridLines: {},
          ticks: {
            stepSize: 15,
          },
        }],
        xAxes: [{
          gridLines: {
            display: false,
          }
        }]
      }
    }
  });
}

// Utility function to generate a random color
function getRandomColor() {
  const letters = '0123456789ABCDEF';
  let color = '#';
  for (let i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}

// Create the charts when the page loads
window.onload = createCharts;
