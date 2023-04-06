<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<div style="padding:10px;">
    <canvas id="myChart" style="width:100%;max-width:700px;"></canvas>
</div>


{literal}
<script>
var xValues = {/literal}{$levels}{literal};
var yValues = {/literal}{$values}{literal};
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
      text: "Transfers purchaser"
    }
  }
});
</script>
{/literal}