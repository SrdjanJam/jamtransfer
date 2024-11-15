{if $noOfTransfers2 gt 0}
<div class="box">
	<div class="inner">
		<h3 class="box-title">{$UNCOMPLETED_TRANSFERS}</h3><br>

		{section name=pom loop=$details2}
			<div class='row'>
				<div class="col-sm-2">
					<small>{$details2[pom].OrderID}-{$details2[pom].TNo}</small> 
				</div>	
				<div class="col-sm-2">			
					<strong>{$details2[pom].PickupDate} {$details2[pom].PickupTime}</strong>
				</div>			
				<div class="col-sm-6">			
					<strong>{$details2[pom].PickupName} - {$details2[pom].DropName}</strong>
				</div>	
				<div class="col-sm-2">
					<button  type="button" class="btn btn-primary mac" data-toggle="modal" data-target="#complete{$details2[pom].DetailsID}">
						{$FINISH_TRANSFER}
					</button>
					<div class="modal fade"  id="complete{$details2[pom].DetailsID}">
						<div class="modal-dialog" style="width: fit-content;">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title">{$FINISH_TRANSFER}</h4>
								</div>
								<div class="modal-body" style="padding:10px">
									<button id='mac' class="btn btn-default" onclick="changeDriverConfStatus('{$details2[pom].DetailsID}', '7');" >		 
										<i class="fa fa-check-circle l"></i> {$MARK_COMPLETED}
									</button>	

									<button class=" btn btn-default" onclick="$('#noShow').show('slow');">
										<i class="fa fa-minus-square l"></i> {$MARK_NOSHOW} / {$MARK_DRIVER_ERROR}
									</button>

									<div class="row ">
										<div id="noShow" class="col-md-12" style="display:none">
											<br>{$DETAIL_DESCRIPTION}:<br>
											<textarea name="FinalNote" id="FinalNote" rows="5">{$details2[pom].FinalNote}</textarea>
											<button class="btn btn-primary" 
												onclick="changeDriverConfStatus('{$details2[pom].DetailsID}', '5');$('#btnSave').click();">
												<i class="fa fa-minus-square l"></i> {$MARK_NOSHOW}
											</button>
											<button class="btn btn-danger" 
												onclick="changeDriverConfStatus('{$details2[pom].DetailsID}', '6');$('#btnSave').click();">
												<i class="fa fa-taxi l"></i> {$MARK_DRIVER_ERROR}
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>			
				</div>	
			</div>
		{/section}	
		<br><small style="font-size:14px">{NO_OF} {$noOfTransfers2}</small>
	</div>	
</div>
<br>
<script>
	// changeDriverConfStatus
	function changeDriverConfStatus(detailsid, newstatus) {
		var FinalNote=$("#FinalNote").val();
		var url = './plugins/Orders/changeDriverConfStatus.php'+
			"?DetailsID=" + detailsid +
			"&NewStatus="+newstatus +
			"&FinalNote="+FinalNote;
		console.log(url); 
		$.ajax({
			type: 'POST',
			url: url,
			async: true,
			success: function(data) {
				$.toaster('Status changed', 'Done', 'success blue-2');
				location.reload();
			}
		})
		return false;
	}
</script>
{/if}	