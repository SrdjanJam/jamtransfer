<script type="text/x-handlebars-template" id="ItemEditTemplate">
<form id="ItemEditForm{{CustID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">
		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>

				<button class="btn btn-warning" title="<?= CLOSE?>"
					onclick="return editCloseItem('{{ID}}');">
					<i class="fa fa-close"></i>
				</button>

				<? } ?>	

				<button class="btn btn-info" title="<?= SAVE_CHANGES ?>"
					onclick="return editSaveItem('{{CustID}}');">
					<i class="fa fa-save"></i>
				</button>

		</div>
	</div>
	
	<div class="box-body ">
        <div class="row">
			<div class="col-md-6">
				<!-- CUSTOMER_ID: -->
				<div class="row">
					<div class="col-md-3">
						<label for="CustID"><?=CUSTOMER_ID;?></label>
					</div>
					<div class="col-md-9">
						{{CustID}}
					</div>
				</div>				
				<div class="row">
					<div class="col-md-3">
						<label for="CustID"><?=PERSONAL_CODE;?></label>
					</div>
					<div class="col-md-9">
						<strong>{{PersonalCode}}</strong>
					</div>
				</div>
				<!-- SITE: -->
				<!--<div class="row">
					<div class="col-md-3">
						<label for="Site"><?=SITE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Site" id="Site" class="w100" value="{{Site}}">
					</div>
				</div>!-->

				<!-- CUSTOMER_FIRST_NAME: -->
				<div class="row">
					<div class="col-md-3">
						<label for="CustFirstName"><?=CUSTOMER_FIRST_NAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustFirstName" id="CustFirstName" class="w100" value="{{CustFirstName}}">
					</div>
				</div>
				<!-- CUSTOMER_LAST_NAME: -->
				<div class="row">
					<div class="col-md-3">
						<label for="CustLastName"><?=CUSTOMER_LAST_NAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustLastName" id="CustLastName" class="w100" value="{{CustLastName}}">
					</div>
				</div>
				<!-- CUSTOMER_COUNTRY: -->
				<div class="row">
					<div class="col-md-3">
						<label for="CustCountry"><?=CUSTOMER_COUNTRY;?></label>
					</div>
					<div class="col-md-9">
						{{countrySelect CustCountry 'CustCountry' 'ID'}}
					</div>
				</div>
				<!-- CUSTOMER_LANGUAGE: -->
				<div class="row">
					<div class="col-md-3">
						<label for="CustLanguage"><?=CUSTOMER_LANGUAGE;?></label>
					</div>
					<div class="col-md-9">
						{{languageSelect Language 'Language'}}
					</div>
				</div>
				<!-- CUSTOMER_EMAIL: -->
				<div class="row">
					<div class="col-md-3">
						<label for="CustEmail"><?=CUSTOMER_EMAIL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustEmail" id="CustEmails" class="w100" value="{{CustEmail}}">
					</div>
				</div>
				<!-- CUSTOMER_ADDRESS: -->
				<div class="row">
					<div class="col-md-3">
						<label for="CustAddress"><?=CUSTOMER_ADDRESS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustAddress" id="CustAddress" class="w100" value="{{CustAddress}}">
					</div>
				</div>
				<!-- CUSTOMER_CITY: -->
				<div class="row">
					<div class="col-md-3">
						<label for="CustCity"><?=CUSTOMER_CITY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustCity" id="CustCity" class="w100" value="{{CustCity}}">
					</div>
				</div>
				<!-- CUSTOMER_ZIP: -->
				<div class="row">
					<div class="col-md-3">
						<label for="CustZip"><?=CUSTOMER_ZIP;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustZip" id="CustZip" class="w100" value="{{CustZip}}">
					</div>
				</div>
				<!-- CUSTOMER_MOBILE: -->
				<div class="row">
					<div class="col-md-3">
						<label for="CustMobile"><?=CUSTOMER_MOBILE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustMobile" id="CustMobile" class="w100" value="{{CustMobile}}">
					</div>
				</div>
				<!-- CUSTOMER_PASS: -->
				<!--<div class="row">
					<div class="col-md-3">
						<label for="CustPass"><?=CUSTOMER_PASS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustPass" id="CustPass" class="w100" value="{{CustPass}}">
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<label for="CustSubscibed"><?=CUSTOMER_SUBSCRIBED;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustSubscibed" id="CustSubscibed" class="w100" value="{{CustSubscibed}}">
					</div>
				</div>!-->
				<!-- CUSTOMER_ACTIVE: -->
				<div class="row">
					<div class="col-md-3">
						<label for="CustActive"><?=CUSTOMER_ACTIVE;?></label>
					</div>
					<div class="col-md-9">
						{{yesNoSliderEdit CustActive 'CustActive' }}
					</div>
				</div>			
				<!-- CUSTOMER_IMAGE: -->
				<!--<div class="row">
					<div class="col-md-3">
						<label for="CustImage"><?=CUSTOMER_IMAGE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustImage" id="CustImage" class="w100" value="{{CustImage}}">
					</div>
				</div>!-->
				<!-- CUSTOMER_IMAGE_TYPE: -->
				<!--<div class="row">
					<div class="col-md-3">
						<label for="CustImageType"><?=CUSTOMER_IMAGE_TYPE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustImageType" id="CustImageType" class="w100" value="{{CustImageType}}">
					</div>
				</div>!-->

			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-3">
						<label for="ReservationNumber"><?=NUMBER_OF_RESERVATION;?></label>
					</div>
					<div class="col-md-9">
						{{OrdersCount}}
					</div>
				</div>				
				<div class="row">
					<div class="col-md-3">
						<label for="ReservationNumber"><?=VALUE_OF_RESERVATION;?></label>
					</div>
					<div class="col-md-9">
						{{OrdersValue}}
					</div>
				</div>	
				<!-- CUSTOMER_TYPE: -->
				<div class="row">
					<div class="col-md-3">
						<label for="CustType"><?=CUSTOMER_TYPE;?></label>
					</div>
					<div class="col-md-9">
						{{customerSelect CustType 'CustType'}}
					</div>
				</div>	
				<!-- DISCOUNT: -->
				<div class="row">
					<div class="col-md-3">
						<label for="Discount"><?=DISCOUNT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Discount" id="Discount" class="w100" value="{{Discount}}">
					</div>
				</div>					
			</div>
	    </div>
		   
</form>

	<script>

		//bootstrap WYSIHTML5 - text editor
		$(".textarea").wysihtml5({
				"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
				"emphasis": true, //Italics, bold, etc. Default true
				"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
				"html": true, //Button which allows you to edit the generated HTML. Default false
				"link": true, //Button to insert a link. Default true
				"image": true, //Button to insert an image. Default true,
				"color": true //Button to change color of font 
				
		});
		
		// uklanja ikonu Saved - statusMessage sa ekrana
		$("form").change(function(){
			$("#statusMessage").html('');
		});
	
	
		$("#PlaceNameEN").keyup(function(){
			var place = $("#PlaceNameEN").val();
			$("#PlaceNameSEO").val( getSlug( place , '+') );
		});
		
		$("#PlaceCountry").change(function(){
			$("#CountryNameEN").val( $("#PlaceCountry option:selected").text());
		});
	</script>
</script>

