<form name="exchangeRate" method="post" action="">
	<div class="container container-edit">
		<div class="box box-info pad1em shadowLight shadowLight-edit">
			<h2>Vat rate</h2> 
			<div class="row">
				<div class="col-md-3">VAT rate</div>
				<div class="col-md-3">
					<input type="text" name="vatRate" value="{$vat}"> %
				</div>		
				<div class="col-md-6">
					<button name="setRate" type="submit" class="btn btn-primary rate-edit " value="1">{$SET_NEW_RATE}</button>
				</div>	
			</div>
			
			{$message}

		</div>
	</div>
</form>

