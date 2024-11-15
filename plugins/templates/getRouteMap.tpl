<style>
	.leaflet-popup-content-wrapper .leaflet-popup-content {
		color:blue;
		font-size: 150%;
	}
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>	 

	<div id="map"></div>


<script>
{literal}	

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

var Pline={/literal}{$transfer.line}{literal};
var polyline = L.polyline(Pline).addTo(map);
var LL={/literal}{$transfer.mll}{literal};
var dd='{/literal}{$transfer.dd}{literal}';
var popup = L.popup()
	.setLatLng(LL)
	.setContent(dd)
	.openOn(map);	
var PLL={/literal}{$transfer.pll}{literal};
var Pickup='{/literal}{$transfer.PickupName}{literal}';
var circle = L.circle(PLL, {
	color: 'red',
	fillColor: '#f03',
	fillOpacity: 0.5,
	radius: 500
}).addTo(map).bindPopup(Pickup);
var DLL={/literal}{$transfer.dll}{literal};
var Drop='{/literal}{$transfer.DropName}{literal}';
var circle = L.circle(DLL, {
	color: 'red',
	fillColor: '#f03',
	fillOpacity: 0.5,
	radius: 500
}).addTo(map).bindPopup(Drop);	
{/literal}	
</script>

	
