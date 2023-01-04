<!-- Content Wrapper. Contains page content -->
<div class="container pad1em white">

	<form action="" method="post">
		<input type="hidden" name="p" value="invoiceSum">
		<input type="hidden" name="d" value="{$smarty.request.DriverId}">
		<input type="hidden" name="s" value="{$smarty.request.StartDate}">
		<input type="hidden" name="e" value="{$smarty.request.EndDate}">
		{* Ne koristi se *}
		{* <input type="hidden" name="Submit" value="{$smarty.request.Submit}"> *}
		<input type="hidden" name="Save" value="{$smarty.request.Save}">
		<input type="hidden" name="DriverInvoiceNumber" value="{$DriverInvoiceNumber}">
		<input type="hidden" name="DriverInvoiceDate" value="{$DriverInvoiceDate}">
		<input type="hidden" name="GrandTotal" value="{$GrandTotal}">

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

						{if !$saved} 
							{$toDay}
						{else}
							{$DriverInvoiceDate}
						{/if}

					</span></small>
				</td>
				<!-- /.col -->
			</tr><!-- / first table tr1 -->
			<!-- info row -->
			<tr><!-- first table tr2 -->
				<td class="pad4px" style="vertical-align:top" width="33%">
					<br>From: <br>

					{$smarty.session.co_name}<br>
					{$smarty.session.co_address}<br>
					{$smarty.session.co_zip}{$smarty.session.co_city}<br>
					{$smarty.session.co_country}<br>
					{$smarty.session.co_taxno}<br>

				</td>
				<!-- /.col -->
				<td class="pad4px"  style="vertical-align:top">
					<br>To:<br>

					<strong>{$u.AuthUserCompany}</strong><br>
					{$u.AuthCoAddress}<br>
					{$u.Zip}{$u.City}<br>
					{$u.CountryName}<br>
					Tax ID: {$u.AuthUserCompanyMB}<br>
					<br><br>

				</td>
				<!-- /.col -->
				<td class="pad4px"  style="vertical-align:top" width="33%">
					<br>
					<strong>

						{if !$saved}
							Invoice #:					
							<input type="text" name="DriverInvoiceNumber" 
							value="{$DriverInvoiceNumber}">
						{else}
							<h3>
								Invoice #:
								{$DriverInvoiceNumber}
							</h3>
						{/if}

					</strong>
					<br>
					<br>
					<strong>Delivery date:</strong>

					{if !$saved}
						<input type="text" value="{$Date}" name="DriverInvoiceDate"
							id="InvoiceDate" 
						class="jqdatepicker no-print"
						{* Odraditi Kasnije //==//== *}
						onchange="
							$('.DueDate').html(addDays(this.value,15));
							$('#DueDate').val(addDays(this.value,15));
							$('.IssuedDate').html(this.value);
						">
						{else}
							{$DriverInvoiceDate|date_format:"Y-m-d"}
					{/if}

					<br>
					<strong>Due date:</strong> <span class="DueDate">{$dueDate}</span><br>
					<input type="hidden" name="DueDate" id="DueDate" value="{$dueDate}">

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

									{if !$saved}
										<textarea class="form-control" name="Description" rows="5" 
										style="border:none !important">{$Description}</textarea>	

									{else} 
										{$Description}
									{/if}

									{* Neporebno: *}
									{* {$smarty.request.Description} *}

									<input type="hidden" name="Description" value="{$Description}">

								</td>
								
								<td class="pad4px">
									1
									<input type="hidden" name="Qty" value="1">
								</td>

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									{$sum}
									<input type="hidden" name="Price" value="{$sum}">
								</td>

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									{$sum}
									<input type="hidden" name="SubTotal" value="{$sum}">
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
									{$sum}
									<input type="hidden" name="SumPrice" value="{$sum}">
								</td>

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									{$sum}
									<input type="hidden" name="SumSubTotal" value="{$sum}">
								</td>
							</tr>

							<tr>
								<td class="pad4px"></td>
								<td  class="ucase pad4px" style="text-align:right">Total in EUR</td>
								<td></td> <!-- Empty -->

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									{$sum}
									<input type="hidden" name="TotalPriceEUR" value="{$sum}">
								</td>

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									{$sum}
									<input type="hidden" name="TotalSubTotalEUR" value="{$sum}">
								</td>
							</tr>					

							<tr>
								<td class="pad4px"></td>
								<td class="ucase pad4px" style="text-align:right"><small>VAT base total</small></td>
								<td class="pad4px"></td>

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									{$sum}
									<input type="hidden" name="VATBaseTotal" value="{$sum}">
								</td>

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									{$sum}
									<input type="hidden" name="VATBaseTotal" value="{$sum}">
								</td>
							</tr>	

							<tr>
								<td class="pad4px"></td>

								{* Don't exists *}
								{* <td class="ucase pad4px" style="text-align:right"><small>{$smarty.request.vat}% VAT total</small></td> *}

								<td class="pad4px"></td>

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									{$VATtotal}
									<input type="hidden" name="VATtotal" value="{$VATtotal}">
								</td>		

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									{$VATtotal}
									<input type="hidden" name="VATtotal" value="{$VATtotal}">
								</td>
							</tr>	

							<tr>
								<td class="pad4px"></td>
								<td class="ucase pad4px" style="text-align:right"><small><strong>Grand total</strong></small></td>
								<td class="pad4px"></td>

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									{$sum}
									<input type="hidden" name="GrandTotal" value="{$sum}">
								</td>		

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									<strong>{$sum}</strong>
									<input type="hidden" name="GrandTotal" value="{$sum}">
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
								Name: {$smarty.session.UserRealName}<br>
								E-mail: finance@jamtransfer.com<br>
								Tel/Fax: 00 381 11 364 02 15<br>
								</em>

								<br>
								Issued: <span class="IssuedDate">
								{if !$saved}
									{$smarty.now|date_format:"d.m.Y"}
									{else}
										{$DriverInvoiceDate|date_format:'d. M Y'}
								{/if}
									
								</span>, Belgrade<br><br>
								This Invoice is valid without signature or stamp.
							</td>

							<td class="pad1em">
								<p class="lead">INSTRUCTIONS FOR EUR PAYMENT:</p>
								<p class="rs">
									<strong>Company:</strong>  {$smarty.session.co_name}
									<br>
									<strong>Address:</strong> {$smarty.session.co_address},{$smarty.session.co_zip},{$smarty.session.co_city},{$smarty.session.co_country}
									<br>
									<br>
									<strong>Bank:</strong> {$smarty.session.co_bank}<br>
									<strong>IBAN: </strong>{$smarty.session.co_iban}<br>
									<strong>SWIFT: </strong>{$smarty.session.co_swift}
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
									<a href="{$root_home}driversTransfers/{$smarty.request.StartDate}/{$smarty.request.EndDate}/{$smarty.request.includePaymentMethod}" class="btn btn-primary">&larr; Back to Drivers List</a>
									<br/>
								</div>
							</td>

							<td>
								<div  class="pdfHide">
									{if !$saved}
										<button type="submit" class="btn btn-danger l pull-right"
										name="Save" value="1"><i class="fa fa-save"></i> 1. Save</button>
									{/if}
									{if $saved}
										<button type="button"
										onclick="saveFile('{$ROOT_HOME}{$PDFfile}')"
										class="btn xblue xwhite-text l no-print">
										<i class="fa fa-download"></i> 2. Download PDF</button>
									{/if}											
								</div>
							</td>

						</tr>
					</table> <!-- / #sub-table-2 --> <!-- / Thrid Table -->
				</td> <!-- / colspan="3" -->
			</tr>
		</table> <!-- / #first-table -->
	</form> <!-- / form method=post -->

</div> <!-- / .container pad1em white -->


<script>
$(".jqdatepicker").datepicker({ dateFormat: 'yy-mm-dd' });
</script>
