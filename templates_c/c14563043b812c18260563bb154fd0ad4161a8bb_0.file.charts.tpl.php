<?php
/* Smarty version 3.1.32, created on 2023-04-13 14:58:04
  from 'C:\wamp\www\jamtransfer\plugins\Dashboard\templates\charts.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6437fc5c28ead0_34716688',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c14563043b812c18260563bb154fd0ad4161a8bb' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\plugins\\Dashboard\\templates\\charts.tpl',
      1 => 1681289281,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6437fc5c28ead0_34716688 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"><?php echo '</script'; ?>
>

<!-- Showing charts: -->
<div class="row" style="padding:10px;">
  <div class="col-sm-6"><canvas id="pie-chart" style="display:inline-block;"></canvas></div>
  <div class="col-sm-6"><canvas id="bar-chart" style="display:inline-block;col-sm-6"></canvas></div>
</div>




<?php echo '<script'; ?>
>

Chart.defaults.global.defaultFontSize = 14;

// Pie Chart:
var xValues = <?php echo $_smarty_tpl->tpl_vars['levels']->value;?>
;
var yValues = <?php echo $_smarty_tpl->tpl_vars['values']->value;?>
;
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
      text: "Value of ordered transfers in the last year by purchaser"
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
var xValues = <?php echo $_smarty_tpl->tpl_vars['months2']->value;?>
;
var yValues = <?php echo $_smarty_tpl->tpl_vars['values2']->value;?>
;
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
      text: "Value of ordered transfers in the last year by months"
    }
  }
});



<?php echo '</script'; ?>
>
<?php }
}
