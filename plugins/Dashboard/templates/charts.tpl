<h1><i class="fa fa-bar-chart" aria-hidden="true"></i> Data presentation charts in progress</h1>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<div style="padding:10px;">
    <canvas id="myChart" style="width:100%;max-width:600px;"></canvas>
</div>


{literal}
<script>
var xValues = [{/literal}"{$data1}"{literal},"France", "Spain", "USA", "Argentina"];
var yValues = [{/literal} {$data2} {literal},49, 44, 24, 15];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

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
      text: "World Wide Wine Production 2018"
    }
  }
});
</script>
{/literal}