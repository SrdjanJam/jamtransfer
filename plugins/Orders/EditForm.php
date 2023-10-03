<?= $newID ?>
<script type="text/x-handlebars-template" id="ItemEditTemplate">

	<form id="ItemEditForm{{details.DetailsID}}" class="form box box-info" method="post" onsubmit="return false;">
				
		<div class="box-header box-header-edit">
			<div class="box-tools pull-right">
				{{#compare details.DriverConfStatus ">" 0}}
					<button id='resendVoucher' class="btn btn-primary"><?= RESEND_VOUCHER ?></button>
					<label id='lrv' style='display:none'><?= RESEND_VOUCHER ?> <?=REASON;?></label>	
					{{changeTransferReasonSelect details.ChangeTransferReason}}
					<button id='todriver' class="btn btn-primary" style='display:none'
					onclick="return sendUpdateEmail('{{details.DriverEmail}}','','','','','driver','{{details.DetailsID}}',this);">
						<?= TO_DRIVER ?>
						<div></div>
					</button>
					<button id='topax' class="btn btn-primary" style='display:none'
					onclick="return sendUpdateEmail('{{master.MPaxEmail}}','','','','','pax','{{details.DetailsID}}',this);">
						<?= TO_PAX ?>
						<div></div>
					</button>&nbsp;&nbsp;&nbsp;
				{{/compare}}

				<button class="btn " title="<?= CLOSE ?>"
				onclick="return editCloseItem('{{details.DetailsID}}');">
					<i class="fa fa-chevron-up l""></i>
				</button>

				<button id="save" class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
				onclick="return editSaveItem('{{details.DetailsID}}');">
				<i class="fa fa-save"></i>

				</button>
				<a href="plugins/Orders/printTransfer.php?OrderID={{details.OrderID}}" class="btn btn-danger" title="<?= PRINT_CONFIRMATION ?>" target="_blank">
					<i class="fa fa-print l"></i>
				</a>				
			</div>
		</div>

		<div class="box-body box-body-edit">
			<div class="nav-tabs-custom nav-tabs-custom-edit">

				{{#compare tab "==" "order"}}
					<ul class="nav nav-tabs dorder">
					<li class="active"><a href="#tab_1{{details.DetailsID}}" data-toggle="tab"><?= TRANSFER ?></a></li>
					<li><a href="#tab_2{{details.DetailsID}}" data-toggle="tab"><?= ORDER_LOG ?></a></li>
					</ul>
				{{/compare}}

				<div class="tab-content tab-content-edit">
					<!-- Tab pane 1: -->
					<div class="tab-pane active" id="tab_1{{details.DetailsID}}">

						<?php include('includes/order.php'); ?>
						<?php include('includes/payment.php'); ?>
						<?php include('includes/transfer.php'); ?>
						<?php include('includes/partner.php'); ?>
						<?php include('includes/agent.php'); ?> <!-- Purchaser -->
						<?php include('includes/passenger.php'); ?>
						
					</div> {{!-- tab-pane tab_1 --}}

					<!-- Tab pane 2: -->
					<div class="tab-pane" id="tab_2{{details.DetailsID}}">
						<div class="row">
							<div class="col-sm-12">
								{{#if orderLog}}
									<ul class="timeline">

										{{#each orderLog}}
											<li class="time-label">
												<span class="bg-light-blue">
													{{DateAdded}}
												</span>
											</li>

											<li>
												<i class="{{Icon}}"></i>
												<div class="timeline-item">
													<span class="time">
														<i class="fa fa-clock-o"></i> {{TimeAdded}}
													</span>

													<span class="timeline-header">
														{{Title}}
													</span>

													<div class="timeline-body">
														{{{Description}}}
													</div>
												</div>
											</li>
										{{/each}}

									</ul>
								{{else}}
									<i class="fa fa-exclamation-circle"></i> <?= NO_DATA ?>
								{{/if}}
							</div>{{!-- /.col-md-12 --}}
						</div> {{!-- /.row --}}
					</div>{{!-- tab-pane tab_2 --}}

				</div> {{!-- tab-content --}}

			</div> {{!-- nav tabs custom end --}}
		</div> {{!-- box-body --}}


		<input type="hidden" name="DetailsID" id="DetailsID" value="{{details.DetailsID}}">
		<!--<input type="hidden" name="AgentID" id="AgentID" value="{{details.AgentID}}">!-->		
		<input type="hidden" name="DriverName" id="DriverName" value="{{details.DriverName}}">
		<!--<input type="hidden" name="DriverTel" id="DriverTel" value="{{details.DriverTel}}">!-->
		<!--<input type="hidden" name="DriverEmail" id="DriverEmail" value="{{details.DriverEmail}}">!-->
		<input type="hidden" name="DriverConfTime" id="DriverConfTime" value="{{details.DriverConfTime}}">
		<input type="hidden" name="DriverConfDate" id="DriverConfDate" value="{{details.DriverConfDate}}">
		<!--<input type="hidden" name="UserName" id="UserName" value="<?= $_SESSION['UserName']?>">!-->
		<!--<input type="hidden" name="AuthUserID" id="AuthUserID" value="<?= $_SESSION['AuthUserID']?>">!-->
		<input type="hidden" name="OrderID" id="OrderID"   value="{{details.OrderID}}">
		<!--<input type="hidden" name="UserLevelID" id="UserLevelID"  value="{{details.UserLevelID}}">!-->
		<input type="hidden" name="PickupType" id="PickupType" value="{{details.PlaceType}}" >
		<input type="hidden" name="PickupID" id="PickupID" value="{{details.PickupID}}" >
		<input type="hidden" name="DropID" id="DropID" value="{{details.DropID}}" >
		<input type="hidden" name="RouteID" id="RouteID" value="{{details.RouteID}}" >
		<input type="hidden" name="sendEmailTo" id="sendEmailTo" value="{{details.DriverEmail}}">
		
	</form>
	<? if ($isNew) { ?>
		<script>
		$('document').ready(function() {
			$("#save").trigger("click");
		});		
		</script>
	<? } else  { ?>	
	<script>
		$(".mytooltip").popover({trigger:'hover', html:true, placement:'bottom'});
		//sistem za blokiranje promena u odnosu na statuse
		DriverConfStatusRelated();
		$('#DriverConfStatus').change(function(){
			DriverConfStatusRelated();
		})	
		function DriverConfStatusRelated() {
			if ($('#DriverConfStatus').val() > 1) {
				$('#DriverID').prop( "disabled", true );
				$('#DriversPrice').prop( "disabled", true );
				$('.searchdrivers').hide();
			}	
			else {
				$('#DriverID').prop( "disabled", false );
				$('#DriversPrice').prop( "disabled", false );
				$('.searchdrivers').show();				
			}	
			if ($('#DriverConfStatus').val() != 3) {
				$('#SubDriver').prop( "disabled", true );
				$('#SubDriver2').prop( "disabled", true );
				$('#SubDriver3').prop( "disabled", true );
			}			
		}
		// promena DriverID nakon klika na button u modalu
		$('.selectowner,.selectprice').click(function(){
			$('#DriverID').val($(this).attr('data-ownerid'));
			$('#DriversPrice').val($(this).attr('data-driverprice'));
			$('#VehicleType').val($(this).attr('data-vehicletype'));
			if ($(this).attr('class')=='selectprice') $('#DetailPriceX').val($(this).attr('data-price'));
			changedriver ();
			//changedriverpaymentamount ();			
			$('.modalbutton').trigger('click');
		})	
		$('#DriversPrice,#DriverExtraCharge').change(function(){
			changedriverpaymentamount ();
		})	
		// promena ukupne drajverske cene		
		function changedriverpaymentamount () {		
			$('#DriverPaymentAmt').val(Number($('#DriversPriceX').val())+Number($('#DriverExtraCharge').val()));
		}			
		$('#DriverID').change(function(){
			changedriver ();
		})	
		// promena telefona i email-a nakon promene drivera
		function changedriver () {	
			$('#DriverTel').val($('#DriverID :selected').attr('data-tel'));
			$('#DriverEmail').val($('#DriverID :selected').attr('data-email'));
		}			
		// promena mobilnog nakon promene subdrivera
		function changesubdriver (i) {
			$('#SubDriver'+i+'Mob').attr('href','tel:'+($('#SubDriver'+i+' :selected').attr('data-tel')));
			$('#SubDriver'+i+'Mob').text($('#SubDriver'+i+' :selected').attr('data-tel'));
		}		
		changesubdriver ('');		
		changesubdriver ('2');		
		changesubdriver ('3');		
		$('#SubDriver').change(function(){changesubdriver ('');})	
		$('#SubDriver2').change(function(){changesubdriver ('2');})	
		$('#SubDriver3').change(function(){changesubdriver ('3');})	
		// promena lokacija	
		$('#PickupName,#DropName').on('click keyup', function(event) {
			 if($(this).val() == "") {
				if($(this).attr('id') == "PickupName") $('#PickupID').val(0);
				if($(this).attr('id') == "DropName") $('#DropID').val(0);
			}
			var clicked_id='#'+$(this).attr('id');

			var loc=$(this).attr('id').replace("Name", "");
			var html = '';
			query = $(clicked_id).val();			
			if (query.length > 2) {				
				$.ajax({
					url:  './api/getFromPlacesEdgeN.php',
					type: 'GET',
					dataType: 'jsonp',
					data: {
						qry : query
					},
					error: function() {
						//callback();
					},
					success: function(res) {
						if(res.length > 0) {
							$.each( res, function( index, item ){
								html +='<button class="PickupName" id="'+ item.ID +
									'" data-name="'+item.Place+'">'+
									item.Place +
									'</button><br>';
							});
							// data received
							$("#selectFrom_options"+loc).show("slow");
							$("#selectFrom_options"+loc).html(html);

							// option selected
							$(".PickupName").click(function(){
								$(clicked_id).val($(this).attr('data-name'));
								$("#"+loc+"ID").val($(this).attr('id'));
								var fid=$(this).attr('id');
								$("#selectFrom_options"+loc).hide("slow");
								$.ajax({
									url:  './api/getToPlacesEdge.php',
									type: 'GET',
									dataType: 'jsonp',
									data: {
										fid : fid
									},
									error: function() {
										//callback();
									},
									success: function(res) {
										$.each(res, function(index, element) {
											console.log(element.RouteName)
											$("#Route").append(
												'<option data-toid="'+element.ToID+'" value="'+element.ID+'">'+element.ToPlace+'</option>'
											)	
										});				
										console.log (res);
									}
								})		
								
							});						
						}						
					}
				})	
			}
		})	
		// proemena rute
		$('#Route').change(function() {
			
			var toName = $(this).find("option:selected").text();	
			var toID = $(this).find("option:selected").attr('data-toid');	
			var rID = $(this).find("option:selected").val();
			$('#DropName').val(toName);
			$('#DropID').val(toID);
			$('#RouteID').val(rID);
		})	
		// promena ekstrasa
		$('.ServiceID').change(function() {
			var driverprice = $(this).find('option:selected').attr('data-driverprice');
			$(this).parent().parent().find('.driverprice').val(driverprice);			
			var price = $(this).find('option:selected').attr('data-price');
			$(this).parent().parent().find('.price').val(price);
		})	
		// resend voucher
		$('#ChangeTransferReason').hide();
		$('#resendVoucher').click(function() {
			$("#lrv").show(300);
			$("#ChangeTransferReason").show(300);
			$("#resendVoucher").hide();
		})	
		$('#ChangeTransferReason').click(function() {
			$('#todriver').show(300);
			$('#topax').show(300);		
		})
		$('#UserIDeX').change(function() {
			$('#UserID').val($(this).val());
		})			
		$('#AgentIDeX').change(function() {
			$('#AgentID').val($(this).val());
		})			
		$('#AuthLevelID').change(function() {
			$('#UserLevelID').val($(this).val());
			$('#UserIDeX option').hide();
			$('#AgentIDeX option').hide();
			$('*[data-levelid="'+$(this).val()+'"]').show();
		})	
		$('document').ready(function() {
			$('#UserIDeX option').hide();
			$('#AgentIDeX option').hide();			
			$('*[data-levelid="'+$('#UserLevelID').val()+'"]').show();
		})	
	</script>
	<? } ?>
</script>

