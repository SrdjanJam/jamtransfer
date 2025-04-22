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
     crossorigin=""></script>	 
<div class="row">
	<div class="col-lg-9 col-md-9" id="map"></div>
	<div class="col-lg-3 col-md-3 form">
	
		{section name=pom1 loop=$routes}
			<div class="row">
				<div class='col-lg-7 col-md-7'>
					<a class='route'
						data-id='{$routes[pom1].RouteID}'
						data-fromtoll='{$routes[pom1].FromToLL}'
						data-line='{$routes[pom1].Line}'
						data-midll='{$routes[pom1].midll}'
						data-distance='{$routes[pom1].Distance}'
						data-duration='{$routes[pom1].Duration}'
					>
						{$routes[pom1].RouteName}
					</a>
				</div>				
				<div class="col-lg-3 col-md-3">
					<button class="btn btn-primary rv-modal" data-toggle="modal" data-target="#rvModal{$routes[pom1].RouteID}">
						{$routes[pom1].Price} €
					</button>
					<div class="modal fade"  id="rvModal{$routes[pom1].RouteID}">	
						<div class="modal-dialog" style="width: fit-content;">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title">{$routes[pom1].RouteName} - Vehicle Prices</h4>		
								</div>	
								<div class="modal-body row" style="padding:10px">
									<div class="col-md-8">
										<label>Name</label>
									</div>										
									<div class="col-md-4">
										<label>Price</label>
									</div>	
								</div>		
								{section name=pom2 loop=$routes[pom1].vprices}
								<div class="modal-body row" style="padding:10px">
									<div class="col-md-8">
										{$routes[pom1].vprices[pom2]['name']}
									</div>										
									<div class="col-md-4">
										{$routes[pom1].vprices[pom2]['price']}
									</div>	
								</div>									
								{/section}
							</div>
						</div>	
					</div>
				</div>	
				
				<div class="col-lg-2 col-md-2">
					<button data-id="{$routes[pom1].RouteID}" type="button" class="btn btn-warning delete">{$DELETE}</button>
				</div>
			</div>
		{/section}
		<div class="row">
			<div class='col-lg-12 col-md-12'>
				<a class='route' id="newr">
					{$NNEW} {$ROUTE}
				</a>
			</div>				
		</div>		
		<div class="row nr">
			<div class="col-lg-6 col-md-6">
				<label>{$TERMINAL } {$FROM}:</label>
			</div>			
			<div class="col-lg-6 col-md-6">
				<select id="TID" name="TerminalID" class="form-control">
					{section name=pom2 loop=$terminals}
						<option data-lng="{$terminals[pom2].lng}" data-lat="{$terminals[pom2].lat}" value="{$terminals[pom2].id}">{$terminals[pom2].name}</option>
					{/section}
				</select>
			</div>
		</div><br>
		<div class="row nr">
			<div class="col-lg-6 col-md-6">
				<label>{$TO}:</label>
			</div>			
			<div class="col-lg-6 col-md-6">
				<input id="To" type="text" name="From" value="" placeholder="pick on map or type"/>
				<div id="select_optionsTo"  style="max-height:15em;overflow:auto"></div>
			</div>
		</div><br>
		<div class="row nr">
			<div class="col-lg-6 col-md-6">
				<label>{$DISTANCE} / km:</label>
			</div>			
			<div class="col-lg-6 col-md-6">
				<input id="Distance" type="text" name="Distance" value=""/>
			</div>
		</div><br>
		<div class="row nr">
			<div class="col-lg-6 col-md-6">
				<label>{$DURATION} / min:</label>
			</div>			
			<div class="col-lg-6 col-md-6">
				<input id="Duration" type="text" name="Duration" value=""/>
			</div>
		</div><br>		
		<div class="row nr" id="Price_row">
			<div class="col-lg-6 col-md-6">
				<label>{$PRICE} / €:</label>
			</div>			
			<div class="col-lg-6 col-md-6">
				<input id="Price" type="text" name="Price" value=""/>
			</div>
		</div>
		{section name=pom2 loop=$vehicles}		
		<div class="row nr" id="Price_row">
			<div class="col-lg-6 col-md-6">
				<label>{$vehicles[pom2].VehicleName} / {$vehicles[pom2].MaxPax}</label>
			</div>			
			<div class="col-lg-6 col-md-6">
				<input class="vPrices" data-id="{$vehicles[pom2].VehicleID}" id="Price{$vehicles[pom2].VehicleID}" type="text" name="Price{$vehicles[pom2].VehicleID}" value="" placeholder="{$vehicles[pom2].PriceCoeff}"/>
			</div>
		</div>			
		{/section}
		
		<br>
		<input id="Line" type="hidden" name="Line" value=""/><br>
		<div class="row nr">
			<div class="col-lg-6 col-md-6">
				<button type="button" class="btn btn-secondary" id="Reset">{$RESET}</button>
			</div>			
			<div class="col-lg-6 col-md-6">
				<button type="button" class="btn btn-success" id="Save">{$SAVE}</button>
			</div>
		</div>
	</div>
</div>

<script>
{literal}	
$('#Reset, #Save, #Price_row').hide();
$(".nr").hide();
$(".mytooltip").popover({trigger:'hover', html:true, placement:'bottom'});
var w=$("#map").width();
if (w>1000) w=1000;
else if(w>800) w=800;
h=w*0.7;
$("#map").width(w);
$("#map").height(h);
var map = L.map('map').setView([{/literal}{$lat}{literal}, {/literal}{$long}{literal}], {/literal}{$scale}{literal});
	L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
	maxZoom: 19,
	attribution: ''
}).addTo(map);
$(".leaflet-attribution-flag").remove();
$(".leaflet-control").remove();

const carIcon = L.divIcon({
    html: '<i class="fa fa-car fa-sm"></i>',
    iconSize: [20, 20],
    className: 'myDivIcon'
});

function onMapClick(e) {
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
			$("#To").val(data);
			$("#To").attr("data-lng",Lng);
			$("#To").attr("data-lat",Lat);
			Route($("#TID option:selected").attr("data-lng"),$("#TID option:selected").attr("data-lat"),Lng,Lat);
		}
	})
}
map.on('click', onMapClick);

function Route(lng1,lat1,lng2,lat2) {
	clearMap();
	var LatLng = new L.LatLng(lat1, lng1);
	var marker = L.marker(LatLng).addTo(map);
	var LatLng = new L.LatLng(lat2, lng2);
	var marker = L.marker(LatLng).addTo(map);
	
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
			//callback();
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
			$('#Price_row').show();
		}
	})
}	
function clearMap() {
	$(".leaflet-marker-icon").remove();
	$(".leaflet-popup").remove();
	$("path").remove();
}
$("#Price").change(function(){
	if ($(this).val()!="") $('#Reset, #Save').show();
	$(".vPrices").each(function(){
		$(this).val(Number($(this).attr('placeholder')*$("#Price").val()).toFixed(2));
	})
})
$("#Reset").click(function(){
	$('input').val("");
	clearMap();
	$('#Reset, #Save').hide();
})
$("#Save").click(function(){
	var vp='[';
	var i=0;
	$(".vPrices").each(function(){
		if (i>0) vp=vp+',';
		i=1;
		vp=vp+'['+$(this).attr("data-id")+','+$(this).val()+']';
	})
	vp=vp+']';
	var parameters = {
		from : $("#TID option:selected").text(),
		fromLat : $("#TID option:selected").attr("data-lat"),
		fromLng : $("#TID option:selected").attr("data-lng"),
		to : $("#To").val(),
		toLat : $("#To").attr("data-lat"),
		toLng : $("#To").attr("data-lng"),
		distance : $("#Distance").val(),
		duration : $("#Duration").val(),
		line : $("#Line").val(),
		price : $("#Price").val(),
		vPrices : vp
	}
	var url='./plugins/SBuilder/Router/saveRouteParam.php';
	console.log(parameters);
	$.ajax({
		url:  url,
		type: 'POST',
		//dataType: 'jsonp',
		data: parameters,
		error: function() {
			//callback();
		},
		success: function(res) {
			toastr['success'](window.success);
			location.reload();	
		}
	})

	console.log(parameters);
})

$(".delete").click(function(){
	$.ajax({
		url:  './plugins/SBuilder/Router/deleteRoute.php?id='+$(this).attr("data-id"),
		type: 'GET',
		success: function(data) {
			toastr['success'](window.success);
			location.reload();	
		}	
	})
})

$(".route").click(function(){
	$(".route").removeClass('greenroute');
	$(this).addClass('greenroute');
	clearMap();	
	if ($(this).attr("id")=="newr") {
		$(".nr").show();
	} else {
		$(".nr").hide();
		var line=$(this).attr("data-line");
		var Pline=JSON.parse(line);
		var polyline = L.polyline(Pline).addTo(map);
		var fromtoll= JSON.parse($(this).attr("data-fromtoll"));
		var LatLng = new L.LatLng(fromtoll[0], fromtoll[1]);
		var marker = L.marker(LatLng).addTo(map);
		var LatLng = new L.LatLng(fromtoll[2], fromtoll[3]);
		var marker = L.marker(LatLng).addTo(map);
		var distance=$(this).attr("data-distance");
		var duration=$(this).attr("data-duration");
		var dd = distance+"km /"+duration+"min";
		var mll=$(this).attr("data-midll");
		var LL=JSON.parse(mll);
		var popup = L.popup()
			.setLatLng(LL)
			.setContent(dd)
			.openOn(map);	
	}	
})


	$('#To').on('click keyup', function(event) {
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
								'<button class="'+className+'" id="'+ item.ID +
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
						$(select_options).show("slow");
						$(select_options).html(html);

						// option selected
						$(".ToName").click(function(){
							var Lng = $(this).attr('data-long');
							var Lat = $(this).attr('data-latt');
							var Name = $(this).attr('data-name');
							id="#"+ft;
							$(id).val(Name);
							$(id).attr('data-lng',Lng);
							$(id).attr('data-lat',Lat);
							$(select_options).hide("slow");
							var LatLng = new L.LatLng(Lat, Lng);
							var marker = L.marker(LatLng).addTo(map);
							Route($("#TID option:selected").attr('data-lng'),$("#TID option:selected").attr('data-lat'),Lng,Lat);
						});						
					}						
				}
			})	
		}
	})
$("#TID").change(function(){
	var attr = $(this).attr('data-lng');
	if(typeof attr !=='undefined') {
		Route($("#TID option:selected").attr("data-lng"),$("#TID option:selected").attr("data-lat"),$("#To").attr("data-lng"),$("#To").attr("data-lat"));
	}	
})
$(".mytooltip").popover({trigger:'hover', html:true, placement:'bottom'});
{/literal}	
</script>

	
