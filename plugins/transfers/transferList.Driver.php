<script type="text/x-handlebars-template" id="transfersTemplate">

	{{#each transfers}}

		{{#compare TransferStatus "!=" "4"}}
		<a  onclick="showOneTransfer({{DetailsID}});">

		
			<div class="row xbox-solid xbg-light-blue {{color}} pad1em listTile" 
			style="border-top:1px solid #eee;border-bottom:0px solid #eee" 
			id="t_{{DetailsID}}">			
					<div class="col-md-2">
						<i class="fa fa-user"></i> <strong>{{PaxName}}</strong><br>

						<small>
							<i class="fa fa-phone"></i> {{MPaxTel}}
						</small>
					</div>
		
					<div class="col-md-2">
						<strong>{{OrderID}}-{{TNo}}</strong><br>
						{{PayLater}} <?= $_SESSION['Currency2'] ?><br>
						<small>{{displayTransferStatusText TransferStatus}}</small>
					</div>
					

					
					<div class="col-md-2">
						{{#compare PickupDate ">=" "<?=date('Y')+1;?>-01-01"}}<span class="red-text">{{/compare}}
						{{PickupDate}}
						{{#compare PickupDate ">=" "<?=date('Y')+1;?>-01-01"}}</span>{{/compare}}
						<br>
						{{PickupTime}}
						<br>
						<i class="fa fa-user-times"></i> <strong>{{PaxNo}}</strong>&nbsp;
						<i class="fa fa-car"></i> <strong>{{VehiclesNo}}</strong>
						{{#compare ExtraCharge ">" 0}}
							<i class="fa fa-cubes" style="color:#900"></i>
						{{/compare}}
					</div>

					<div class="col-md-2">
						<strong>{{PickupName}}</strong>
						<br>
						<strong>{{DropName}}</strong>
					</div>

					<div class="col-md-3">
						<span class="{{driverConfStyle DriverConfStatus}}">{{driverConfText DriverConfStatus}}</span><br>
						<small>{{DriverNotes}}</small>
					</div>					
					<div class="col-md-1">
					</div>						
					<!--
					<div class="col-md-3">
						{{#if DriverName}}
							<i class="fa fa-car"></i> {{DriverName}}
						{{/if}}	
						<br>
						<span class="{{driverConfStyle DriverConfStatus}}">{{driverConfText DriverConfStatus}}</span>
						<br>
						<small>{{DriverConfDate}} {{DriverConfTime}}</small>

					 
					</div>

					<div class="col-md-4">
						<input type="text" class="timepicker w25" name="StartTime{{DetailsID}}" id="StartTime{{DetailsID}}" value="{{PickupTime}}">
						
						<input type="text" name="SubDriver{{DetailsID}}" id="SubDriver{{DetailsID}}">
						
						<input type="text" name="Vehicle{{DetailsID}}" id="Vehicle{{DetailsID}}">
						
						
						<button  onclick="showOneTransfer({{DetailsID}});" class="btn s xblue xwhite-text">
							<i class="l fa fa-edit"></i> <?= EDIT ?>
						</button>
						
					</div>
-->

				</div>
				
		</a>
		
		<div id="transferWrapper{{DetailsID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{DetailsID}}" class="row ">
				<div id="oneTransfer{{DetailsID}}" class="xcol-md-12">
					<?= THERE_ARE_NO_DATA ?>
				</div>
			</div>
		</div>
		{{/compare}}

	{{/each}}

</script>

