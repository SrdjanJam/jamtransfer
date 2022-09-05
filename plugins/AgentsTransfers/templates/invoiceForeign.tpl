<!-- Content Wrapper. Contains page content -->
<div class="container pad1em white">

	<div  class="pdfHide well no-print">
		{if $knjigovodstvo neq '1'}
			Agent Invoice<br>
			{else}
			Knjigovodstvo<br>
		{/if}
	</div>

	<form action="" method="post">

		<input type="hidden" name="p" value="invoiceSumAgent">
		<input type="hidden" name="Save" value="{$smarty.request.Save}">
		<input type="hidden" name="InvoiceNumber" value="{$smarty.request.InvoiceNumber}">
		<input type="hidden" name="InvoiceDate" value="{$smarty.request.InvoiceDate}">

		{* First table *}
		<table style="width:100%">
			<tr>{* tr first*}
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
					<small>Date: 
						<span class="IssuedDate">
							{if not $saved}
								{$smarty.now|date_format:"d.m.Y"}
								{else}
									{$smarty.request.InvoiceDate}
							{/if}
						</span>
					</small>
				</td>
			</tr>{* / tr first *}
			
			<tr>{* tr second *}
				<td class="pad4px" style="vertical-align:top" width="33%">
					<br>From: <br>
				
						{$smarty.session.co_name}<br>
						{$smarty.session.co_address}<br>
						{$smarty.session.co_zip}{$smarty.session.co_city}<br>
						{$smarty.session.co_country}<br>
						{$smarty.session.co_taxno}<br>
				</td>
			
				<td class="pad4px"  style="vertical-align:top">
					<br>To:<br>

					{if $u.AuthUserID eq 1711 || $u.AuthUserID eq 1712}{$u.AuthUserCompany='WEBY Ltd.'}{/if}
					

					<strong>{$u.AuthUserCompany}</strong><br>
					{$u.AuthCoAddress}<br>
					{$u.Zip}{$u.City}<br>
					{$u.CountryName}<br>
					Tax ID: {$u.AuthUserCompanyMB}<br>
					<br><br>
				</td>

				<td class="pad4px"  style="vertical-align:top" width="33%">
					<br>
					<strong>
					{if not $saved}
						Document br: <br>
						<input type="text" name="InvoiceNumber" value="{$smarty.request.InvoiceNumber}">
						<input type="checkbox" id="proforma" name="proforma" value="proforma">
						<label for="proforma"> Proforma</label><br>
						{else}
							{if isset($smarty.request.proforma)}
								Pro forma Invoice #:
								<input type='hidden' id='proforma' name='proforma' value='proforma'>
								{else}
									Invoice #:
									{$smarty.request.InvoiceNumber}
							{/if}
					{/if}
					</strong>

					<br>
					<br>

					<strong>Delivery date:</strong> 

					{if !$saved}
						<input type="text" value="{$Date}" name="InvoiceDate" id="InvoiceDate" class="jqdatepicker no-print"
							{* Odraditi Kasnije //==//== *} onchange="
						$('.DueDate').html(addDays(this.value,15));
						$('#DueDate').val(addDays(this.value,15));
						$('.IssuedDate').html(this.value);
					">
						{else}
							{$smarty.request.InvoiceDate|date_format:"Y-m-d"}
					{/if}

					<br>
					
					<strong>Due date:</strong> <span class="DueDate">{$dueDate}</span><br>
					<input type="hidden" name="DueDate" id="DueDate" value="{$dueDate}">

				</td>
				
			</tr>{* / tr second *}
	
			<tr>{* tr third*}
				<td colspan="3">
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

{* Place for adding Loop stuff  ============================================ *}

						{section name=index loop=$orders}


							{if isset($smarty.request.order) and $smarty.request.order eq 'NO'}
								<input type="hidden" name="{$orders[index].OrderID} - {$orders[index].TNo}" value="NO">
							{/if} 

							{if $incl}

								<tr>

									<td class="pad4px">
										{counter}
										<input type="hidden" name="DetailsID" value="{$orders[index].DetailsID}">
									</td>
									
									{* Description: *}
									<td class="pad4px">
										<strong>
											{$orders[index].OrderID} - {$orders[index].TNo}
										</strong><em>
											{$orders[index].PickupName} - {$orders[index].DropName}
										</em><br><span class="s">
											{$orders[index].PaxName}, {$orders[index].PaxNo}
										pax. |
											{$orders[index].PickupDate} {$orders[index].PickupTime}
										</span>
									</td>

									<td class="pad4px">
										1
										<input type="hidden" name="Qty" value="1">
									</td>

									<td style="min-width:6em !important;text-align:right" class="pad4px">
										{$orders[index].DetailPrice|number_format:2:".":""}
									</td>

									<td style="min-width:6em !important;text-align:right" class="pad4px">
										{$orders[index].DetailPrice|number_format:2:".":""}
									</td>

								</tr>

								{if $extrasPrice gt 0.00}

									<tr>
										<td class="pad4px"></td>
										<td class="pad4px">
											<span class="s">
												Extra services
											</span>
										</td>
										<td class="pad4px"></td>

										<td style="min-width:6em !important;text-align:right" class="pad4px">
											{$orders[index].ExtraCharge|number_format:2:".":""}
										</td>
										<td style="min-width:6em !important;text-align:right" class="pad4px">
											{$orders[index].ExtraCharge|number_format:2:".":""}
										</td>
									</tr>

								{/if}

							{/if} {* End if $incl *}

						{/section}

{* ============================================ End of place for adding Loop stuff *}
					
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
								{$subTotal_TecajRSD|number_format:2:".":""}
							</td>
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								{$subTotal|number_format:2:".":""}
								<input type="hidden" name="SumSubTotal" value="{$subTotal|number_format:2:".":""}">
							</td>
						</tr>

						<tr>
							<td></td>
							<td  class="ucase pad4px" style="text-align:right">Commission</td>
							<td></td>
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								{$commissionAmt_TecajRSD|number_format:2:".":""}
							</td>
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								{$commissionAmt|number_format:2:".":""}
								<input type="hidden" name="CommSubtotal" value="{$commissionAmt|number_format:2:".":""}">
							</td>
						</tr>

						<tr>
							<td class="pad4px"></td>
							<td  class="ucase pad4px" style="text-align:right">Total in EUR</td>
							<td></td>
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								{$totalEur_TecajRSD|number_format:2:".":""}
							</td>
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								{$totalEur|number_format:2:".":""}
								<input type="hidden" name="TotalSubTotalEUR" value="{$totalEur|number_format:2:".":""}">
							</td>
						</tr>

						{if $knjigovodstvo eq '1'}
						
							<tr>
								<td class="pad4px"></td>
								<td class="ucase pad4px" style="text-align:right"><small>VAT not app. acc. to Note</small></td>
								<td class="pad4px"></td>
								<td style="min-width:6em !important;text-align:right" class="pad4px">
									{$noVAT_TecajRSD|number_format:2:".":""}
								</td>
								<td style="min-width:6em !important;text-align:right" class="pad4px">
									{$noVAT|number_format:2:".":""}
									<input type="hidden" name="VATNotApp" value="{$noVAT|number_format:2:".":""}">
								</td>
							</tr>	

						{/if}


						<tr>
							<td class="pad4px"></td>
							<td class="ucase pad4px" style="text-align:right"><small>VAT base total</small></td>							
							<td class="pad4px"></td>
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								{$VATbase_TecajRSD|number_format:2:".":""}
							</td>
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								{$VATbase|number_format:2:".":""}
								<input type="hidden" name="VATBaseTotal" value="{$VATbase|number_format:2:".":""}">
							</td>
						</tr>	

						<tr>
							<td class="pad4px"></td>
							<td class="ucase pad4px" style="text-align:right"><small>{$vat}% VAT total</small></td>							
							<td class="pad4px"></td>
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								{$VATbase_vat_TecajRSD|number_format:2:".":""}
							</td>							
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								{$VATbase_vat|number_format:2:".":""}
								<input type="hidden" name="VATtotal" value="{$VATbase_vat|number_format:2:".":""}">
							</td>
						</tr>	

						{if $knjigovodstvo eq '1'}

						<tr>
							<td class="pad4px"></td>
							<td class="ucase pad4px" style="text-align:right"><small>IN THE NAME AND ON ACCOUNT OF A THIRD PARTY</small></td>							
							<td class="pad4px"></td>
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								{$driversPriceTotal_TecajRSD|number_format:2:".":""}
							</td>							
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								{$driversPriceTotal|number_format:2:".":""}
								<input type="hidden" name="driversPriceTotal" value="{$driversPriceTotal|number_format:2:".":""}">
							</td>
						</tr>

						{/if}

						<tr>
							<td class="pad4px"></td>
							<td class="ucase pad4px" style="text-align:right"><small><strong>Grand total</strong></small></td>							
							<td class="pad4px"></td>
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								{$totalEur_TecajRSD|number_format:2:".":""}
							</td>
							<td style="min-width:6em !important;text-align:right" class="pad4px">
								<strong>{$totalEur|number_format:2:".":""}</strong>
								<input type="hidden" name="GrandTotal" value="{$totalEur|number_format:2:".":""}">
							</td>
						</tr>	
					
						</tbody>
					</table>
				</td>
			</tr>{* / tr fourth*}

			<tr>{* tr fifth *}
				<td colspan="3">
					{* Second table *}
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
								Name: {$smarty.session.UserRealName}<br>
								E-mail: {$smarty.session.co_email}<br>
								Tel/Fax: {$smarty.session.co_tel}<br>
								</em>

								<br>
								Issued: <span class="IssuedDate">
									{if !$saved}
										{$smarty.now|date_format:"d.m.Y"}
										{else}
											{$smarty.request.InvoiceDate|date_format:'d. M Y'}
									{/if}
								</span>, Belgrade<br><br>
								This Document is valid without signature or stamp.
							</td>

							<td class="pad1em">
								<p class="lead">INSTRUCTIONS FOR EUR PAYMENT:</p>
								<p class="rs">
									<strong>Company:</strong> {$smarty.session.co_name}
									<br>
									<strong>Address:</strong> {$smarty.session.co_address},{$smarty.session.co_zip},{$smarty.session.co_city},{$smarty.session.co_country}
									<br>
									<br>
									<strong>Bank:</strong>{$smarty.session.co_bank}<br>
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
									<a href="{$root_home}agentsTransfers/{$smarty.request.StartDate}/{$smarty.request.EndDate}/{$smarty.request.NoShow}/{$smarty.request.DrErr}/{$smarty.request.CompletedTransfers}/{$smarty.request.Sistem}"
									class="btn btn-primary">&larr; Back to Agents List</a>

									<br><br>
									
									{if $saved and $knjigovodstvo neq '1'}
										<button type="button"
										onclick="saveFile('{$ROOT_HOME}{$PDFfile}')"
										class="btn xblue xwhite-text l no-print">
										<i class="fa fa-download"></i> 2. Download PDF</button>
									{/if}
								
								</div>
							</td>

							<td>
								<div  class="pdfHide">

								

									{if not $saved}
										<button type="submit" class="btn btn-danger l pull-right"
										name="Save" value="1"><i class="fa fa-save"></i> 1. Save</button>
									{/if}
									
									{if $saved and $knjigovodstvo neq '1'}
										<button type="submit" name="k" value="1" class="btn btn-danger l no-print">
											<i class="fa fa-cogs"></i> 3. Create PDF-Knjigovodstvo
										</button>
									{/if}	
									
									{if $saved and $knjigovodstvo eq '1'}
										<button type="button"
										onclick="saveFile('{$ROOT_HOME}{$PDFfile}')"
										class="btn xblue xwhite-text l no-print">
										<i class="fa fa-download"></i> 2. Download PDF</button>
									{/if}
									
								
								</div>
							</td>

						</tr>
					</table> {* / Second table *}
				</td>
			</tr> {* / tr fifth*}
		</table> {* / First table *}

	</form>

</div> <!-- /.container pad1em white -->



<script>
	$(".jqdatepicker").datepicker({ dateFormat: 'yy-mm-dd' });
</script>
