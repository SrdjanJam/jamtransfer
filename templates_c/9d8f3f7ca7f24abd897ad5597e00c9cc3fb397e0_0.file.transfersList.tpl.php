<?php
/* Smarty version 3.1.32, created on 2021-12-31 13:32:07
  from 'C:\wamp\www\jamtransfer\templates\transfersList.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_61cf06575dac84_83977706',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9d8f3f7ca7f24abd897ad5597e00c9cc3fb397e0' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\templates\\transfersList.tpl',
      1 => 1640957525,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61cf06575dac84_83977706 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container-fluid ">
	<div  style="margin-top :-20px; padding-top: 10px; margin-left:-15px; position: fixed; width: 100%; background-color:white; z-index:100;">   
		<div class="col-md-10"> <h1><?php echo '<?=';?> TRANSFERS . ' ' . $titleAddOn <?php echo '?>';?></h1></div> 
		<div id="pageSelect" class="col-md-2"></div>
			
		<input type="hidden"  id="whereCondition" name="whereCondition" 		
		value=" WHERE v4_OrderDetails.TransferStatus != '9'  <?php echo '<?=';?> $dashboardFilter <?php echo '?>';?>">
		<input type="hidden"  id="documentFilter" name="documentFilter" 		
		value=" <?php echo '<?=';?> $documentFilter <?php echo '?>';?>">
		
		
		<div class="row pad1em" id="searchRow">
			<div class="col-md-2" id="infoShow"></div>
			<div class="col-md-2">
				<i class="fa fa-list-ul"></i>
				<select id="status" class="w75" onchange="getAllTransfersFilter();">
					<option value="0"> --- </option>
					<?php echo '<?
					';?>foreach($StatusDescription as $val => $text) {
						echo  '<option value="'.$val.'"> ' . $text . '</option>';
					}		
					<?php echo '?>';?>
				</select>
			</div>
			<div class="col-md-2">
				<i class="fa fa-eye"></i>
				<select id="length" name="length" class="w75" onchange="getAllTransfersFilter();">
					<option value="5"> 5 </option>
					<option value="10"> 10 </option>
					<option value="20" selected> 20 </option>
					<option value="50"> 50 </option>
					<option value="100"> 100 </option>
				</select>
			</div>

			<div class="col-md-3">
				<i class="fa fa-search"></i>
				<input type="text" id="Search" class=" w75" onchange="getAllTransfersFilter();" placeholder="Text + Enter to Search">
			</div>
			<div class="col-md-3">
				
				<button class="btn white shadow align" onclick="$('#advancedSearch').toggle('slow');">
					<span id="advancedSearchActive"></span> <?php echo '<?=';?> ADVANCED_SEARCH <?php echo '?>';?>
				</button>
				
			</div>
		</div>

		<div class="row green-1 " id="advancedSearch" style="display:none">

			<div class="col-md-6">
				<br>
				<?php echo '<?=';?> SHOW_BOOKED <?php echo '?>';?>:<br>
				<select id="filterBooked" class="xform-control">
					<option value=">="> <?php echo '<?=';?> AFTER_INCLUDING <?php echo '?>';?> </option>
					<option value=">"> <?php echo '<?=';?> AFTER <?php echo '?>';?> </option>
					<option value="<"> <?php echo '<?=';?> BEFORE <?php echo '?>';?> </option>
					<option value="="> <?php echo '<?=';?> ON <?php echo '?>';?> </option>
				</select>
				<input type="text" id="filterBookedDate" name="filterBookedDate" class="w50 xform-control datepicker" >
			</div>

			<div class="col-md-6 pad1em">
				<?php echo '<?=';?> AND_PICKUP_DATE_IS <?php echo '?>';?> :<br>
				<select id="filterPickup" class="xform-control">
					<option value=">="> <?php echo '<?=';?> AFTER_INCLUDING <?php echo '?>';?> </option>
					<option value=">"> <?php echo '<?=';?> AFTER <?php echo '?>';?> </option>
					<option value="<"> <?php echo '<?=';?> BEFORE <?php echo '?>';?> </option>
					<option value="="> <?php echo '<?=';?> ON <?php echo '?>';?> </option>
				</select>
				<input type="text" id="filterPickupDate" class="w50 datepicker" value="<?php echo '<?=';?> $filterDate; <?php echo '?>';?>"
				onchange="createCookie('dateFilterCookie', this.value, '200');">
				Default: <?php echo '<?=';?> $defDate <?php echo '?>';?> 
				
			</div>
			
			<div class="col-md-5 pad1em">
				<?php echo '<? ';?>if ($_SESSION['AuthLevelID'] != DRIVER_USER) { <?php echo '?>';?>
					<?php echo '<?=';?> AND_DRIVER_IS <?php echo '?>';?> :<br>
					<select name="filterDriverID" id="filterDriverID" class="xform-control w75">
						<option value="0"> --- </option>
						<?php echo '<?
							';?>foreach( $auK as $n => $v) {
								$au->getRow($v);
								echo '	<option value="'.$au->getAuthUserID().'" ';
							
								if ($au->getAuthUserID() == $in->DriverID) echo ' selected="selected"';
							
								echo '>'.$au->getCountry().'-'.$au->getTerminal().'-'.$au->getAuthUserCompany().'</option>';
							}
						<?php echo '?>';?>
					</select>
				<?php echo '<? ';?>} else { <?php echo '?>';?>
					<input type="hidden" name="filterDriverID" id="filterDriverID" 
					value="<?php echo '<?=';?> $_SESSION['AuthUserID']<?php echo '?>';?>">
				<?php echo '<? ';?>} <?php echo '?>';?>
			</div>

			<div class="col-md-2 pad1em">
				<?php echo '<?=';?> SORT_BY_PICKUP_DATE <?php echo '?>';?> :<br>
				<select name="sortOrder" id="sortOrder" class="xform-control">
					<option value="ASC" selected="selected"> <?php echo '<?=';?> ASCENDING <?php echo '?>';?> </option>
					<option value="DESC"> <?php echo '<?=';?> DESCENDING <?php echo '?>';?> </option>
				</select>
			</div>

			<div class="col-md-2 pad1em">
				<?php echo '<?=';?> EXTRA_SERVICES <?php echo '?>';?> :<br>
				<select name="extraServices" id="extraServicesChoose">
					<option value="any" selected="selected"> <?php echo '<?=';?> ANY <?php echo '?>';?> </option>
					<option value="only"> <?php echo '<?=';?> ONLY_EXTRAS <?php echo '?>';?> </option>
					<option value="none"> <?php echo '<?=';?> NO_EXTRAS <?php echo '?>';?> </option>
				</select>
			</div>

			<div class="col-md-3 pad1em">
				<br>
				<button class="btn btn-primary l" onclick="getAllTransfersFilter();$('#advancedSearch').hide('slow');">
					<i class="ic-search"></i> <?php echo '<?=';?> APPLY <?php echo '?>';?>
				</button>
				<br> <br><br>
			</div>
			
		</div>	
	</div>	
	<div style='margin-top:140px' id="showTransfers"><div class="center"><?php echo '<?=';?> THERE_ARE_NO_DATA <?php echo '?>';?></div></div>
	<div id='arh' style='display:none'><?php echo '<? ';?>if (isset($_REQUEST['archive'])) echo 'archive'; <?php echo '?>';?></div> 
	<div id='order_only' style='display:none'><?php echo '<? ';?>if ($_REQUEST['transfersFilter'] == 'order') echo 'order_only'; <?php echo '?>';?></div> 
	<?php echo '<? 

	
		';?>// ovo nije u primjeni, ali je ideja
		if ($_SESSION['AuthLevelID'] == '31') define("READ_ONLY_FLD", 'readonly="readonly"');		
		if ($_SESSION['AuthLevelID'] >= '91') define("READ_ONLY_FLD", '');
		
		// inList razlikuje je li direktan poziv Edit transfera (npr. iz dashboarda)
		// ili ide preko liste svih transfera
		// ako je iz liste, onda je true
		$inList = 'true';

		// Poziva se template za Listu i za Edit transfera
		// koristi handlebars
		<?php echo $_smarty_tpl->tpl_vars['list']->value;?>

		
		
		
	<?php echo '?>';?>
</div>


<?php echo '<script'; ?>
 type="text/javascript">
	$(document).ready(function(){		
		getAllTransfers(); // definirano u cms.jquery.js		
	});
	$('.note').mouseenter(function(){	
		alert ('SHOW NOTE')
	})
	function getAllTransfersFilter() {
		getAllTransfers(); // definirano u cms.jquery.js
	}

<?php echo '</script'; ?>
><?php }
}
