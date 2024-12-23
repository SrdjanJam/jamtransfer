<!DOCTYPE html>
<html>
<body>

<h2>Service Builder Basics</h2>

<form action="" method="POST">
	<div class="container">
		<input type="hidden" id="OwnerID" name="OwnerID" value="{$smarty.session.UseDriverID}"/>
		<div class="row">
			<label class="col-md-2">Basic Price:</label>
			<div class="col-md-2">
				<select class="form-control" id="PriceType" name="PriceType" value="{$PriceType}">
					<option value='1'>Price per route</option>				
					<option value='2' {if $PriceType eq 2}selected{/if}>Price per km</option>
				</select>
			</div>	
		</div>		
		<div class="row km hidden">
			<label class="col-md-2">Start price:</label>
			<div class="col-md-2">
				<input class="form-control" type="text" id="StartPrice" name="StartPrice" value="{$StartPrice}">
			</div>			
			<label class="col-md-2">Price per km:</label>
			<div class="col-md-2">
				<input class="form-control" type="text" id="PriceKM" name="PriceKM" value="{$PriceKM}">
			</div>	
		</div>
		<div class="row">
			<label class="col-md-2">Vehicle type Prices:</label>
			<div class="col-md-2">
				<select class="form-control" id="VehiclePriceType" name="VehiclePriceType" value="{$VehiclePriceType}">
					<option value='1'>Coefficient List</option>				
					<option value='2' {if $VehiclePriceType eq 2}selected{/if}>Absolute Prices</option>
				</select>
			</div>	
		</div>			
		
		
		
		<div class="row">		
			<div class="col-lg-2 col-md-2">
				<button class="form-control btn btn-success" type="submit" name="submit" id="Save">{$SAVE}</button>	
			</div>			
		</div>	
	</div>
</form> 

</body>
</html>

<script>
{literal}
	if ($("#PriceType option:selected").val()==2) $(".km").removeClass('hidden');
	$("#PriceType").change(function(){
		if ($("#PriceType option:selected").val()==2) $(".km").removeClass('hidden');
		else $(".km").addClass('hidden');
	})
{/literal}	
</script>