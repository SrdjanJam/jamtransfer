<?php
/* Smarty version 3.1.32, created on 2022-09-02 07:39:22
  from 'c:\wamp\www\jamtransfer\plugins\DriversTransfers\templates\invoice.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6311b32a810889_86174948',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '229a9a56e93526970eec931d5961fe12f6df40b6' => 
    array (
      0 => 'c:\\wamp\\www\\jamtransfer\\plugins\\DriversTransfers\\templates\\invoice.tpl',
      1 => 1662029158,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6311b32a810889_86174948 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp\\www\\jamtransfer\\common\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?><!-- Content Wrapper. Contains page content -->
<div class="container pad1em white">

	<form action="" method="post">
		<input type="hidden" name="p" value="invoiceSum">
		<input type="hidden" name="d" value="<?php echo $_REQUEST['DriverId'];?>
">
		<input type="hidden" name="s" value="<?php echo $_REQUEST['StartDate'];?>
">
		<input type="hidden" name="e" value="<?php echo $_REQUEST['EndDate'];?>
">
						<input type="hidden" name="Save" value="<?php echo $_REQUEST['Save'];?>
">
		<input type="hidden" name="DriverInvoiceNumber" value="<?php echo $_smarty_tpl->tpl_vars['DriverInvoiceNumber']->value;?>
">
		<input type="hidden" name="DriverInvoiceDate" value="<?php echo $_smarty_tpl->tpl_vars['DriverInvoiceDate']->value;?>
">
		<input type="hidden" name="GrandTotal" value="<?php echo $_smarty_tpl->tpl_vars['GrandTotal']->value;?>
">

		<table style="width:100%" id="first-table">
			<tr><!-- first-table tr1-->
				<td style="border-bottom:1px #eee solid;padding-bottom:1em !important">
					<h2 style="text-transform:none !important">
						<span style="font-family: Arial, sans-serif;" >
							<span style="font-weight:300;color:black;"><span style="color:#f44336;">&#9670;</span><span style="color:black;font-weight:bold;">jam</span>transfer.com</span>
						</span>
					</h2>
				</td>

				<td style="border-bottom:1px #eee solid;padding-bottom:1em !important"></td>

				<td style="text-align:right;border-bottom:1px #eee solid;padding-bottom:1em !important">
					<small>Date: <span class="IssuedDate">

						<?php if (!$_smarty_tpl->tpl_vars['saved']->value) {?> 
							<?php echo $_smarty_tpl->tpl_vars['toDay']->value;?>

						<?php } else { ?>
							<?php echo $_smarty_tpl->tpl_vars['DriverInvoiceDate']->value;?>

						<?php }?>

					</span></small>
				</td>
				<!-- /.col -->
			</tr><!-- / first table tr1 -->
			<!-- info row -->
			<tr><!-- first table tr2 -->
				<td class="pad4px" style="vertical-align:top" width="33%">
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
				<!-- /.col -->
				<td class="pad4px"  style="vertical-align:top">
					<br>To:<br>

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
					<br>
					<strong>

						<?php if (!$_smarty_tpl->tpl_vars['saved']->value) {?>
							Invoice #:					
							<input type="text" name="DriverInvoiceNumber" 
							value="<?php echo $_smarty_tpl->tpl_vars['DriverInvoiceNumber']->value;?>
">
						<?php } else { ?>
							<h3>
								Invoice #:
								<?php echo $_smarty_tpl->tpl_vars['DriverInvoiceNumber']->value;?>

							</h3>
						<?php }?>

					</strong>
					<br>
					<br>
					<strong>Delivery date:</strong>

					<?php if (!$_smarty_tpl->tpl_vars['saved']->value) {?>
						<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['Date']->value;?>
" name="DriverInvoiceDate"
							id="InvoiceDate" 
						class="jqdatepicker no-print"
												onchange="
							$('.DueDate').html(addDays(this.value,15));
							$('#DueDate').val(addDays(this.value,15));
							$('.IssuedDate').html(this.value);
						">
						<?php } else { ?>
							<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['DriverInvoiceDate']->value,"Y-m-d");?>

					<?php }?>

					<br>
					<strong>Due date:</strong> <span class="DueDate"><?php echo $_smarty_tpl->tpl_vars['dueDate']->value;?>
</span><br>
					<input type="hidden" name="DueDate" id="DueDate" value="<?php echo $_smarty_tpl->tpl_vars['dueDate']->value;?>
">

				</td>
				<!-- /.col -->
			</tr><!-- / first table tr2-->
			<!-- /.row -->

			<!-- Table row -->
			<tr>
				<td colspan="3">
				<!-- Second Table -->
					<table class="table table-bordered" width="100%">
						<thead>
							<tr>
								<th class="pad4px">No.</th>

								<th class="pad4px">
									Description of work
								</th>

								<th class="pad4px">Qty</th>
								<th class="pad4px">Unit price</th>
								<th class="pad4px">Subtotal</th>
							</tr>
						</thead>
						<tbody>
		
							<tr>
								<td class="pad4px">1.</td>

								<td class="pad4px">

									<?php if (!$_smarty_tpl->tpl_vars['saved']->value) {?>
										<textarea class="form-control" name="Description" rows="5" 
										style="border:none !important"><?php echo $_smarty_tpl->tpl_vars['Description']->value;?>
</textarea>	

									<?php } else { ?> 
										<?php echo $_smarty_tpl->tpl_vars['Description']->value;?>

									<?php }?>

																		
									<input type="hidden" name="Description" value="<?php echo $_smarty_tpl->tpl_vars['Description']->value;?>
">

								</td>
								
								<td class="pad4px">
									1
									<input type="hidden" name="Qty" value="1">
								</td>

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									<?php echo $_smarty_tpl->tpl_vars['sum']->value;?>

									<input type="hidden" name="Price" value="<?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
">
								</td>

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									<?php echo $_smarty_tpl->tpl_vars['sum']->value;?>

									<input type="hidden" name="SubTotal" value="<?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
">
								</td>

							</tr> 
			
							<tr><td colspan="5" class="pad4px"><br><br></td></tr>

							<tr>
								<td class="pad4px"></td>
								<td></td><!-- Empty -->
								<td></td><!-- Empty -->
								<td  class="ucase pad4px" style="text-align:right">RSD</td>
								<td  class="ucase pad4px" style="text-align:right"><strong>EUR</strong></td>
							</tr>

							<tr>
								<td class="pad4px"></td>
								<td  class="ucase pad4px" style="text-align:right">Sum</td>
								<td></td> <!-- Empty -->

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									<?php echo $_smarty_tpl->tpl_vars['sum']->value*$_SESSION['TecajRSD'];?>

									<input type="hidden" name="SumPrice" value="<?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
">
								</td>

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									<?php echo $_smarty_tpl->tpl_vars['sum']->value;?>

									<input type="hidden" name="SumSubTotal" value="<?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
">
								</td>
							</tr>

							<tr>
								<td class="pad4px"></td>
								<td  class="ucase pad4px" style="text-align:right">Total in EUR</td>
								<td></td> <!-- Empty -->

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									<?php echo $_smarty_tpl->tpl_vars['sum']->value*$_SESSION['TecajRSD'];?>

									<input type="hidden" name="TotalPriceEUR" value="<?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
">
								</td>

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									<?php echo $_smarty_tpl->tpl_vars['sum']->value;?>

									<input type="hidden" name="TotalSubTotalEUR" value="<?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
">
								</td>
							</tr>					

							<tr>
								<td class="pad4px"></td>
								<td class="ucase pad4px" style="text-align:right"><small>VAT base total</small></td>
								<td class="pad4px"></td>

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									<?php echo $_smarty_tpl->tpl_vars['sum']->value*$_SESSION['TecajRSD'];?>

									<input type="hidden" name="VATBaseTotal" value="<?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
">
								</td>

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									<?php echo $_smarty_tpl->tpl_vars['sum']->value;?>

									<input type="hidden" name="VATBaseTotal" value="<?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
">
								</td>
							</tr>	

							<tr>
								<td class="pad4px"></td>
								<td class="ucase pad4px" style="text-align:right"><small><?php echo $_REQUEST['vat'];?>
% VAT total</small></td>
								<td class="pad4px"></td>

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									<?php echo $_smarty_tpl->tpl_vars['VATtotal']->value*$_SESSION['TecajRSD'];?>

									<input type="hidden" name="VATtotal" value="<?php echo $_smarty_tpl->tpl_vars['VATtotal']->value;?>
">
								</td>		

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									<?php echo $_smarty_tpl->tpl_vars['VATtotal']->value;?>

									<input type="hidden" name="VATtotal" value="<?php echo $_smarty_tpl->tpl_vars['VATtotal']->value;?>
">
								</td>
							</tr>	

							<tr>
								<td class="pad4px"></td>
								<td class="ucase pad4px" style="text-align:right"><small><strong>Grand total</strong></small></td>
								<td class="pad4px"></td>

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									<?php echo $_smarty_tpl->tpl_vars['sum']->value*$_SESSION['TecajRSD'];?>

									<input type="hidden" name="GrandTotal" value="<?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
">
								</td>		

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									<strong><?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
</strong>
									<input type="hidden" name="GrandTotal" value="<?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
">
								</td>
							</tr>	
			
						</tbody>
					</table> <!-- table table-bordered --> <!-- / Second Table -->
				</td>
			</tr>

			<tr>
				<td colspan="3">
				<!-- Third Table -->
					<table style="width:100%;" id="sub-table-2">

						<tr>
							<td class="pad1em">
								<p>
									<small><em>
										Note: The total amount is calculated without VAT,<br> 
										in accordance with the Law on Value Added Tax, Article 12,
											Paragraph 6 
									</em></small>
								</p>

								<br>
								If You have any question regarding this Invoice, please contact: <br>
								<br><em>
								Name: <?php echo $_SESSION['UserRealName'];?>
<br>
								E-mail: finance@jamtransfer.com<br>
								Tel/Fax: 00 381 11 364 02 15<br>
								</em>

								<br>
								Issued: <span class="IssuedDate">
								<?php if (!$_smarty_tpl->tpl_vars['saved']->value) {?>
									<?php echo smarty_modifier_date_format(time(),"d.m.Y");?>

									<?php } else { ?>
										<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['DriverInvoiceDate']->value,'d. M Y');?>

								<?php }?>
									
								</span>, Belgrade<br><br>
								This Invoice is valid without signature or stamp.
							</td>

							<td class="pad1em">
								<p class="lead">INSTRUCTIONS FOR EUR PAYMENT:</p>
								<p class="rs">
									<strong>Company:</strong>  <?php echo $_SESSION['co_name'];?>

									<br>
									<strong>Address:</strong> <?php echo $_SESSION['co_address'];?>
,<?php echo $_SESSION['co_zip'];?>
,<?php echo $_SESSION['co_city'];?>
,<?php echo $_SESSION['co_country'];?>

									<br>
									<br>
									<strong>Bank:</strong> <?php echo $_SESSION['co_bank'];?>
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
driversTransfers/<?php echo $_REQUEST['StartDate'];?>
/<?php echo $_REQUEST['EndDate'];?>
/<?php echo $_REQUEST['includePaymentMethod'];?>
" class="btn btn-primary">&larr; Back to Drivers List</a>
									<br/>
								</div>
							</td>

							<td>
								<div  class="pdfHide">
									<?php if (!$_smarty_tpl->tpl_vars['saved']->value) {?>
										<button type="submit" class="btn btn-danger l pull-right"
										name="Save" value="1"><i class="fa fa-save"></i> 1. Save</button>
									<?php }?>
									<?php if ($_smarty_tpl->tpl_vars['saved']->value) {?>
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
					</table> <!-- / #sub-table-2 --> <!-- / Thrid Table -->
				</td> <!-- / colspan="3" -->
			</tr>
		</table> <!-- / #first-table -->
	</form> <!-- / form method=post -->

</div> <!-- / .container pad1em white -->


<?php echo '<script'; ?>
>
$(".jqdatepicker").datepicker({ dateFormat: 'yy-mm-dd' });
<?php echo '</script'; ?>
>
<?php }
}
