	<style>
		.leaflet-popup-content-wrapper .leaflet-popup-content {
			color:blue;
			font-size: 70%;
			width: 70%;
		}
		.greenroute {
			color:green;
		}
	</style>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
		 integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
		 crossorigin=""/>
	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
		 integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
		 crossorigin="">
	</script>
<script type="text/x-handlebars-template" id="ItemEditTemplate">
<form id="ItemEditForm{{RouteID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">
		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<button class="btn btn-warning" title="<?= CLOSE?>" 
				onclick="return editCloseItem('{{RouteID}}');">
				<i class="fa fa-close"></i>
				</button>

				<button class="btn btn-danger" title="<?= CANCEL ?>" 
				onclick="return deleteItem('{{RouteID}}');">
				<i class="fa fa-ban"></i>
				</button>
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSaveItem('{{RouteID}}');">
			<i class="fa fa-save"></i>
			</button>			
		</div>
	</div>

	<div class="box-body ">
        <div class="row">
			<div class="col-md-12 ">
				<div class="row hidden">
					<div class="col-md-3">
						<label for="OwnerID"><?=OWNERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="OwnerID" id="OwnerID" class="w100" value="{{OwnerID}}" readonly>
					</div>
				</div>

				<div class="row hidden">
					<div class="col-md-3">
						<label for="RouteID"><?=ROUTEID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="RouteID" id="RouteID" class="w100" value="{{RouteID}}" readonly>
					</div>
				</div>

				<? if ($isNew) { ?>
				<div class="row">
					<div class="col-md-3">
						<label for="FromID"><?=FROM;?></label>
					</div>
					<div class="col-md-9">
						{{placeSelect FromID 'FromID'}}
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ToID"><?=TO;?></label>
					</div>
					<div class="col-md-9">
						{{placeSelect ToID 'ToID'}}
					</div>
				</div>
				<? } else {?>
				<div class="row">
					<div class="col-md-3">
						<label for="ToID"><?=ROUTENAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="hidden" name="FromID" id="FromID" value="{{FromID}}">
						<input type="hidden" name="ToID" id="ToID" value="{{ToID}}">					
						<a target="_blank" href="plugins/getRouteMap.php?RouteID={{RouteID}}">{{RouteName}}</a>
						{{Lng1}},{{Lat1}} - {{Lng2}},{{Lat2}}
					</div>
				</div>				
				<? }?>

				<div class="row">
					<div class="col-md-3">
						<label for="Approved"><?=APPROVED;?></label>
					</div>
					<div class="col-md-9">
						{{yesNoSliderEdit Approved 'Approved'}}
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TopRoute"><?=TOP_ROUTE;?></label>
					</div>
					<div class="col-md-9">
						{{yesNoSliderEdit TopRoute 'TopRoute' }}
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="TerminalID"><?=TERMINAL;?></label>
					</div>
					<div class="col-md-9">
						{{placeSelect TerminalID 'TerminalID'}}
					</div>

				</div>
				
				<div class="row hidden">
					<div class="col-md-3">
						<label for="RouteName"><?=ROUTENAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="RouteName" id="RouteName" class="w100" value="{{RouteName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Km"><?=KM;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Km" id="Km" class="w100" value="{{Km}}">{{Km2}}
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<label for="Duration"><?=DURATION;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Duration" id="Duration" class="w100" value="{{Duration}}">{{Duration2}}
					</div>
				</div>				
	
				<input type="hidden" name="Line" id="Line" class="w100" value="{{Line}}">
				<input type="hidden" name="TopRouteID" id="TopRouteID" class="w100" value="{{TopRouteID}}">
				<input type="hidden" name="ConFaktor" id="ConFaktor" class="w100" value="{{ConFaktor}}">
				<input type="hidden" name="LastChange" id="LastChange" class="w100" value="{{LastChange}}">
				<input type="hidden" name="Lng" id="Lng" class="w100" value="{{Lng}}">
				<input type="hidden" name="Lat" id="Lat" class="w100" value="{{Lat}}">

				<div class="row">
					<div class="col-md-12" id="map">{{Error}}</div>
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
		
		$("#FromID").change(function(){
			var from = $("#FromID option:selected").text();
			var to   = $("#ToID option:selected").text();
			$("#RouteName").val(from + ' - ' + to);
		
		});
		$("#ToID").change(function(){
			var from = $("#FromID option:selected").text();
			var to   = $("#ToID option:selected").text();	
			var fID=$("#FromID option:selected").val();
			var tID=$("#ToID option:selected").val();
			surTerminals(fID,tID); // New route
			$("#RouteName").val(from + ' - ' + to);
		});	
		var fID=$("#FromID").val();
		var tID=$("#ToID").val();
		surTerminals(fID,tID); // New route

		function surTerminals(fID,tID) {
			//var fID=$("#FromID option:selected").val();
			//var tID=$("#ToID option:selected").val();
			if (fID>0 && tID>0) {
				var base=window.rootbase;
				if (window.location.host=='localhost') base=base+'/jamtransfer';

				var link = base+'/plugins/Route/SurTerminals.php?fID='+fID+'&tID='+tID;
				var param = 'fID='+fID+'&tID='+tID;
				var $t = $(this);
				console.log(link+'?'+param);

				$('#TerminalID option').hide(); // All terminals hide

				$.ajax({
					type: 'POST',
					url: link,
					//data: param,
					async: false,
					dataType: 'jsonp',

					success: function(data) {
						var exist=false;
						$.each(data, function(i,val) {
							$('#TerminalID option[value="'+val+'"]').show();
							exist=true;
						});

						if (exist){
							$("#TerminalID").focus(function () {
								this.size=10;
								$(this).css({"height":"auto", "position":"absolute"});
							});

							$("#TerminalID").blur(function () {
								this.size=1;
								$(this).css({"height":"20px", "position":"inherit"});
							});

						}else{
							$("#TerminalID option").text("No Terminals...");
							$("#TerminalID").css({'color':'#ff6666','font-weight':'bold'});
						}
						
						
					} // Exit success: function

				}); // End of ajax request
			}

		} // End of surTerminals()	
	
		/*var lng=$("#Lng").val();	
		var lat=$("#Lat").val();		
		var w=$("#map").width();
		if (w>1000) w=1000;
		else if(w>800) w=800;
		h=w*0.7;
		$("#map").width(500);
		$("#map").height(350);
		var map = L.map('map').setView([lat, lng], 15);
			L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
			maxZoom: 19,
			attribution: ''
		}).addTo(map);
		$(".leaflet-attribution-flag").remove();
		$(".leaflet-control").remove();	
		var line=$("#Steps").val();	
		var Pline=JSON.parse(line);
		var polyline = L.polyline(Pline).addTo(map);*/
	</script>	


	
</script>

