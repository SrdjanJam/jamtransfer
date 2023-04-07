<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<div style="padding:10px;">
    <canvas id="myChart" style="width:100%;max-width:750px;"></canvas>
</div>




{literal}
<script>

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

Chart.defaults.global.defaultFontSize = 14;
new Chart("myChart", {
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
</script>
{/literal}