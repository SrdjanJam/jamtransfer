<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<!-- Showing charts: -->
<div class="row" style="padding:10px;">
  <div class="col-sm-6"><canvas id="pie-chart" style="display:inline-block;"></canvas></div>
  <div class="col-sm-6"><canvas id="bar-chart" style="display:inline-block;col-sm-6"></canvas></div>
</div>



{literal}
<script>

Chart.defaults.global.defaultFontSize = 14;

// Pie Chart:
var xValues = {/literal}{$levels}{literal};
var yValues = {/literal}{$values}{literal};
var barColors = [
  "#0026FE3D", // Agent
  "#00FF0438", // Client
  "#FFEA0054", // Affilate
  "#FF4D0070", // Taxi Site
  "#00000066", // Operator
  "#AD00FF70", // Dispatcher
  "#FF000070", // Admin
];

new Chart("pie-chart", {
  type: "pie",
  data: {
    labels: xValues,
    
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Transfers purchaser"
    },
    
  }

// Test:
//   labels: {
//   font: {
//     size: 9,
//     family:'vazir'
//   }
// }


});

// Bar Chart:
var xValues = ["Italy", "France", "Spain", "USA", "Argentina","France", "Spain", "USA", "Argentina", "USA", "Argentina"];
var yValues = [55, 49, 44, 24, 15, 55, 49, 44, 24, 15,55, 49];
var barColors = ["red", "green","blue","orange","brown", "green","blue","orange","brown", "green","blue"];

new Chart("bar-chart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "World Wine Production 2018"
    }
  }
});



</script>
{/literal}