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
		<input type="hidden" name="k" value="{$smarty.request.k}"> {* knjigovodstvo*}
		<input type="hidden" name="Storno" value="{$smarty.request.Storno}">
		<input type="hidden" name="Save" value="{$smarty.request.Save}">
		<input type="hidden" name="InvoiceNumber" value="{$smarty.request.InvoiceNumber}">
		<input type="hidden" name="InvoiceDate" value="{$smarty.request.InvoiceDate}">
		<input type="hidden" name="VATtotal" value="{$smarty.request.VATtotal}">

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
							{if not $saved}
								{$smarty.now|date_format:"d.m.Y"}
								{else}
									{$smarty.request.InvoiceDate}
							{/if}
						</span></small>
					</td>
					<!-- /.col -->
				</tr>
				<!-- info row -->
				<tr>
					<td class="pad4px" style="vertical-align:top" width="33%">
						<address>
							{$smarty.session.co_name}<br>
							{$smarty.session.co_address}<br>
							{$smarty.session.co_zip}{$smarty.session.co_city}<br>
							{$smarty.session.co_country}<br>
							{$smarty.session.co_taxno}<br>
							PIB: {$smarty.session.co_accountno}<br>		
							Tekući račun: {$smarty.session.co_bank}<br>		
						</address>
					</td>
				
					<!-- /.col -->
					<td class="pad4px"  style="vertical-align:top">
						<strong>{$u.AuthUserCompany}</strong><br>
						{$u.AuthCoAddress}<br>
						{$u.Zip}{$u.City}<br>
						{$u.CountryName}<br>
						Tax ID: {$u.AuthUserCompanyMB}<br>
						<br><br>

					</td>
					<!-- /.col -->
					<td class="pad4px"  style="vertical-align:top" width="33%">
						<strong>

							{if not $saved}
								Dokument br: <br>						
								<input type="text" name="InvoiceNumber" value="{$smarty.request.InvoiceNumber}">
								<input type="checkbox" id="proforma" name="proforma" value="proforma">
								<label for="proforma"> Proforma</label><br>
								{else}
									<h3>
										{if isset($smarty.request.proforma) && $smarty.request.proforma eq 'proforma'}
											Predračun br:						
											<input type='hidden' id='proforma' name='proforma' value='proforma'>
											{else}
												Račun br:
												{$smarty.request.InvoiceNumber}
										{/if}
									</h3>
							{/if}

						</strong>
						<br>
						<strong>Datum i mesto prometa:</strong><br> 

						{if not $saved}
							<input type="text" value="{$Date}" name="InvoiceDate" id="InvoiceDate" class="jqdatepicker no-print"
								{* Odraditi Kasnije //==//== *} onchange="
								$('.DueDate').html(addDays(this.value,15));
								$('#DueDate').val(addDays(this.value,15));
								$('.IssuedDate').html(this.value);
							">
							{else}
								{$smarty.request.InvoiceDate|date_format:"Y-m-d"}
						{/if}

						<br><br>

						<strong>Rok za plaćanje:</strong> 
						<input type="text" name="DueDate" id="DueDate" value="{$dueDate}"><br>
						<input type="hidden" name="DueDate" id="DueDate" value="{$dueDate}">

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
												<input type="hidden" name="Price" value="<?= nf($transferPrice) ?>">
											</td>

											<td style="min-width:6em !important;text-align:right" class="pad4px">
												{$orders[index].DetailPrice|number_format:2:".":""}
												<input type="hidden" name="SubTotal" value="<?= nf($transferPrice) ?>">
											</td>

										</tr>
									
										{if $extrasPrice gt 0.00}
											<tr>
												<td class="pad4px"></td>
												<td class="pad4px">
													<span class="s">
														Dodatne usluge
													</span>
												</td>
												<td class="pad4px"></td>

												<td style="min-width:6em !important;text-align:right" class="pad4px">
													{$orders[index].ExtraCharge|number_format:2:".":""}
													<input type="hidden" name="Price" value="<?= nf($extrasPrice) ?>">
												</td>
												<td style="min-width:6em !important;text-align:right" class="pad4px">
													{$orders[index].ExtraCharge|number_format:2:".":""}
													<input type="hidden" name="SubTotal" value="<?= nf($extrasPrice) ?>">
												</td>
											</tr>
										{/if} {* endif $extrasPrice *}

									{/if} {* End of if $incl *}

								{/section}

							<tr><td colspan="5" class="pad4px"><br><br></td></tr>

							<tr>
								<td></td>
								<td  class="ucase pad4px" style="text-align:right">Provizija</td>
								<td></td>
								<td style="min-width:6em !important;text-align:right" class="pad4px">
									{$commissionAmt|number_format:2:".":""}
									<input type="hidden" name="CommPrice" value="{$commissionAmt|number_format:2:".":""}">
								</td>
								<td style="min-width:6em !important;text-align:right" class="pad4px">
									{$commissionAmt|number_format:2:".":""}
									<input type="hidden" name="CommSubtotal" value="{$commissionAmt|number_format:2:".":""}">
								</td>
							</tr>

							<tr>
								<td class="pad4px"></td>
								<td  class="ucase pad4px" style="text-align:right">Vrednost usluge u EUR</td>

								<td></td>

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									{$totalEur|number_format:2:".":""}
									<input type="hidden" name="TotalPriceEUR" value="{$totalEur|number_format:2:".":""}">
								</td>

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									{$totalEur|number_format:2:".":""}
									<input type="hidden" name="TotalSubTotalEUR" value="{$totalEur|number_format:2:".":""}">
								</td>
							</tr>					

							<tr>
								<td></td>
								<td  class="ucase" style="text-align:right">Vrednost usluge u RSD</td>
								<td></td>
								<td style="min-width:6em !important;text-align:right">
									{$totalEur_TecajRSD|number_format:2:".":""}
								</td>
								<td style="min-width:6em !important;text-align:right">
									{$totalEur_TecajRSD|number_format:2:".":""}
								</td>
							</tr>	

							<tr>
								<td class="pad4px"></td>
								<td class="pad4px"></td>
								<td class="pad4px"></td>
								<td class="ucase pad4px"><small>Poreska osnovica</small></td>

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									{$VATbase_vat|number_format:2:".":""}
									<input type="hidden" name="VATBaseTotal" value="{$VATbase_vat|number_format:2:".":""}">
								</td>
							</tr>

							<tr>
								<td class="pad4px"></td>
								<td class="pad4px"></td>
								<td class="pad4px"></td>

								<td class="ucase pad4px"><small>Opšta stopa PDV-a{$vat}%</small></td>
								<td style="min-width:6em !important;text-align:right" class="pad4px">
								
									{if not $saved}
										<input type="text" name="VATtotal" style="text-align:right" 
										value="{$VATbase_vat|number_format:2:".":""}">
										{else}
											{$smarty.request.VATtotal|number_format:2:".":""}
									{/if}

								</td>
							</tr>	

							{if $knjigovodstvo eq '1'}

								<tr>
									<td class="pad4px"></td>
									<td class="pad4px"></td>
									<td class="pad4px"></td>
									<td class="ucase pad4px"><small>Naplata u ime i za račun trećeg lica</small></td>

									<td style="min-width:6em !important;text-align:right" class="pad4px">
										{$driversPriceSum_TecajRSD|number_format:2:".":""}
										<input type="hidden" name="driversPriceSum" value="{$driversPriceSum|number_format:2:".":""}">
									</td>
								</tr>
							
							{/if}
							
							<tr>
								<td class="pad4px"></td>
								<td class="pad4px"></td>
								<td class="pad4px"></td>
								<td class="ucase pad4px"><small><strong>Svega po računu (RSD)</strong></small></td>

								<td style="min-width:6em !important;text-align:right" class="pad4px">
									<strong>{$totalEur_TecajRSD|number_format:2:".":""}</strong>
									<input type="hidden" name="GrandTotal" value="{$totalEur}">
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
										{if !$saved}
											{$smarty.now|date_format:"d.m.Y"}
											{else}
												{$smarty.request.InvoiceDate|date_format:'d. M Y'}
										{/if}
									</span>, Beograd<br>
									
									Dokument izdala (identifikaciona oznaka): <br>
									{$smarty.session.UserRealName}, {$smarty.session.UserIDD}

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


						</table>
				</td>
			</tr>
			<!-- /.content -->

		</table>
	</form>
<!-- /.content-wrapper -->
</div>


<script>
	$(".jqdatepicker").datepicker({ dateFormat: 'dd.mm.yy' });

</script>