{include file="{$root}/templates/add-style.tpl"}

<div class="container white">

	{if isset($smarty.request.StartDate) and isset($smarty.request.EndDate)}
		<h2>Select driver</h2> 
		{$smarty.request.StartDate} - {$smarty.request.EndDate}<br><br>

		<div class="row" style="font-weight:bold;border-bottom:1px solid #ccc; padding-bottom:5px">
			<div class="col-md-1 text-right">
				ID
			</div>
			<div class="col-md-8">
				Driver
			</div>
			<div class="col-md-1">
				Balance
			</div>
	
		</div> {* End of .row *}

		{section name=index loop=$user}

			{* Drivers list *}
			<div class="row row_e" style="border-bottom: 1px solid #ccc">

				<div class="col-md-1 text-right">{$driverId[index]}</div>

				<a href="{$root_home}driversTransfers/driversBalance/{$user[index].AuthUserID}/{$smarty.request.StartDate}/{$smarty.request.EndDate}/{$includePaymentMethod}">
					<div class="col-md-8">
						{* {$user[index].Country} - {$user[index].Terminal} - {$user[index].AuthUserCompany} - {$user[index].AuthUserTel} - {$connectedUserNamePlus[index]} *}

						{$user[index].Country} - {$user[index].Terminal} - {$user[index].AuthUserCompany} - {$user[index].AuthUserTel}
					</div>
				</a>

				<div class="col-md-1 text-right">
					{if $driversBalance[index] > 0 }
						{* <span style="color:rgb(180, 52, 52)">{$driversBalance[index]}</span> *}
						<span style="color:rgb(51, 180, 100)">{$driversBalance[index]}</span>
						{elseif $driversBalance[index] == 0}
							<span style="color:rgb(39, 37, 29)">{$driversBalance[index]}</span>
							{* {$driversBalance[index]} *}
						{else}
							<span style="color:rgb(180, 52, 52)">{$driversBalance[index]}</span>
							{* {$driversBalance[index]} *}
					{/if}
				</div>
							
			</div> {* End of .row *}

		{/section} {* End of section*}

		<div class="row" style="font-weight:bold;background:#f5f5f5;padding:15px;">
			Total Balance <div class="col-md-2 col-md-offset-3 text-right">{$totalBalance|number_format:2}</div>
		</div>
		{else}

			<form action="" method="post">
			
				<div class="row">
					<div class="col-md-12">
						<h2>New Driver Invoice</h2> 
					</div>
				</div>

				<div class="row">
					<div class="col-md-2">
						<label>Start Date:</label>
					</div>
					<div class="col-md-4 col-md-4_e">
						<input type="text" name="StartDate" class="form-control datepicker">
					</div>
				</div>

				<div class="row">
					<div class="col-md-2">
						<label>End Date:</label>
					</div>
					<div class="col-md-4">
						<input type="text" name="EndDate" class="form-control datepicker">
					</div>
				</div>

				{* Checkbox: *}
				<div class="row">
					<div class="col-md-1">
						<label><b>Include</b></label>
					</div>

					<div class="col-md-2">
						Online<input type="checkbox" name="Online" class="form-control" value="1">
					</div>
					<div class="col-md-2">
						Cash<input type="checkbox" name="Cash" class="form-control" value="1">
					</div>			
					<div class="col-md-2">
						Online + Cash <input type="checkbox" name="OnlineCash" class="form-control" value="1">
					</div>
					<div class="col-md-2">
						Invoice <input type="checkbox" name="Invoice" class="form-control" value="1">
					</div>
					<div class="col-md-2">
						Invoice 2 <input type="checkbox" name="Invoice2" class="form-control" value="1">
					</div>

					<!-- select all boxes -->
					<div class="col-md-1">
						<span style="color:rgb(21 85 229);">Check All</span><input type="checkbox" name="select-all" class="form-control" id="select-all" />
					</div>	

				</div>

				<div class="row">
					<div class="col-md-4 col-md-offset-2">
						<br>
						<button class="btn btn-primary" type="submit" name="Submit" value="1">Go</button>
					</div>
				</div>

			</form>

	{/if} {* End of StartDate EndDate *}

</div> {* End of container white *}

<script>
	// Listen for click on toggle checkbox
	$(document).ready(function(){
		$('#select-all').click(function(event) {   
		if(this.checked) {
			// Iterate each checkbox
			$(':checkbox').each(function() {
				this.checked = true;                        
			});
		} else {
			$(':checkbox').each(function() {
				this.checked = false;                       
			});
		}
	});
	});
</script>