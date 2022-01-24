<?php
/* Smarty version 3.1.32, created on 2022-01-24 12:18:31
  from 'c:\wamp\www\jamtransfer\plugins\Calendar\templates\page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_61ee991719bbd3_96908428',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '80578fa4927d6c753bce1fe2171e278d090d2c81' => 
    array (
      0 => 'c:\\wamp\\www\\jamtransfer\\plugins\\Calendar\\templates\\page.tpl',
      1 => 1643026707,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61ee991719bbd3_96908428 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp\\www\\jamtransfer\\common\\libs\\plugins\\function.html_options.php','function'=>'smarty_function_html_options',),));
?><div class="row-fluid">
<div class="container box box-info">
    <div class="box-header">
        <i class="fa fa-calendar"></i>
        <div class="box-title">Calendar</div>
    </div><!-- /.box-header -->
	<div class="col-md-1" style="width:99% !important;">


		<div class="dp_content">
			<div align="center">
				<form action="<?php echo '<?=';?>$_SERVER['PHP_SELF'];<?php echo '?>';?>" method="POST">
				<br>
			    <select name="cal_month" id="cal_month" onchange="calendar_month()">
					<?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['month_val']->value,'selected'=>$_smarty_tpl->tpl_vars['month_sel']->value,'output'=>$_smarty_tpl->tpl_vars['month_out']->value),$_smarty_tpl);?>

			    </select>
			    <select name="cal_year"  id="cal_year" onchange="calendar_year()">
					<?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['year_val']->value,'selected'=>$_smarty_tpl->tpl_vars['year_sel']->value,'output'=>$_smarty_tpl->tpl_vars['year_out']->value),$_smarty_tpl);?>

			    </select>
			    </form>
	        </div>


	        <div id="cal" align="center">
			</div>
			<br/><br/>

		</div>


	</div>
</div>
</div>
<br>

	        <?php echo '<script'; ?>
 type="text/javascript">
			
	            $.get('plugins/calendar/calendar.php',
	                function(data) {
	                $('#cal').html(data);
	                });
				
				function calendar_year() {
					$.get('plugins/calendar/calendar.php', 
						{
					cal_year: this.value, cal_month: $('#cal_month').val()
						},
					function(data) {
					  $('#cal').html(data);
					});
					$('#xMonth').val(this.value);
				}				
				function calendar_month() {
					$.get('plugins/calendar/calendar.php', 
					{cal_month: this.value, cal_year: $('#cal_year').val()},
					function(data) {
					$('#cal').html(data);
					});
					$('#xMonth').val(this.value);
				}	
					
	        <?php echo '</script'; ?>
><?php }
}
