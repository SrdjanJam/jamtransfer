<script type="text/x-handlebars-template" id="transfersTemplate">

	{{#each transfers}}

		<a onclick="showOneTransfer({{DetailsID}});">
			<div class="row xbox-solid xbg-light-blue {{color}} pad1em listTile" 
			style="border-top:1px solid #eee;border-bottom:0px solid #eee" 
			id="t_{{DetailsID}}">

				<div class="col-md-2">
					<!--
					<span class="{{driverConfStyle DriverConfStatus}}">
						{{driverConfText DriverConfStatus}}
					</span>
					<br>
					-->
					<i class="fa fa-user"></i> <strong>{{PaxName}}</strong><br>

					<small>
						<i class="fa fa-envelope-o"></i> {{MPaxEmail}}
						<br>
						<i class="fa fa-phone"></i> {{MPaxTel}}
					</small>
					<br>
					<small>{{OrderDate}} {{MOrderTime}}</small>
				</div>
				<div class="col-md-2">
					<strong>{{MOrderID}} - {{TNo}}</strong><br>
					{{DetailPrice}} <?= $_SESSION['Currency2'] ?><br>
					<small>{{displayTransferStatusText TransferStatus}}</small><br>
					<small>{{displayDriverConfStatusText DriverConfStatus}}</small>
				</div>

				<div class="col-md-2">
					{{#compare PickupDate ">=" "<?=date('Y')+1;?>-01-01"}}<span class="red-text">{{/compare}}
					{{PickupDate}}
					{{#compare PickupDate ">=" "<?=date('Y')+1;?>-01-01"}}</span>{{/compare}}
					<br>
					{{PickupTime}}
					<br>
					<i class="fa fa-user-times"></i> <strong>{{PaxNo}}</strong>
				</div>

				<div class="col-md-2">
					<strong>{{PickupName}}</strong>
					<br>
					<strong>{{DropName}}</strong>
				</div>

				<div class="col-md-3">
					<i class="fa fa-sticky-note-o"></i> {{InvoiceAmount}} <?= $_SESSION['Currency'] ?>
					<br>
					<i class="fa fa-plus-square"></i> {{ProvisionAmount}} <?= $_SESSION['Currency'] ?>
				</div>
			</div>
		</a>

		<div id="transferWrapper{{DetailsID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{DetailsID}}" class="row ">
				<div id="oneTransfer{{DetailsID}}" class="xcol-md-12">
					<?= THERE_ARE_NO_DATA ?>
				</div>
			</div>
		</div>

	{{/each}}
	

</script>

