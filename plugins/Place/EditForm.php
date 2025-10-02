<script type="text/x-handlebars-template" id="ItemEditTemplate">
<form id="ItemEditForm{{PlaceID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">
		<div class="box-title">
			<? if ($isNew) { ?>
				<h3><?= NEWW ?></h3>
			<? } else { ?>
				<h3><?= EDIT ?> - {{PlaceNameEN}}</h3>
			<? } ?>
		</div>
		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<button class="btn btn-warning" title="<?= CLOSE?>" 
				onclick="return editCloseItem('{{PlaceID}}');">
				<i class="fa fa-close"></i>
				</button>

				<button class="btn btn-danger" title="<?= CANCEL ?>" 
				onclick="return deleteItem('{{PlaceID}}');">
				<i class="fa fa-ban"></i>
				</button>
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSaveItem('{{PlaceID}}');">
			<i class="fa fa-save"></i>
			</button>			
			<button class="btn btn-info" title="Top Routes" 
			onclick="return topRoutes('{{PlaceID}}');">
			<i class="fa fa-road"></i>
			</button>
		</div>
	</div>
	
	<div class="box-body ">
        <div class="row">
			<div class="col-md-12">
				<div class="row hidden">
					<div class="col-md-3">
						<label for="PlaceID"><?=PLACEID;?></label>
					</div>
					<div class="col-md-9">
						{{PlaceID}}
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<label for="PlaceCountry"><?=PLACECOUNTRY;?></label>
					</div>
					<div class="col-md-9">
						{{countrySelect PlaceCountry 'PlaceCountry' 'ID'}}
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceType"><?=PLACETYPE;?></label>
					</div>
					<div class="col-md-9">
						{{placeTypeSelect PlaceType 'PlaceType' }}
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="PlaceNameEN"><?=PLACENAMEEN;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceNameEN" id="PlaceNameEN" class="w100" value="{{PlaceNameEN}}">
					</div>
				</div>
				<input type="hidden" name="PlaceNameENold" id="PlaceNameENold" value="{{PlaceNameEN}}"> 
				

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceNameSEO"><?=PLACENAMESEO;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceNameSEO" id="PlaceNameSEO" class="w100" value="{{PlaceNameSEO}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceCity"><?=PLACECITY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceCity" id="PlaceCity" class="w100" value="{{PlaceCity}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceAddress"><?=PLACEADDRESS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PlaceAddress" id="PlaceAddress" class="w100" value="{{PlaceAddress}}">
					</div>
				</div>

				<!--<div class="row">
					<div class="col-md-3">
						<label for="PlaceDesc"><?=PLACEDESC;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="PlaceDesc" id="PlaceDesc" rows="5" 
					class="textarea" cols="50" style="width:100%">{{PlaceDesc}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Image"><?=IMAGE;?></label>
					</div>
					<div class="col-md-6">
						<input type="text" name="Image" id="Image" class="w100" value="{{Image}}">
					</div>
					<div class="col-md-3">					
						<img height="100px" src="{{Image}}" alt="{{PlaceCity}}">					
					</div>	
				</div>!--->
				
				<div class="row">
					<div class="col-md-3">
						<label for="Island"><?=ISLAND;?></label>
					</div>
					<div class="col-md-9">
						{{yesNoSliderEdit Island 'Island'}}
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="row"> 
							<div class="col-md-3">
								<label for="Longitude"><?=LONGITUDE;?></label>
							</div>
							<div class="col-md-9">
								<input type="text" name="Longitude" id="Longitude" class="w100" value="{{Longitude}}"> {{LongitudeOld}}
							</div>
						</div>					
						<div class="row">
							<div class="col-md-3">
								<label for="Latitude"><?=LATITUDE;?></label>
							</div>
							<div class="col-md-9">
								<input type="text" name="Latitude" id="Latitude" class="w100" value="{{Latitude}}"> {{LatitudeOld}} 
							</div>
						</div>	
						<div class="row">
							<div class="col-md-3">
								<button type="button" class='Routable button btn btn-info'><?=ROUTABLE;?></button>
							</div>
							<div class="col-md-9">
							</div>
						</div>							
						
						
						<div class="row">
							<div class="col-md-3">
								<label for="Elevation"><?=ELEVATION;?></label>
							</div>
							<div class="col-md-9">
								<input type="text" name="Elevation" id="Elevation" class="w100" value="{{Elevation}}"> 
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-3">
								<iframe id="framemap" src="https://maps.google.com/maps?q={{Latitude}}, {{Longitude}}&z=10&output=embed" frameborder="0" style="border:0"></iframe>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">{{WikiDesc}}</div>
						</div>
					</div>

				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PlaceActive"><?=PLACEACTIVE;?></label>
					</div>
					<div class="col-md-9">
						{{yesNoSliderEdit PlaceActive 'PlaceActive' '1'}}
					</div>
				</div>	
				<div class="row">
					<div class="col-md-3">
						<label for="Terminal"><?=TERMINAL;?></label>
					</div>
					<div class="col-md-9">
						{{yesNoSliderEdit Terminal 'Terminal' }}
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label><?=DRIVERS;?>:</label>
					</div>
					<div class="col-md-9">
						{{Drivers}}
					</div>
				</div>
				
				<div class="row">			
					<div class="col-md-3 "><label><?= NEARBY_LOCATIONS ?></label></div>
					<div class="col-md-9" id='nearbylocations'>
						{{#each NearbyLocations}}
							<button data-route="{{FromID}}-{{PlaceID}}" type="button" class='btn btn-info NearbyLocations' {{Disabled}}>{{PlaceName}}</button>
						{{/each}}	
					</div>				
				</div>			
				
				<a id="tr" style="display:none;" href='plugins/Place/TopRoutes_{{PlaceID}}.csv'></a>


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
		
		$("#PlaceNameEN").change(function(){
			var place = $("#PlaceNameEN").val();
			var cc=$("#PlaceCountry Option:selected").attr('data-cc');
			var pt=$("#PlaceType Option:selected").val();
			if (pt!=2) var layers="venue";
			if (pt==2) var layers="locality";
			var url='plugins/Place/getLL.php?Place='+place+'&Layers='+layers+'&CC='+cc;
			console.log(url)
			$.ajax({
				type: 'GET',
				url: url,	
				dataType: 'json',				
				success: function(data) {
					$("#Longitude").val(data.Lng);
					$("#Latitude").val(data.Lat);
					$("#Elevation").val(data.Elv);
					var srcnew="https://maps.google.com/maps?q="+data.Lat+","+data.Lng+"&z=10&output=embed";
					$("#framemap").attr("src",srcnew);
				}						
			})			
		});		
		
		$("#PlaceCountry").change(function(){
			$("#CountryNameEN").val( $("#PlaceCountry option:selected").text());
		});	
		$(".Routable").click(function(){
			var btn=$(this);
			routable(btn);
		})		
		$("document").ready(function(){
			if ($("#Longitude").val()) {
				var btn=$('.Routable');
				routable(btn);
			}
		})	
			
		$(".NearbyLocations").click(function(){
			var route=$(this).attr("data-route");	
			var rt=this;
			var url='plugins/Place/InsertRoute.php?Route='+route;
			console.log(url);
			$.ajax({
				type: 'GET',
				url: url,		
				success: function() {
					$(rt).prop('disabled', true);
				}						
			})

		})	
		function topRoutes(id) {
			$.ajax({
				type: 'GET',
				url: 'plugins/Place/TopRoutes.Export.php?PlaceID='+id,		
				success: function(data) {
					$('#tr')[0].click();
					$.ajax({
						type: 'GET',
						url: 'plugins/Place/DeleteTopRoutesFile.php?PlaceID='+id,		
						success: function(data) {
						}
					})	
				}						
			})
			
		}			
		function routable(btn) {	
			var Lng=$(btn).parent().parent().parent().find('#Longitude').val();
			var Lat=$(btn).parent().parent().parent().find('#Latitude').val();
			console.log('plugins/Place/ifRoutable.php?Lat='+Lat+'&Lng='+Lng);
			var msg=$(btn).parent().next();
			$.ajax({
				type: 'GET',
				url: 'plugins/Place/ifRoutable.php?Lat='+Lat+'&Lng='+Lng,		
				success: function(data) {
					$(msg).html(data).css('font-weight', 'bold');
				}						
			})
		}	
		
	
	</script>
</script>

