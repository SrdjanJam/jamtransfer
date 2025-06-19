	<div class="form">
		{if !$MOBILE}
		<div class="row font-weight-bold">
			<div class='col-lg-1 col-md-2'><strong>{$IMAGE}</strong></div>					
			<div class='col-lg-2 col-md-3'><strong>{$NAME}</strong></div>					
			<div class='col-lg-1 col-md-1'><strong>{$YEAR}</strong></div>					
			<div class='col-lg-1 col-md-1'><strong>Max {$PAX}</strong></div>				
			<div class='col-lg-2 col-md-2'><strong>{$TYPE}</strong></div>				
			<div class="col-lg-1 col-md-1"><strong>{$PRICE} Coeff.</strong></div>				
		</div>	
		{/if}
		{section name=pom1 loop=$vehicles}
		<form class="formIMG" name="formIMG" action="" method="POST" enctype="multipart/form-data">
			<div class="row">
				<input type="hidden" name="VehicleID" id="VehicleID" value="{$vehicles[pom1].VehicleID}">
				<input type="hidden" name="OwnerID" id="OwnerID" value="{$smarty.session.UseDriverID}">
				<div class='col-lg-1 col-md-2'>
					<img src="plugins/SBuilder/Vehicle/showImage.php?VehicleID={$vehicles[pom1].VehicleID}&default=cars/minivanl"
					style="max-height:60px; max-width:160px;overflow:hidden;" 
					class="img-thumbnail" id="preview{$vehicles[pom1].VehicleID}" value="">						
					<input type="file" name="Picture" id="Picture{$vehicles[pom1].VehicleID}" onchange="previewFile({$vehicles[pom1].VehicleID})" class="hidden" >
					<button id="imgUpload" class="btn btn-xs btn-default" 
						onclick="$('#Picture{$vehicles[pom1].VehicleID}').click();return false;">
						{$UPLOAD_NEW_IMAGE}
					</button>
				</div>					
				<div class='col-lg-2 col-md-3'>
					<input class="form-control" id="VehicleName" type="text" name="VehicleName" value="{$vehicles[pom1].VehicleName}" placeholder="{$NAME}" />
				</div>					
				<div class='col-lg-1 col-md-1 col-xs-6'>
					<input class="form-control" id="Year" type="text" name="Year" value="{$vehicles[pom1].Year}" placeholder="{$YEAR}"/>
				</div>					
				<div class='col-lg-1 col-md-1 col-xs-6'>
					<input class="form-control" id="MaxPax" type="number" name="MaxPax" value="{$vehicles[pom1].MaxPax}" placeholder="Max {$PAX}"/>
				</div>				
				<div class='col-lg-2 col-md-2 col-xs-6'>
					<select id="Type" name="Type" class="form-control" value="{$vehicles[pom1].Type}">

						{html_options values=$type_val selected=$vehicles[pom1].Type output=$type_out}

					</select>	
				</div>				
				<div class="col-lg-1 col-md-1 col-xs-6">
					<input class="form-control" id="PriceCoeff" type="text" name="PriceCoeff" value="{$vehicles[pom1].PriceCoeff}" placeholder="{$PRICE} Coeff."/>
				</div>				
				<div class="col-lg-2 col-md-2 col-xs-6">
					<button type="submit" name="submit" class="btn btn-success" id="Save">{$SAVE}</button>	
					{if $vehicles[pom1].VehicleID ne 0}	
						<button data-id="{$vehicles[pom1].VehicleID}" type="button" class="btn btn-warning delete">{$DELETE}</button>
					{/if}	
				</div>	
			</div>	
		</form>
		{/section}
	</div>
<script>
{literal}	


$(".delete").click(function(){
	var url='./plugins/SBuilder/Vehicle/deleteVehicle.php?id='+$(this).attr("data-id");
	console.log(url);
	$.ajax({
		url:  url,
		type: 'GET',
		success: function(data) {
			toastr['success'](window.success);
			window.location.href = window.location.href;
		}	
	})
})

function previewFile(id) {
  var preview = document.querySelector('img#preview'+id);
  var file    = document.querySelector('input#Picture'+id).files[0];
  var reader  = new FileReader();

  reader.onloadend = function () {
    preview.src = reader.result;
  }
  if (file) {
    preview.src=reader.readAsDataURL(file);
  } else {
    preview.src = "";
  }
}

{/literal}	
</script>

	
