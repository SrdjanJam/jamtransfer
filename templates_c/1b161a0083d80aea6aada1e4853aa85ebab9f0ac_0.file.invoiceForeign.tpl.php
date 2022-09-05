<?php
/* Smarty version 3.1.32, created on 2022-09-02 05:59:38
  from 'c:\wamp\www\jamtransfer\plugins\AgentsTransfers\templates\invoiceForeign.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_63119bcae84222_54734552',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1b161a0083d80aea6aada1e4853aa85ebab9f0ac' => 
    array (
      0 => 'c:\\wamp\\www\\jamtransfer\\plugins\\AgentsTransfers\\templates\\invoiceForeign.tpl',
      1 => 1662035478,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63119bcae84222_54734552 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp\\www\\jamtransfer\\common\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),1=>array('file'=>'C:\\wamp\\www\\jamtransfer\\common\\libs\\plugins\\function.counter.php','function'=>'smarty_function_counter',),));
?><!-- Content Wrapper. Contains page content -->
<div class="container pad1em white">

	<div  class="pdfHide well no-print">
		<?php if ($_smarty_tpl->tpl_vars['knjigovodstvo']->value != '1') {?>
			Agent Invoice<br>
			<?php } else { ?>
			Knjigovodstvo<br>
		<?php }?>
	</div>

	<form action="" method="post">

		<input type="hidden" name="p" value="invoiceSumAgent">
		<input type="hidden" name="Save" value="<?php echo $_REQUEST['Save'];?>
">
		<input type="hidden" name="InvoiceNumber" value="<?php echo $_REQUEST['InvoiceNumber'];?>
">
		<input type="hidden" name="InvoiceDate" value="<?php echo $_REQUEST['InvoiceDate'];?>
">

				<table style="width:100%">
			<tr>				<td style="border-bottom:1px #eee solid;padding-bottom:1em !important">
					<h2 style="text-transform:none !important">
						<span style="font-family: Arial, sans-serif;">
							<span style="font-weight:300;color:black;"><span style="color:#f44336;">&#9670;</span><span
									style="color:black;font-weight:bold;">jam</span>transfer.com</span>
						</span>
					</h2>
				</td>

				<td style="border-bottom:1px #eee solid;padding-bottom:1em !important"></td>

				<td style="text-align:right;border-bottom:1px #eee solid;padding-bottom:1em !important">
					<small>Date: 
						<span class="IssuedDate">
							<?php if (!$_smarty_tpl->tpl_vars['saved']->value) {?>
								<?php echo smarty_modifier_date_format(time(),"d.m.Y");?>

								<?php } else { ?>
									<?php echo $_REQUEST['InvoiceDate'];?>

							<?php }?>
						</span>
					</small>
				</td>
			</tr>			
			<tr>				<td class="pad4px" style="vertical-align:top" width="33%">
					<br>From: <br>
				
						<?php echo $_SESSION['co_name'];?>
<br>
						<?php echo $_SESSION['co_address'];?>
<br>
						<?php echo $_SESSION['co_zip'];
echo $_SESSION['co_city'];?>
<br>
						<?php echo $_SESSION['co_country'];?>
<br>
						<?php echo $_SESSION['co_taxno'];?>
<br>
				</td>
			
				<td class="pad4px"  style="vertical-align:top">
					<br>To:<br>

					<?php if ($_smarty_tpl->tpl_vars['u']->value['AuthUserID'] == 1711 || $_smarty_tpl->tpl_vars['u']->value['AuthUserID'] == 1712) {
$_tmp_array = isset($_smarty_tpl->tpl_vars['u']) ? $_smarty_tpl->tpl_vars['u']->value : array();
if (!is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess) {
settype($_tmp_array, 'array');
}
$_tmp_array['AuthUserCompany'] = 'WEBY Ltd.';
$_smarty_tpl->_assignInScope('u', $_tmp_array);
}?>
					

					<strong><?php echo $_smarty_tpl->tpl_vars['u']->value['AuthUserCompany'];?>
</strong><br>
					<?php echo $_smarty_tpl->tpl_vars['u']->value['AuthCoAddress'];?>
<br>
					<?php echo $_smarty_tpl->tpl_vars['u']->value['Zip'];
echo $_smarty_tpl->tpl_vars['u']->value['City'];?>
<br>
					<?php echo $_smarty_tpl->tpl_vars['u']->value['CountryName'];?>
<br>
					Tax ID: <?php echo $_smarty_tpl->tpl_vars['u']->value['AuthUserCompanyMB'];?>
<br>
					<br><br>
				</td>

				<td class="pad4px"  style="vertical-align:top" width="33%">
					<br>
					<strong>
					<?php if (!$_smarty_tpl->tpl_vars['saved']->value) {?>
						Document br: <br>
						<input type="text" name="InvoiceNumber" value="<?php echo $_REQUEST['InvoiceNumber'];?>
">
						<input type="checkbox" id="proforma" name="proforma" value="proforma">
						<label for="proforma"> Proforma</label><br>
						<?php } else { ?>
							<?php if (isset($_REQUEST['proforma'])) {?>
								Pro forma Invoice #:
								<input type='hidden' id='proforma' name='proforma' value='proforma'>
								<?php } else { ?>
									Invoice #:
									<?php echo $_REQUEST['InvoiceNumber'];?>

							<?php }?>
					<?php }?>
					</strong>

					<br>
					<br>

					<strong>Delivery date:</strong> 

					<?php if (!$_smarty_tpl->tpl_vars['saved']->value) {?>
						<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['Date']->value;?>
" name="InvoiceDate" id="InvoiceDate" class="jqdatepicker no-print"
							 onchange="
						$('.DueDate').html(addDays(this.value,15));
						$('#DueDate').val(addDays(this.value,15));
						$('.IssuedDate').html(this.value);
					">
						<?php } else { ?>
							<?php echo smarty_modifier_date_format($_REQUEST['InvoiceDate'],"Y-m-d");?>

					<?php }?>

					<br>
					
					<strong>Due date:</strong> <span class="DueDate"><?php echo $_smarty_tpl->tpl_vars['dueDate']->value;?>
</span><br>
					<input type="hidden" name="DueDate" id="DueDate" value="<?php echo $_smarty_tpl->tpl_vars['dueDate']->value;?>
">

				</td>
				
			</tr>	
			<tr>				<td colspan="3">
					<table class="table table-bordered" width="100%">
						<thead>

							<tr>
								<th class="pad4px">No.</th>
								<th class="pad4px">
									Order/Route<br>
									<span class="s">
										Pax Info/Date/Time
									</span>
								</th>
								<th class="pad4px">Qty</th>
								<th class="pad4px">Unit price</th>
								<th class="pad4px">Subtotal</th>
							</tr>

						</thead>

						<tbody> 


						<?php
$__section_index_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['orders']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_index_0_total = $__section_index_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_index'] = new Smarty_Variable(array());
if ($__section_index_0_total !== 0) {
for ($__section_index_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] = 0; $__section_index_0_iteration <= $__section_index_0_total; $__section_index_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']++){
?>


							<?php if (isset($_REQUEST['order']) && $_REQUEST['order'] == 'NO') {?>
								<input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['orders']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['OrderID'];?>
 - <?php echo $_smarty_tpl->tpl_vars['orders']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['TNo'];?>
" value="NO">
							<?php }?> 

							<?php if ($_smarty_tpl->tpl_vars['incl']->value) {?>

								<tr>

									<td class="pad4px">
										<?php echo smarty_function_counter(array(),$_smarty_tpl);?>

										<input type="hidden" name="DetailsID" value="<?php echo $_smarty_tpl->tpl_vars['orders']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['DetailsID'];?>
">
									</td>
									
																		<td class="pad4px">
										<strong>
											<?php echo $_smarty_tpl->tpl_vars['orders']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['OrderID'];?>
 - <?php echo $_smarty_tpl->tpl_vars['orders']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['TNo'];?>

										</strong><em>
											<?php echo $_smarty_tpl->tpl_vars['orders']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['PickupName'];?>
 - <?php echo $_smarty_tpl->tpl_vars['orders']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['DropName'];?>

										</em><br><span class="s">
											<?php echo $_smarty_tpl->tpl_vars['orders']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['PaxName'];?>
, <?php echo $_smarty_tpl->tpl_vars['orders']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['PaxNo'];?>

										pax. |
											<?php echo $_smarty_tpl->tpl_vars['orders']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['PickupDate'];?>
 <?php echo $_smarty_tpl->tpl_vars['orders']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['PickupTime'];?>

										</span>
									</td>

									<td class="pad4px">
										1
										<input type="hidden" name="Qty" value="1">
									</td>

									<td style="min-width:6em !important;text-align:right" class="pad4px">
										<?php echo number_format($_smarty_tpl->tpl_vars['orders']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['DetailPrice'],2,".",'');?>

									</td>

									<td style="min-width:6em !important;text-align:right" class="pad4px">
										<?php echo number_format($_smarty_tpl->tpl_vars['orders']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['DetailPrice'],2,".",'');?>

									</td>

								</tr>

								<?php if ($_smarty_tpl->tpl_vars['extrasPrice']->value > 0.00) {?>

									<tr>
										<td class="pad4px"></td>
										<td class="pad4px">
											<span class="s">
												Extra services
											</span>
										</td>
										<td class="pad4px"></td>

										<td style="min-width:6em !important;text-align:right" class="pad4px">
											<?php echo number_format($_smarty_tpl->tpl_vars['orders']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['ExtraCharge'],2,".",'');?>

										</td>
										<td style="min-width:6em !important;text-align:right" class="pad4px">
											<?php echo number_format($_smarty_tpl->tpl_vars['orders']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['ExtraCharge'],2,".",'');?>

										</td>
									</tr>

								<?php }?>

							<?php }?> 
						<?php
}
}
?>

					
						<tr><td colspan="5" class="pad4px"><br></td></tr>

						<tr>
							<td class="pad4px"></td>
							<td></td>
							<td></td>
							<td  class="ucase pad4px" style="text-align:right">RSD</td>
							<td  class="ucase pad4px" style="text-align:right"><strong>EUR</strong></td>
						</tr>

						<tr>
							<td class="pad4px"></td>
							<td  class="ucase pad4px" style="text-align:right">Sum</td>
							<td></td>
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								<?php echo number_format($_smarty_tpl->tpl_vars['subTotal_TecajRSD']->value,2,".",'');?>

							</td>
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								<?php echo number_format($_smarty_tpl->tpl_vars['subTotal']->value,2,".",'');?>

								<input type="hidden" name="SumSubTotal" value="<?php echo number_format($_smarty_tpl->tpl_vars['subTotal']->value,2,".",'');?>
">
							</td>
						</tr>

						<tr>
							<td></td>
							<td  class="ucase pad4px" style="text-align:right">Commission</td>
							<td></td>
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								<?php echo number_format($_smarty_tpl->tpl_vars['commissionAmt_TecajRSD']->value,2,".",'');?>

							</td>
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								<?php echo number_format($_smarty_tpl->tpl_vars['commissionAmt']->value,2,".",'');?>

								<input type="hidden" name="CommSubtotal" value="<?php echo number_format($_smarty_tpl->tpl_vars['commissionAmt']->value,2,".",'');?>
">
							</td>
						</tr>

						<tr>
							<td class="pad4px"></td>
							<td  class="ucase pad4px" style="text-align:right">Total in EUR</td>
							<td></td>
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								<?php echo number_format($_smarty_tpl->tpl_vars['totalEur_TecajRSD']->value,2,".",'');?>

							</td>
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								<?php echo number_format($_smarty_tpl->tpl_vars['totalEur']->value,2,".",'');?>

								<input type="hidden" name="TotalSubTotalEUR" value="<?php echo number_format($_smarty_tpl->tpl_vars['totalEur']->value,2,".",'');?>
">
							</td>
						</tr>

						<?php if ($_smarty_tpl->tpl_vars['knjigovodstvo']->value == '1') {?>
						
							<tr>
								<td class="pad4px"></td>
								<td class="ucase pad4px" style="text-align:right"><small>VAT not app. acc. to Note</small></td>
								<td class="pad4px"></td>
								<td style="min-width:6em !important;text-align:right" class="pad4px">
									<?php echo number_format($_smarty_tpl->tpl_vars['noVAT_TecajRSD']->value,2,".",'');?>

								</td>
								<td style="min-width:6em !important;text-align:right" class="pad4px">
									<?php echo number_format($_smarty_tpl->tpl_vars['noVAT']->value,2,".",'');?>

									<input type="hidden" name="VATNotApp" value="<?php echo number_format($_smarty_tpl->tpl_vars['noVAT']->value,2,".",'');?>
">
								</td>
							</tr>	

						<?php }?>


						<tr>
							<td class="pad4px"></td>
							<td class="ucase pad4px" style="text-align:right"><small>VAT base total</small></td>							
							<td class="pad4px"></td>
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								<?php echo number_format($_smarty_tpl->tpl_vars['VATbase_TecajRSD']->value,2,".",'');?>

							</td>
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								<?php echo number_format($_smarty_tpl->tpl_vars['VATbase']->value,2,".",'');?>

								<input type="hidden" name="VATBaseTotal" value="<?php echo number_format($_smarty_tpl->tpl_vars['VATbase']->value,2,".",'');?>
">
							</td>
						</tr>	

						<tr>
							<td class="pad4px"></td>
							<td class="ucase pad4px" style="text-align:right"><small><?php echo $_smarty_tpl->tpl_vars['vat']->value;?>
% VAT total</small></td>							
							<td class="pad4px"></td>
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								<?php echo number_format($_smarty_tpl->tpl_vars['VATbase_vat_TecajRSD']->value,2,".",'');?>

							</td>							
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								<?php echo number_format($_smarty_tpl->tpl_vars['VATbase_vat']->value,2,".",'');?>

								<input type="hidden" name="VATtotal" value="<?php echo number_format($_smarty_tpl->tpl_vars['VATbase_vat']->value,2,".",'');?>
">
							</td>
						</tr>	

						<?php if ($_smarty_tpl->tpl_vars['knjigovodstvo']->value == '1') {?>

						<tr>
							<td class="pad4px"></td>
							<td class="ucase pad4px" style="text-align:right"><small>IN THE NAME AND ON ACCOUNT OF A THIRD PARTY</small></td>							
							<td class="pad4px"></td>
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								<?php echo number_format($_smarty_tpl->tpl_vars['driversPriceTotal_TecajRSD']->value,2,".",'');?>

							</td>							
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								<?php echo number_format($_smarty_tpl->tpl_vars['driversPriceTotal']->value,2,".",'');?>

								<input type="hidden" name="driversPriceTotal" value="<?php echo number_format($_smarty_tpl->tpl_vars['driversPriceTotal']->value,2,".",'');?>
">
							</td>
						</tr>

						<?php }?>

						<tr>
							<td class="pad4px"></td>
							<td class="ucase pad4px" style="text-align:right"><small><strong>Grand total</strong></small></td>							
							<td class="pad4px"></td>
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								<?php echo number_format($_smarty_tpl->tpl_vars['totalEur_TecajRSD']->value,2,".",'');?>

							</td>
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								<strong><?php echo number_format($_smarty_tpl->tpl_vars['totalEur']->value,2,".",'');?>
</strong>
								<input type="hidden" name="GrandTotal" value="<?php echo number_format($_smarty_tpl->tpl_vars['totalEur']->value,2,".",'');?>
">
							</td>
						</tr>	
					
						</tbody>
					</table>
				</td>
			</tr>
			<tr>				<td colspan="3">
										<table style="width:100%;" >
						<tr>
							<td class="pad1em">

								<p>
									<small><em>
										Note: The total amount is calculated without VAT,<br> 
										in accordance with the Law on Value Added Tax, Article 12,
										Paragraph 6   
									</em></small>
								</p>
								If You have any question regarding this Document, please contact: <br>
								<br><em>
								Name: <?php echo $_SESSION['UserRealName'];?>
<br>
								E-mail: <?php echo $_SESSION['co_email'];?>
<br>
								Tel/Fax: <?php echo $_SESSION['co_tel'];?>
<br>
								</em>

								<br>
								Issued: <span class="IssuedDate">
									<?php if (!$_smarty_tpl->tpl_vars['saved']->value) {?>
										<?php echo smarty_modifier_date_format(time(),"d.m.Y");?>

										<?php } else { ?>
											<?php echo smarty_modifier_date_format($_REQUEST['InvoiceDate'],'d. M Y');?>

									<?php }?>
								</span>, Belgrade<br><br>
								This Document is valid without signature or stamp.
							</td>

							<td class="pad1em">
								<p class="lead">INSTRUCTIONS FOR EUR PAYMENT:</p>
								<p class="rs">
									<strong>Company:</strong> <?php echo $_SESSION['co_name'];?>

									<br>
									<strong>Address:</strong> <?php echo $_SESSION['co_address'];?>
,<?php echo $_SESSION['co_zip'];?>
,<?php echo $_SESSION['co_city'];?>
,<?php echo $_SESSION['co_country'];?>

									<br>
									<br>
									<strong>Bank:</strong><?php echo $_SESSION['co_bank'];?>
<br>
									<strong>IBAN: </strong><?php echo $_SESSION['co_iban'];?>
<br>
									<strong>SWIFT: </strong><?php echo $_SESSION['co_swift'];?>

									<br><br>
									You are required to fully cover the bank transaction fees.<br>
									Please, use the option (payment instruction) OUR
									<br>
									Payment is due within the 15 days<br>
								</p>
							</td>
						</tr>

					<!-- this row will not appear when printing -->
						<tr>
							<td>
								<div  class="pdfHide">
									<a href="<?php echo $_smarty_tpl->tpl_vars['root_home']->value;?>
agentsTransfers/<?php echo $_REQUEST['StartDate'];?>
/<?php echo $_REQUEST['EndDate'];?>
/<?php echo $_REQUEST['NoShow'];?>
/<?php echo $_REQUEST['DrErr'];?>
/<?php echo $_REQUEST['CompletedTransfers'];?>
/<?php echo $_REQUEST['Sistem'];?>
"
									class="btn btn-primary">&larr; Back to Agents List</a>

									<br><br>
									
									<?php if ($_smarty_tpl->tpl_vars['saved']->value && $_smarty_tpl->tpl_vars['knjigovodstvo']->value != '1') {?>
										<button onclick="saveFile(<?php echo '$ROOT_HOME';
echo '$PDFfile';?>
)" 
										class="btn xblue xwhite-text l no-print">
										<i class="fa fa-download"></i> 2. Download PDF - Agent</button>
									<?php }?>
								
								</div>
							</td>

							<td>
								<div  class="pdfHide">

								

									<?php if (!$_smarty_tpl->tpl_vars['saved']->value) {?>
										<button type="submit" class="btn btn-danger l pull-right"
										name="Save" value="1"><i class="fa fa-save"></i> 1. Save</button>
									<?php }?>
									
									<?php if ($_smarty_tpl->tpl_vars['saved']->value && $_smarty_tpl->tpl_vars['knjigovodstvo']->value != '1') {?>
										<button type="submit" name="k" value="1" class="btn btn-danger l no-print">
											<i class="fa fa-cogs"></i> 3. Create PDF-Knjigovodstvo
										</button>
									<?php }?>	
									
									<?php if ($_smarty_tpl->tpl_vars['saved']->value && $_smarty_tpl->tpl_vars['knjigovodstvo']->value == '1') {?>
										<button onclick="saveFile('<?php echo $_smarty_tpl->tpl_vars['ROOT_HOME']->value;
echo $_smarty_tpl->tpl_vars['PDFfile']->value;?>
)"
										class="btn xblue xwhite-text  l no-print">
										<i class="fa fa-download"></i> 4. Download PDF-Knjigovodstvo</button>
									<?php }?>
									
								
								</div>
							</td>

						</tr>
					</table> 				</td>
			</tr> 		</table> 
	</form>

</div> <!-- /.container pad1em white -->



<?php echo '<script'; ?>
>
	$(".jqdatepicker").datepicker({ dateFormat: 'yy-mm-dd' });
<?php echo '</script'; ?>
>
<?php }
}
