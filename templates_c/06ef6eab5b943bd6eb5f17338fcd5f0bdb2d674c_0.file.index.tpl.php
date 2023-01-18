<?php
/* Smarty version 3.1.32, created on 2023-01-17 13:07:19
  from 'c:\wamp\www\jamtransfer\plugins\Schedule\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_63c69d87a625a8_26670598',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '06ef6eab5b943bd6eb5f17338fcd5f0bdb2d674c' => 
    array (
      0 => 'c:\\wamp\\www\\jamtransfer\\plugins\\Schedule\\templates\\index.tpl',
      1 => 1673960387,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:plugins/Schedule/templates/oneTransfer.tpl' => 1,
  ),
),false)) {
function content_63c69d87a625a8_26670598 (Smarty_Internal_Template $_smarty_tpl) {
?><style>

/* Old: */
/* .datepicker {
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
} */

/* .stupac {
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

*/

/* new */
.row-header{
	/* background: rgb(205 216 243);  */ /* Old */
	background-image: linear-gradient(#88b7ed, #d0dff1);
	padding: 10px;
}

.row-shedule{
    margin:15px 0 0 0;
	font-size:0.85em !important;
}
.row-shedule .row{
    margin:0;
}

.row-white{
	/* border:1px solid rgb(223 223 223); Old */
	border: 1px solid rgb(136 177 217);
	border-radius:5px;
}

.row .orange{
	background-image: linear-gradient(#88b7ed, #d0dff1);
	color:#474542;
	padding:5px;
	font-size:18px;
	font-family:Georgia, 'Times New Roman', Times, serif;
}

.col-md-edit{
	padding:2px 5px;
}

.sub-card{
	/* background:#e8eef1; old */
	/* background-image: linear-gradient(#d6e6e7, #e6e7e0); old */
	background:#d6e6e7;
	margin:10px;
	padding:10px;
	border-radius:5px;
}
.sub-card .row{
	font-family: Tahoma, Verdana, Geneva, sans-serif;
	padding:5px;
}

.col-md-3 input{
	font-weight:bold;
	text-align:center;
}

.col-md-5 select{
	width:100%;
	height:2em;
	margin-top:5px;
}

.red{
	color: white;
}

.blink {
	background-color:red;
	color:white;
	animation: blinker 2s ease 0s infinite normal forwards;
}

@keyframes blinker {
	0% {
		opacity: 1;
	}

	50% {
		opacity: 0.2;
	}

	100% {
		opacity: 1;
	}
}

.fa-user{
	color:#2a2a2a;
}

.add-hiddenInfo{
	padding:10px;
	background: #e4e2e2;
}

.sub-card textarea{
	width:100%;
}

.sub-card .row button{
	padding:5px;
	border-radius: 5px;
}

</style>

	<!-- HEADER: -->
	<div class="row row-header">

		<form  action="" method="post" onsubmit="return validate()">
			<div class="col-sm-2">
				<input id="DateFrom" class="datepicker" name="DateFrom" value="<?php echo $_smarty_tpl->tpl_vars['DateFrom']->value;?>
">
			</div>
			<div class="col-sm-2">
				<input id="DateTo" class="datepicker" name="DateTo" value="<?php echo $_smarty_tpl->tpl_vars['DateTo']->value;?>
">
			</div>	
			<div class="col-sm-2">
				<select name="NoColumns" class="form-control">
					<option value="1" <?php if ($_smarty_tpl->tpl_vars['NoColumns']->value == 1) {?>selected<?php }?>>1 <?php echo $_smarty_tpl->tpl_vars['COLUMN']->value;?>
</option>
					<option value="2" <?php if ($_smarty_tpl->tpl_vars['NoColumns']->value == 2) {?>selected<?php }?>>2 <?php echo $_smarty_tpl->tpl_vars['COLUMN']->value;?>
</option>
					<option value="3" <?php if ($_smarty_tpl->tpl_vars['NoColumns']->value == 3) {?>selected<?php }?>>3 <?php echo $_smarty_tpl->tpl_vars['COLUMN']->value;?>
</option>
					<option value="4" <?php if ($_smarty_tpl->tpl_vars['NoColumns']->value == 4) {?>selected<?php }?>>4 <?php echo $_smarty_tpl->tpl_vars['COLUMN']->value;?>
</option>
					<option value="6" <?php if ($_smarty_tpl->tpl_vars['NoColumns']->value == 6) {?>selected<?php }?>>6 <?php echo $_smarty_tpl->tpl_vars['COLUMN']->value;?>
</option>
					<option value="12" <?php if ($_smarty_tpl->tpl_vars['NoColumns']->value == 12) {?>selected<?php }?>>12 <?php echo $_smarty_tpl->tpl_vars['COLUMN']->value;?>
</option>
				</select>		
			</div>			
			<div class="col-sm-2">
				<select name="DriverStatus" class="form-control">
					<option value="0" <?php if ($_smarty_tpl->tpl_vars['DriverStatus']->value == 0) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['DISPLAY_ALL']->value;?>
</option>
					<option value="1" <?php if ($_smarty_tpl->tpl_vars['DriverStatus']->value == 1) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['NOT_READY']->value;?>
</option>
					<option value="2" <?php if ($_smarty_tpl->tpl_vars['DriverStatus']->value == 2) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['READY_FINISHED']->value;?>
</option>
				</select>		
			</div>
			<div class="col-sm-2">
				<button type="submit" class="btn btn-primary">Go</button>
			</div>
		</form> <!-- /form -->
	</div> <!-- /.row -->

	<!-- MAIN CONTENT: -->
	<div class="row row-shedule">

		<?php
$__section_pom_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['sdArray']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom_0_total = $__section_pom_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom'] = new Smarty_Variable(array());
if ($__section_pom_0_total !== 0) {
for ($__section_pom_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] = 0; $__section_pom_0_iteration <= $__section_pom_0_total; $__section_pom_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']++){
?>
			
			<!-- Column one: -->
			<div class="col-md-<?php echo $_smarty_tpl->tpl_vars['BsColumnWidth']->value;?>
 col-md-edit">

				<!-- One card: -->
				<div class="row-white shadow border">

					<div class="row orange white-text">
						<strong><?php echo $_smarty_tpl->tpl_vars['sdArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['DriverName'];?>
</strong>	
					</div>

					<?php if (count($_smarty_tpl->tpl_vars['ordersArray']->value)) {?>
						<?php
$__section_pom2_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['ordersArray']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pom2_1_total = $__section_pom2_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pom2'] = new Smarty_Variable(array());
if ($__section_pom2_1_total !== 0) {
for ($__section_pom2_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] = 0; $__section_pom2_1_iteration <= $__section_pom2_1_total; $__section_pom2_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']++){
?>

							<?php if (($_smarty_tpl->tpl_vars['sdArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['DriverID'] == $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriver']) || ($_smarty_tpl->tpl_vars['sdArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['DriverID'] == $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriver2']) || ($_smarty_tpl->tpl_vars['sdArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom']->value['index'] : null)]['DriverID'] == $_smarty_tpl->tpl_vars['ordersArray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pom2']->value['index'] : null)]['SubDriver3'])) {?>

								<?php $_smarty_tpl->_subTemplateRender('file:plugins/Schedule/templates/oneTransfer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

							<?php }?>
						
						<?php
}
}
?>

						<?php } else { ?>
							No Choosen Schedule.

					<?php }?>

				</div>	<!-- /.row white shadow border (One card) -->
					
			</div> 
			
		
		<?php
}
}
?>

	</div> <!-- /.row row-shedule -->
<?php }
}
