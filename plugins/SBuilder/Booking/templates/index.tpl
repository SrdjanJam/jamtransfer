<!DOCTYPE html>
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


<html>
<body>

<form action="" method="POST">
	<input type="hidden" id="OwnerID" name="OwnerID" value="{$smarty.session.UseDriverID}"/>
	<div class="row terminal">
		<button class="form-control btn col-md-2 btn-lg direction" type="button" name="direction" id="arrival"><i class="fas fa-plane-arrival fa-xl"></i> From Airport</button>	
		<button class="form-control btn col-md-2 btn-lg direction" type="button" name="direction" id="departure">To Airport <i class="fas fa-plane-departure fa-xl"></i></button>		
		<div class="col-md-4 departure hidden">
			{$FROM}:<br>
			<div class="col-lg-6 col-md-6">
				<input class="step1" id="To" type="text" name="From" value="" placeholder="pick on map or type"/>
				<div id="select_optionsTo"  style="max-height:15em;overflow:auto"></div>
			</div>		
		</div>			
		<div class="col-md-4">
			<select class="form-control hidden h1" id="TID" name="TID" value="-1">
				{section name=ind loop=$terminals}
					<option data-lon="{$terminals[ind].lon}" data-lat="{$terminals[ind].lat}" value='{$terminals[ind].id}'>{$terminals[ind].name}</option>	
				{/section}	
			</select>
		</div>	
		<div class="col-md-4 arrival hidden">
			{$TO}:<br>
			<div class="col-lg-6 col-md-6">
				<input class="step1" id="To" type="text" name="From" value="" placeholder="pick on map or type"/>
				<div class="select_optionsTo hidden"  style="max-height:15em;overflow:auto"></div>
			</div>		
		</div>	
		
	</div>		
	<div class="row maps hidden">
		<div class="col-lg-9 col-md-9" id="map"></div>
		<div class="col-lg-3 col-md-3 form">			
			<div class="row step2 hidden">
				<div class="col-lg-6 col-md-6">
					<label>{$DISTANCE} / km:</label>
				</div>			
				<div class="col-lg-6 col-md-6">
					<input id="Distance" type="text" name="Distance" value="" readonly/>
				</div>
			</div><br>
			<div class="row step2 hidden">
				<div class="col-lg-6 col-md-6">
					<label>{$DURATION} / min:</label>
				</div>			
				<div class="col-lg-6 col-md-6">
					<input id="Duration" type="text" name="Duration" value="" readonly/>
				</div>
			</div><br>	
			<div class="row step2 hidden">
				<div class="col-lg-6 col-md-6">
					<label>{$PAX} No:</label>
				</div>			
				<div class="col-lg-6 col-md-6">
					<input id="PaxNo" type="number" min="0" name="PaxNo" value="0" />
				</div>				
				<div class="col-lg-6 col-md-6">
					<label>Children No:</label>
				</div>			
				<div class="col-lg-6 col-md-6">
					<input id="Children" type="number" min="0" name="Children" value="0" />
				</div>				
				<div class="col-lg-6 col-md-6">
					<label>Infants No:</label>
				</div>			
				<div class="col-lg-6 col-md-6">
					<input id="Infants" type="number" min="0" name="Infants" value="0" />
				</div>
			</div><br>				
			<div class="row step3 hidden">
				<div class="col-lg-2 col-md-2">
					<label>{$TIME}:</label>
				</div>			
				<div class="col-lg-5 col-md-5">
					<input id="Date" class="datepicker form-control" type="text" name="Date" value="" />
				</div>				
				<div class="col-lg-5 col-md-5 step4 hidden">
					<input id="Time" class="timepicker form-control" type="text" name="Time" value="" />
				</div>
			</div><br>				
			<div class="row step5 hidden">
				<div class="col-lg-2 col-md-2">
					<label>Return:</label>
				</div>			
				<div class="col-lg-5 col-md-5">
					<input id="DateR" class="datepicker form-control" type="text" name="DateR" value="" />
				</div>				
				<div class="col-lg-5 col-md-5 step6 hidden">
					<input id="TimeR" class="timepicker form-control" type="text" name="TimeR" value="" />
				</div>
			</div><br>				
			<input id="Line" type="hidden" name="Line" value=""/>	
			<input id="Price" type="hidden" name="Price" value=""/>
			<div class="row">		
				<div class="col-lg-4 col-md-4 step7 hidden">
					<button class="form-control btn btn-success" type="button" name="submit" id="prices">{$PRICE}</button>	
				</div>			
			</div><br>				
			<div class="row vehicles pattern hidden step8">
				<div class="col-lg-8 col-md-4 vehiclename"></div>	
				<button type="button" class="col-lg-4 col-md-2 price bg-success"></button>	
			</div><br>			
		</div>
	</div>
</form> 

</body>
</html>

<script>
{literal}
	$(".direction").click(function(){
		window.direction=$(this).attr('id'); 
		$(".direction").addClass('hidden');
		$(this).removeClass('hidden');
		$("#TID").removeClass('hidden');
	})
	if ($("#TID option:selected").val()>-1) $(".maps").removeClass('hidden');
	$("#TID").change(function(){
		if ($("#TID option:selected").val()>-1) {
			$("."+window.direction).removeClass("hidden");
			const planeIcon = L.divIcon({
				html: '<i class="fas fa-plane-'+window.direction+' fa-xl"></i>',
				iconSize: [20, 20],
				className: 'myDivIcon'
			});		
			$(".maps").removeClass('hidden');
			var longitude=$("#TID option:selected").attr("data-lon");
			var latitude=$("#TID option:selected").attr("data-lat");
			var w=$("#map").width();
			if (w>=1000) w=1000;
			else if(w>=800) w=800;
			h=w*0.7;
			$("#map").width(w);
			$("#map").height(h);
			var container = L.DomUtil.get('map');
			if(container != null){
				container._leaflet_id = null;
			}
			var map = L.map('map', {
				center: [latitude, longitude],
				zoom: 10
			});
			L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
				maxZoom: 19,
				attribution: ''
			}).addTo(map);
			$(".leaflet-attribution-flag").remove();
			$(".leaflet-control").remove();
			var LatLng = new L.LatLng(latitude, longitude);
			var marker = L.marker(LatLng,{icon: planeIcon}).addTo(map);
			map.on('click', onMapClick);
		} else $(".maps").addClass('hidden');
		
		$('.step1').on('click keyup', function(event) {
			var ft=$(this).attr("id");
			var className=ft+"Name";
			var select_options="#select_options"+ft;
			if ($(this).val().length > 2) {	
				var html = '';
				$.ajax({
					url:  './plugins/SBuilder/Router/getPlace.php',
					type: 'GET',
					dataType: 'jsonp',
					data: {
						qry : $(this).val()
					},
					error: function() {
						//callback();
					},
					success: function(res) {
						if(res.length > 0) {
							console.log(res);
							$.each( res, function( index, item ){

									var strike="";
									var cstrike=""
								html +=
									strike+
									'<button type="button" class="'+className+'" id="'+ item.ID +
									'" data-name="'+item.Place+
									'" data-long="'+item.Long+
									'" data-latt="'+item.Latt+
									'" data-country="'+item.Country+
									'"'+'>'+item.Place +
									'</button>'+
									cstrike+
									'<br>';
							});
							// data received
							$(".select_optionsTo").html(html);
							$(".select_optionsTo").removeClass("hidden");

							// option selected
							$(".ToName").click(function(){
								$(".step2").removeClass("hidden");	
								var Lng = $(this).attr('data-long');
								var Lat = $(this).attr('data-latt');
								var Name = $(this).attr('data-name');
								$(".step1").val(Name);
								$(".step1").attr('data-lng',Lng);
								$(".step1").attr('data-lat',Lat);
								$(".select_optionsTo").addClass("hidden");
								var LatLng = new L.LatLng(Lat,Lng);
								var marker = L.marker(LatLng).addTo(map);
								Route($("#TID option:selected").attr('data-lon'),$("#TID option:selected").attr('data-lat'),Lng,Lat);
							});						
						}						
					}
				})	
			}
		})			
		
		function onMapClick(e) {
			$(".step2").removeClass("hidden");	
			$(".vehicles").not(":first").remove();			
			var marker = L.marker(e.latlng).addTo(map);
			var Lat=e.latlng.lat;
			var Lng=e.latlng.lng;	
			var url = "plugins/SBuilder/Router/getLocation.php";
			var param = "lng="+Lng+"&lat="+Lat;
			console.log(url+'?'+param);
			$.ajax({
				url: url,
				type: "POST",
				data: param,
				success: function (data) {
					$(".step1").val(data);
					$(".step1").attr("data-lng",Lng);
					$(".step1").attr("data-lat",Lat);
					Route($("#TID option:selected").attr("data-lon"),$("#TID option:selected").attr("data-lat"),Lng,Lat);
				}
			})
		}			

		function Route(lng1,lat1,lng2,lat2) {
			clearMap();
			var LatLng = new L.LatLng(lat1, lng1);
			var marker = L.marker(LatLng).addTo(map);
			var LatLng = new L.LatLng(lat2, lng2);
			var marker = L.marker(LatLng).addTo(map);
			var url='plugins/SBuilder/Router/getRoute.php'
			console.log(url+"?lng1="+lng1+"&lat1="+lat1+"&lng2="+lng2+"&lat2="+lat2);
			$.ajax({
				url:  './plugins/SBuilder/Router/getRoute.php',
				type: 'GET',
				dataType: 'jsonp',
				data: {
					lng1 : lng1,
					lat1 : lat1,
					lng2 : lng2,
					lat2 : lat2
				},
				error: function() {
					alert ("Problem with route");
				},
				success: function(data) {
					var distance=data['distance'];
					$("#Distance").val(distance);
					var duration=data['duration'];
					$("#Duration").val(duration);
					var dd = distance+"km /"+duration+"min";
					var mll=data['mll'];
					var line=data['line'];
					$("#Line").val(line);
					var Pline=JSON.parse(line);
					var polyline = L.polyline(Pline).addTo(map);
					var LL=JSON.parse(mll);
					var popup = L.popup()
						.setLatLng(LL)
						.setContent(dd)
						.openOn(map);					
					
				}
			})
		}	
		
		function clearMap() {
			$(".leaflet-marker-icon").remove();
			$(".leaflet-popup").remove();
			$("path").remove();
		}		
	})
	$(".step2").change(function(){
		$(".step3").removeClass("hidden");
	})	
	$(".step3").change(function(){
		$(".step4").removeClass("hidden");
	})	
	$(".step4").change(function(){
		$(".step5").removeClass("hidden");
		$(".step7").removeClass("hidden");		
	})		
	$(".step5").change(function(){
		$(".step6").removeClass("hidden");
	})		
	$(".step6").change(function(){
		$(".step7").removeClass("hidden");
	})	
	$("#PaxNo,#Children,#Infants,#Date,#Time,#DateR,#TimeR").change(function(){
		$(".vehicles").not(":first").remove();	
		$(".step7").removeClass("hidden");
	})	
	$(".step7").click(function(){
		$(".step7").addClass("hidden");
		var terminalid=$("#TID option:selected").val();
		var distance=$("#Distance").val();
		var duration=$("#Duration").val();
		var line=$("#Line").val();
		var date=$("#Date").val();
		var time=$("#Time").val();
		var dateR=$("#DateR").val();
		var timeR=$("#TimeR").val();
		var paxNo=$("#PaxNo").val();
		var children=$("#Children").val();
		var infants=$("#Infants").val();
		
		var url='./plugins/SBuilder/Booking/getPrice.php';
		console.log(url+"?terminalid="+terminalid+"&distance="+distance+"&duration="+duration+"&date="+date+"&time="+time+"&dateR="+dateR+"&timeR="+timeR+"&paxNo="+paxNo+"&line="+line);
		$.ajax({
			url:  './plugins/SBuilder/Booking/getPrice.php',
			type: 'POST',
			dataType: 'jsonp',
			data: {
				terminalid : terminalid,
				distance : distance,
				duration: duration,
				line : line,
				date : date,
				time : time,
				dateR : dateR,
				timeR : timeR,
				paxNo : paxNo,
				children : children,
				infants : infants
			},
			error: function() {
				//callback();
			},
			success: function(data) {
				$("#Price").val(data['price']);

				$.each(data, function(i, item) {
					$(".pattern").clone().insertAfter(".vehicles");
					$(".vehicles:last").removeClass("hidden");
					$(".vehicles:last").removeClass("pattern");
					//$(".vehicles:last").find(".picture").text(item.Picture);
					$(".vehicles:last").find(".vehiclename").text(item.VehicleName);
					$(".vehicles:last").find(".price").text(item.Price.toFixed(2));
				});
			}
		})	
	})
	

	
	


{/literal}	
</script>