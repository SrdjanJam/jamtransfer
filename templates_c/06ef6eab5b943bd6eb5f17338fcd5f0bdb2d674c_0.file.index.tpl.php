<?php
/* Smarty version 3.1.32, created on 2022-11-21 13:58:14
  from 'c:\wamp\www\jamtransfer\plugins\Schedule\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_637b83f6372b90_68047850',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '06ef6eab5b943bd6eb5f17338fcd5f0bdb2d674c' => 
    array (
      0 => 'c:\\wamp\\www\\jamtransfer\\plugins\\Schedule\\templates\\index.tpl',
      1 => 1669039089,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_637b83f6372b90_68047850 (Smarty_Internal_Template $_smarty_tpl) {
?><style>

.datepicker {
	width: 10em;
	text-align: center;
}
.picker__frame {
	top: 20% !important;
}
.btn-xs {
	border: 0;
}
hr {
	border-top: 1px solid #eee;
}

.stupac {
	border: solid 1px #ccc;
}
.stupacWrapper {
	margin-top: 12px;
	padding: 0 2px;
}	
.blink {
	background-color:red;
	color:white;
	animation: blinker 1s infinite;
}
  
@keyframes blinker {
	from { opacity: 1.0; }
	50% { opacity: 0.5; }
	to { opacity: 1.0; }
}
</style>

	<div class="row" >
		<div class="col-sm-3">	
			<button class="btn" onclick="hideChecked()"><?php echo $_smarty_tpl->tpl_vars['DISPLAY_NOT_CHECKED']->value;?>
</button>
			<button class="btn" onclick="displayAll()"><?php echo $_smarty_tpl->tpl_vars['DISPLAY_ALL']->value;?>
</button>
		</div>		
		<form  action="" method="post" onsubmit="return validate()">
			<div class="col-sm-3">
				From
				<input id="DateFrom" class="datepicker" name="DateFrom" value="<?php echo $_smarty_tpl->tpl_vars['DateFrom']->value;?>
">
			</div>
			<div class="col-sm-3">
				to
				<input id="DateTo" class="datepicker" name="DateTo" value="<?php echo $_smarty_tpl->tpl_vars['DateTo']->value;?>
">
			</div>	
			<div class="col-sm-3">
				with
				<select name="NoColumns">
					<option value="1" <?php if ($_smarty_tpl->tpl_vars['NoColumns']->value == 1) {?>selected<?php }?>>1</option>
					<option value="2" <?php if ($_smarty_tpl->tpl_vars['NoColumns']->value == 2) {?>selected<?php }?>>2</option>
					<option value="3" <?php if ($_smarty_tpl->tpl_vars['NoColumns']->value == 3) {?>selected<?php }?>>3</option>
					<option value="4" <?php if ($_smarty_tpl->tpl_vars['NoColumns']->value == 4) {?>selected<?php }?>>4</option>
					<option value="6" <?php if ($_smarty_tpl->tpl_vars['NoColumns']->value == 6) {?>selected<?php }?>>6</option>
					<option value="12" <?php if ($_smarty_tpl->tpl_vars['NoColumns']->value == 12) {?>selected<?php }?>>12</option>
				</select>
				columns
				<button type="submit" class="btn btn-primary">Go</button>
			</div>	
			</form>
	<div class="row" style="font-size:0.85em !important">
		<?php
$__section_pom_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['sdArray']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom_0_total = $__section_pom_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom'] = new Smarty_Variable(array());
if ($__section_pom_0_total !== 0) {
for ($__section_pom_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] = 0; $__section_pom_0_iteration <= $__section_pom_0_total; $__section_pom_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']++){
?>
			<div class="col-md-<?php echo $_smarty_tpl->tpl_vars['BsColumnWidth']->value;?>
">
				<div class="row orange white-text">
					<strong><?php echo $_smarty_tpl->tpl_vars['sdArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['DriverName'];?>
</strong>	
				</div>	
				<div class="row white shadow" style="cursor:default; padding:8px !important;background:;">
					<?php
$__section_pom2_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['ordersArray']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom2_1_total = $__section_pom2_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom2'] = new Smarty_Variable(array());
if ($__section_pom2_1_total !== 0) {
for ($__section_pom2_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] = 0; $__section_pom2_1_iteration <= $__section_pom2_1_total; $__section_pom2_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']++){
?>
					<?php if (($_smarty_tpl->tpl_vars['sdArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['DriverID'] == $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriver']) || ($_smarty_tpl->tpl_vars['sdArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['DriverID'] == $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriver2']) || ($_smarty_tpl->tpl_vars['sdArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['DriverID'] == $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriver3'])) {?>
					<div class="row"> <!-- TRANSFER -->
						<?php echo $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['DetailsID'];?>

					</div>
					<?php }?>
					<?php
}
}
?>
				</div>	
					
			</div>
		
		<?php
}
}
?>
	</div>
<?php }
}
