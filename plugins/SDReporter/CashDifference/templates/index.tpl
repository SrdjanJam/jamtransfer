
<div class="white center">
	{if isset($smarty.request.DateFrom) and isset($smarty.request.DateTo)}
		<div class="row">
			<h3>{$User}</h3>
			<a href="https://wis.jamtransfer.com/schedule/{$smarty.request.DateFrom}/{$smarty.request.DateTo}/{$smarty.request.SubDriverID}" target="_blank">{$SCHEDULE}</a>
		</div>
		<div class="row" style="border-bottom:1px solid #000;">
			<div class="col-md-1">
				<strong>OrderID</strong>
			</div>
			<div class="col-md-4">
				<strong>Transfer Info</strong>
			</div>
			<div class="col-md-3">
				<strong>Driver Notes</strong>
			</div>
			<div class="col-sm-2 ">
				<strong>Pay Later (EUR)</strong>
			</div>	
			<div class="col-sm-2">
				<strong>Cash In (EUR)</strong> 
			</div>
		</div>	
		{section name=ind loop=$orders}
			<div class="row pad1em" style="border-bottom:1px solid #ddd;">
				<div class="col-md-1">
					<a href="https://wis.jamtransfer.com/plugins/Orders/printTransfer.php?OrderID=
					{$orders[ind].OrderID}" target="_blank">{$orders[ind].OrderID}-{$orders[ind].TNo}</a>
				</div>
				<div class="col-md-4">
					{$orders[ind].PickupDate} {$orders[ind].PickupTime}<br>
					{$orders[ind].PaxName}<br>
					{$orders[ind].PickupName}-{$orders[ind].DropName}
				</div>
				<div class="col-md-3">
					{$orders[ind].SubDriverNote} 
				</div>
				<div class="col-sm-2 pad1em">
					{$orders[ind].PayLater} €
				</div>	
				<div class="col-sm-2 {$color} pad1em">
					{$orders[ind].CashIn} € 
				</div>
			</div>		
		{/section}
		<div class="row alert alert-success" style="margin-left:-15px;padding:4px;text-align:center">
			<div class="col-md-3">
				Transfers with Cash Difference: {$NumberOfCashDiffTransfers}
			</div>

			<div class="col-md-3">
				Total Transfers: {$NumberOfTransfers}
			</div>

			<div class="col-md-3">
				Total Pay Later: {$TotalPayLater} €
			</div>

			<div class="col-md-3">
				Total CashIn: {$TotalCashIn} €
			</div>
		</div>		
	{else}	
		<body>
		<style>
		    input, select { width: 200px; }
		    #RequiredFrom, #RequiredTo { visibility: hidden; padding-left: 4px; color: red; }
		    .formLabel { width: 100px; display: inline-block; }
		</style>

		<div class="container col-md-12">
			<form action="" method="POST" type="submit" onsubmit="return validate();">

				<div class="row">
					<div class="col-md-2">
						<label>Date From</label>
					</div>
					<div class="col-md-2">
						<input type="text" value="0" name="DateFrom" class="datepicker">
					</div>
				</div>

				<div class="row">
					<div class="col-md-2">
						<label>Date To</label>
					</div>
					<div class="col-md-2">
						<input type="text" value="0" name="DateTo" class="datepicker">
					</div>
				</div>

				<div class="row">
				    <div class="col-md-2">
						<label>SubDriver</label>
					</div>
					<div class="col-md-2">
						<select name="SubDriverID" id="SubDriverID">

						    <option value="0"> --- </option>
							{section name=ind2 loop=$sdrivers}
								<option value="{$sdrivers[ind2].id}">{$sdrivers[ind2].name}</option>
							{/section}
						</select>
					</div>
				</div>
				<br>
				<div class="row col-md-4">
			    	<button type="submit" class="btn btn-primary" name="submit"
					style="margin-left: 105px">Submit</button>
				</div>

				<div id="greska"></div>


				</div>
			</form>
		</div>
		</body>	
	
	{/if}	
</div>
	<script>

		function validate() {
			if( $("#DateTo").val() == 0 || $("#DateFrom").val() == 0 ) {
				$("#greska").html('<i class="fa fa-times fa-2x fa-spin"></i> Enter all data');
				return false;
			}
		}
	</script>	