<?php
/* Smarty version 3.1.32, created on 2022-09-02 10:38:13
  from 'c:\wamp\www\jamtransfer\plugins\AgentsTransfers\templates\invoiceSerbian.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6311dd1545c421_51528199',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13e6fde0824cefdfc6b4fe2a5543d3611da45b8f' => 
    array (
      0 => 'c:\\wamp\\www\\jamtransfer\\plugins\\AgentsTransfers\\templates\\invoiceSerbian.tpl',
      1 => 1662115073,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6311dd1545c421_51528199 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp\\www\\jamtransfer\\common\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),1=>array('file'=>'C:\\wamp\\www\\jamtransfer\\common\\libs\\plugins\\function.counter.php','function'=>'smarty_function_counter',),));
?><div class="container pad1em white">
	
	<div  class="pdfHide well no-print">
		<?php if ($_smarty_tpl->tpl_vars['knjigovodstvo']->value != '1') {?>
			Agent Invoice<br>
			<?php } else { ?>
			Knjigovodstvo<br>
		<?php }?>
	</div>

	<form action="" method="post">
		<input type="hidden" name="p" value="invoiceSumAgent">
		<input type="hidden" name="k" value="<?php echo $_REQUEST['k'];?>
"> 		<input type="hidden" name="Storno" value="<?php echo $_REQUEST['Storno'];?>
">
		<input type="hidden" name="Save" value="<?php echo $_REQUEST['Save'];?>
">
		<input type="hidden" name="InvoiceNumber" value="<?php echo $_REQUEST['InvoiceNumber'];?>
">
		<input type="hidden" name="InvoiceDate" value="<?php echo $_REQUEST['InvoiceDate'];?>
">
		<input type="hidden" name="VATtotal" value="<?php echo $_REQUEST['VATtotal'];?>
">

		<table style="width:100%">
			<!-- Content Header (Page header) -->
			<!-- Main content -->
				<!-- title row -->
				<tr>

					<td style="border-bottom:1px #eee solid;padding-bottom:1em !important">
						<h2 style="text-transform:none !important">
							<span style="font-family: Arial, sans-serif;">
							<span style="font-weight:300;color:black;"><span style="color:#f44336;">&#9670;</span><span
									style="color:black;font-weight:bold;">jam</span>transfer.com</span>
							</span>
						</h2>
					</td>

					<td style="border-bottom:1px #eee solid;padding-bottom:1em !important"></td>

					<td style="text-align:right;border-bottom:1px #eee solid;padding-bottom:1em !important">
						<small>Datum: <span class="IssuedDate">
							<?php if (!$_smarty_tpl->tpl_vars['saved']->value) {?>
								<?php echo smarty_modifier_date_format(time(),"d.m.Y");?>

								<?php } else { ?>
									<?php echo $_REQUEST['InvoiceDate'];?>

							<?php }?>
						</span></small>
					</td>
					<!-- /.col -->
				</tr>
				<!-- info row -->
				<tr>
					<td class="pad4px" style="vertical-align:top" width="33%">
						<address>
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
							PIB: <?php echo $_SESSION['co_accountno'];?>
<br>		
							Tekući račun: <?php echo $_SESSION['co_bank'];?>
<br>		
						</address>
					</td>
				
					<!-- /.col -->
					<td class="pad4px"  style="vertical-align:top">
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
					<!-- /.col -->
					<td class="pad4px"  style="vertical-align:top" width="33%">
						<strong>

							<?php if (!$_smarty_tpl->tpl_vars['saved']->value) {?>
								Dokument br: <br>						
								<input type="text" name="InvoiceNumber" value="<?php echo $_REQUEST['InvoiceNumber'];?>
">
								<input type="checkbox" id="proforma" name="proforma" value="proforma">
								<label for="proforma"> Proforma</label><br>
								<?php } else { ?>
									<h3>
										<?php if (isset($_REQUEST['proforma']) && $_REQUEST['proforma'] == 'proforma') {?>
											Predračun br:						
											<input type='hidden' id='proforma' name='proforma' value='proforma'>
											<?php } else { ?>
												Račun br:
												<?php echo $_REQUEST['InvoiceNumber'];?>

										<?php }?>
									</h3>
							<?php }?>

						</strong>
						<br>
						<strong>Datum i mesto prometa:</strong><br> 

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

						<br><br>

						<strong>Rok za plaćanje:</strong> 
						<input type="text" name="DueDate" id="DueDate" value="<?php echo $_smarty_tpl->tpl_vars['dueDate']->value;?>
"><br>
						<input type="hidden" name="DueDate" id="DueDate" value="<?php echo $_smarty_tpl->tpl_vars['dueDate']->value;?>
">

					</td>
					<!-- /.col -->
				</tr>
			<!-- /.row -->

			<!-- Table row -->
				<tr>
					<td colspan="3">
						<table class="table table-bordered" width="100%">
							<thead>
								<tr>
									<th class="pad4px">Rbr.</th>
									<th class="pad4px">
										Vrsta dobra ili usluge
									</th>
									<th class="pad4px">Kol.</th>
									<th class="pad4px">Cena u EUR</th>
									<th class="pad4px">Vrednost u EUR</th>
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

												<input type="hidden" name="Price" value="<?php echo '<?=';?> nf($transferPrice) <?php echo '?>';?>">
											</td>

											<td style="min-width:6em !important;text-align:right" class="pad4px">
												<?php echo number_format($_smarty_tpl->tpl_vars['orders']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['DetailPrice'],2,".",'');?>

												<input type="hidden" name="SubTotal" value="<?php echo '<?=';?> nf($transferPrice) <?php echo '?>';?>">
											</td>

										</tr>
									
										<?php if ($_smarty_tpl->tpl_vars['extrasPrice']->value > 0.00) {?>
											<tr>
												<td class="pad4px"></td>
												<td class="pad4px">
													<span class="s">
														Dodatne usluge
													</span>
												</td>
												<td class="pad4px"></td>

												<td style="min-width:6em !important;text-align:right" class="pad4px">
													<?php echo number_format($_smarty_tpl->tpl_vars['orders']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['ExtraCharge'],2,".",'');?>

													<input type="hidden" name="Price" value="<?php echo '<?=';?> nf($extrasPrice) <?php echo '?>';?>">
												</td>
												<td style="min-width:6em !important;text-align:right" class="pad4px">
													<?php echo number_format($_smarty_tpl->tpl_vars['orders']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)]['ExtraCharge'],2,".",'');?>

													<input type="hidden" name="SubTotal" value="<?php echo '<?=';?> nf($extrasPrice) <?php echo '?>';?>">
												</td>
											</tr>
										<?php }?> 
									<?php }?> 
								<?php
}
}
?>

							<tr><td colspan="5" class="pad4px"><br><br></td></tr>

							<tr>
								<td></td>
								<td  class="ucase pad4px" style="text-align:right">Provizija</td>
								<td></td>
								<td style="min-width:6em !important;text-align:right" class="pad4px">
									<?php echo number_format($_smarty_tpl->tpl_vars['commissionAmt']->value,2,".",'');?>

									<input type="hidden" name="CommPrice" value="<?php echo number_format($_smarty_tpl->tpl_vars['commissionAmt']->value,2,".",'');?>
">
								</td>
								<td style="min-width:6em !important;text-align:right" class="pad4px">
									<?php echo number_format($_smarty_tpl->tpl_vars['commissionAmt']->value,2,".",'');?>

									<input type="hidden" name="CommSubtotal" value="<?php echo number_format($_smarty_tpl->tpl_vars['commissionAmt']->value,2,".",'');?>
">
								</td>
							</tr>

							<tr>
								<td class="pad4px"></td>
								<td  class="ucase pad4px" style="text-align:right">Vrednost usluge u EUR</td>

								<td></td>

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									<?php echo number_format($_smarty_tpl->tpl_vars['totalEur']->value,2,".",'');?>

									<input type="hidden" name="TotalPriceEUR" value="<?php echo number_format($_smarty_tpl->tpl_vars['totalEur']->value,2,".",'');?>
">
								</td>

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									<?php echo number_format($_smarty_tpl->tpl_vars['totalEur']->value,2,".",'');?>

									<input type="hidden" name="TotalSubTotalEUR" value="<?php echo number_format($_smarty_tpl->tpl_vars['totalEur']->value,2,".",'');?>
">
								</td>
							</tr>					

							<tr>
								<td></td>
								<td  class="ucase" style="text-align:right">Vrednost usluge u RSD</td>
								<td></td>
								<td style="min-width:6em !important;text-align:right">
									<?php echo number_format($_smarty_tpl->tpl_vars['totalEur_TecajRSD']->value,2,".",'');?>

								</td>
								<td style="min-width:6em !important;text-align:right">
									<?php echo number_format($_smarty_tpl->tpl_vars['totalEur_TecajRSD']->value,2,".",'');?>

								</td>
							</tr>	

							<tr>
								<td class="pad4px"></td>
								<td class="pad4px"></td>
								<td class="pad4px"></td>
								<td class="ucase pad4px"><small>Poreska osnovica</small></td>

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									<?php echo number_format($_smarty_tpl->tpl_vars['VATbase_vat']->value,2,".",'');?>

									<input type="hidden" name="VATBaseTotal" value="<?php echo number_format($_smarty_tpl->tpl_vars['VATbase_vat']->value,2,".",'');?>
">
								</td>
							</tr>

							<tr>
								<td class="pad4px"></td>
								<td class="pad4px"></td>
								<td class="pad4px"></td>

								<td class="ucase pad4px"><small>Opšta stopa PDV-a<?php echo $_smarty_tpl->tpl_vars['vat']->value;?>
%</small></td>
								<td style="min-width:6em !important;text-align:right" class="pad4px">
								
									<?php if (!$_smarty_tpl->tpl_vars['saved']->value) {?>
										<input type="text" name="VATtotal" style="text-align:right" 
										value="<?php echo number_format($_smarty_tpl->tpl_vars['VATbase_vat']->value,2,".",'');?>
">
										<?php } else { ?>
											<?php echo number_format($_REQUEST['VATtotal'],2,".",'');?>

									<?php }?>

								</td>
							</tr>	

							<?php if ($_smarty_tpl->tpl_vars['knjigovodstvo']->value == '1') {?>

								<tr>
									<td class="pad4px"></td>
									<td class="pad4px"></td>
									<td class="pad4px"></td>
									<td class="ucase pad4px"><small>Naplata u ime i za račun trećeg lica</small></td>

									<td style="min-width:6em !important;text-align:right" class="pad4px">
										<?php echo number_format($_smarty_tpl->tpl_vars['driversPriceSum_TecajRSD']->value,2,".",'');?>

										<input type="hidden" name="driversPriceSum" value="<?php echo number_format($_smarty_tpl->tpl_vars['driversPriceSum']->value,2,".",'');?>
">
									</td>
								</tr>
							
							<?php }?>
							
							<tr>
								<td class="pad4px"></td>
								<td class="pad4px"></td>
								<td class="pad4px"></td>
								<td class="ucase pad4px"><small><strong>Svega po računu (RSD)</strong></small></td>

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									<strong><?php echo number_format($_smarty_tpl->tpl_vars['totalEur_TecajRSD']->value,2,".",'');?>
</strong>
									<input type="hidden" name="GrandTotal" value="<?php echo $_smarty_tpl->tpl_vars['totalEur']->value;?>
">
								</td>
							</tr>	
						
							</tbody>
						</table>
					</td>
					<!-- /.col -->
				</tr>
			<!-- /.row -->

				<tr>
					<td colspan="3">
						<table style="width:100%;" >
							<tr>
								<td class="pad1em">

									<p>
										<small><em>
											Napomena: PDV nije obračunat na osnovu Člana 12, <br>
											stav 6  i Člana 17, stav 4 Zakona o porezu na <br>
											dodatu vrednost
										</em></small>
									</p>
			
									Način plaćanja: bezgotovinski<br>	

									Datum i mesto izdavanja: 
									<span class="IssuedDate">
										<?php if (!$_smarty_tpl->tpl_vars['saved']->value) {?>
											<?php echo smarty_modifier_date_format(time(),"d.m.Y");?>

											<?php } else { ?>
												<?php echo smarty_modifier_date_format($_REQUEST['InvoiceDate'],'d. M Y');?>

										<?php }?>
									</span>, Beograd<br>
									
									Dokument izdala (identifikaciona oznaka): <br>
									<?php echo $_SESSION['UserRealName'];?>
, <?php echo $_SESSION['UserIDD'];?>


								</td>
								<!-- /.col -->

								<td class="pad1em">

									<p class="rs">
										*iskazana cena je u EUR, <br>
										što znači da se primenjuje valutna klauzula <br>
										(uplata u dinarskoj protivvrednosti prema <br>
										zvaničnom srednjem kursu NBS na dan izdavanja dokumenta)<br> 
									</p>

										Ovaj dokument je izdat u elektronskom formatu i važi bez<br> 
										pečata i potpisa na osnovu člana 9. Zakona o računovodstvu<br> 
										i Mišljenja Ministarstva finansija broj 401-004169/2017-16
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
										<button type="button"
										onclick="saveFile('<?php echo $_smarty_tpl->tpl_vars['ROOT_HOME']->value;
echo $_smarty_tpl->tpl_vars['PDFfile']->value;?>
')"
										class="btn xblue xwhite-text l no-print">
										<i class="fa fa-download"></i> 2. Download PDF</button>
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
										<button type="button"
										onclick="saveFile('<?php echo $_smarty_tpl->tpl_vars['ROOT_HOME']->value;
echo $_smarty_tpl->tpl_vars['PDFfile']->value;?>
')"
										class="btn xblue xwhite-text l no-print">
										<i class="fa fa-download"></i> 2. Download PDF</button>
									<?php }?>
								</div>
							</td>
						</tr>


						</table>
				</td>
			</tr>
			<!-- /.content -->

		</table>
	</form>
<!-- /.content-wrapper -->
</div>


<?php echo '<script'; ?>
>
	$(".jqdatepicker").datepicker({ dateFormat: 'dd.mm.yy' });

<?php echo '</script'; ?>
>
<?php }
}
