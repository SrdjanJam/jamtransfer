<style>
	.leaflet-popup-content-wrapper .leaflet-popup-content {
		color:blue;
		font-size: 70%;
		width: 70%;
	}
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>	 

{*<input type="text" id="PickupDate" name="PickupDate" class="w75 datepicker" value="{$smarty.request.Date}">*}
<div class="row">
	<div class="col-lg-9 col-md-9" id="map"></div>
	<div class="col-lg-3 col-md-3">
		<h3>{$TRANSFERS}:</h3>
		{section name=pom1 loop=$transfers}
			<div style="color:{$transfers[pom1].Color}" class="h6 element {$transfers[pom1].wrongll}" 
				data-line="{$transfers[pom1].line}"
				data-ll="{$transfers[pom1].mll}"
				data-dd="{$transfers[pom1].dd}"
				data-pll="{$transfers[pom1].pll}"
				data-dll="{$transfers[pom1].dll}"
				data-pickup="{$transfers[pom1].Pickup}"
				data-drop="{$transfers[pom1].Drop}"
				data-driverid="{$transfers[pom1].SubDriver}"
				data-color="{$transfers[pom1].Color}"
			>
				<span
					title="<b>{$transfers[pom1].OrderID}-{$transfers[pom1].TNo} - {$transfers[pom1].PaxName} </b>" 
					data-content="
						<br/>{$FLIGHT_NO}: {$transfers[pom1].FlightNo}
						<br>{$FLIGHT_TIME}: {$transfers[pom1].FlightTime}
					" 
					class="mytooltip">						
					<div>
						<strong>{$transfers[pom1].PickupTime}</strong>
						<i class="fa fa-car"></i><span>{$transfers[pom1].VehicleType}</span>							
						<strong>{$transfers[pom1].OrderID}-{$transfers[pom1].TNo}</strong> 
						<i class="fa fa-user"></i><span>{$transfers[pom1].PaxNo}</span>
					</div>
					<div>{$transfers[pom1].PickupName}-{$transfers[pom1].DropName}</div>
					<div>{$transfers[pom1].subDriver} <span class="red">{$transfers[pom1].json}</span></div>
				</span>
			</div>
		{/section}
		<i style="color:blue" class="fa-solid fa-arrow-circle-up fa-xl"></i> Move - no transfer<br>
		<i style="color:green" class="fa-solid fa-arrow-circle-up fa-xl"></i> Move - on transfer<br> 
		<i style="color:#FFAC1C" class="fa-solid fa-arrow-circle-up fa-xl"></i> Move - to Pickup location<br>
		<i style="color:red" class="fa-solid fa-stop fa-xl"></i> Stop 
	</div>
</div>
<script>
{literal}	

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

function onMapClick(e) {
    alert("You clicked the map at " + e.latlng);
	var marker = L.marker(e.latlng).addTo(map);
}
//map.on('click', onMapClick);

function showRoute(e) {
	var driverid=e.target.options.id;
	$(".element").each(function(){
		did=$(this).attr('data-driverid');
		if (driverid==did) $(this).trigger('click');
	})
}

$(".element").click(function(){
	$(".element").css("background-color", "");
	$(this).css("background-color", "#ADD8E6");
	var color=$(this).attr('data-color');
	$("path").remove();
	var Pline=JSON.parse($(this).attr("data-line"));
	var polyline = L.polyline(Pline, {color:color}).addTo(map);
	var LL=JSON.parse($(this).attr("data-ll"));
	var PLL=JSON.parse($(this).attr("data-pll"));
	var DLL=JSON.parse($(this).attr("data-dll"));
	var dd=$(this).attr("data-dd");
	var Pickup=$(this).attr("data-pickup");
	var Drop=$(this).attr("data-drop");
	var popup = L.popup()
		.setLatLng(LL)
		.setContent(dd)
		.openOn(map);	
	var circle = L.circle(PLL, {
		color: 'red',
		fillColor: '#f03',
		fillOpacity: 0.5,
		radius: 500
	}).addTo(map).bindPopup(Pickup);
	var circle = L.circle(DLL, {
		color: 'red',
		fillColor: '#f03',
		fillOpacity: 0.5,
		radius: 500
	}).addTo(map).bindPopup(Drop);		
})
	{/literal}	
</script>
{if isset($sdArray)}
{section name=pom loop=$sdArray}
	{if $sdArray[pom].foundlocation}
		<script>
		{literal}
			carIcon = L.divIcon({
				html: '{/literal}{$sdArray[pom].Icon}{literal}<span style="font-size:80%; text-shadow: 2px 0 0 #000, 0 -1px 0 #000, 0 1px 0 #000, -1px 0 0 #000; color:yellow">'+
					'{/literal}{$sdArray[pom].DriverName}{literal}'+
				'</span>',
				iconSize: [20, 20],
				className: 'myDivIcon'
			});		
			var marker = L.marker({/literal}{$sdArray[pom].LL}{literal},{ icon:  carIcon, id: '{/literal}{$sdArray[pom].DriverID}{literal}'}).on('click',showRoute).addTo(map).bindPopup('{/literal}{$sdArray[pom].DriverName}, {$sdArray[pom].Vehicle}<br>{$sdArray[pom].Device}<br>{$sdArray[pom].Location}{literal}');
		{/literal}	
		</script>
		{*<iframe src="https://maps.google.com/maps?q={$sdArray[pom].Lat},{$sdArray[pom].Lng} &z=12&output=embed"  frameborder="0" style="border:0"></iframe>*}
	{/if}
{/section}
{/if}
	

