function loadMap(url){
var map = L.map('map').setView([42.845427, -8.080477], 1);
var geojsonLayer = undefined;

//L.tileLayer('http://{s}.tile.cloudmade.com/{key}/22677/256/{z}/{x}/{y}.png', {
//              attribution: 'Map data &copy; 2011 OpenStreetMap contributors, Imagery &copy; 2012 CloudMade',
//              key: 'BC9A493B41014CAABB98F0471D759707'
//      }).addTo(map);
var myStyle = {
    "color": "#ff7800",
    "weight": 5,
    "opacity": 0.65
};
var cmAttr = 'Map data &copy; 2011 OpenStreetMap contributors, Imagery &copy; 2011 CloudMade',
    cmUrl = 'http://{s}.tile.cloudmade.com/BC9A493B41014CAABB98F0471D759707/{styleId}/256/{z}/{x}/{y}.png';

var minimal   = L.tileLayer(cmUrl, {styleId: 22677, attribution: cmAttr}),
    midnight  = L.tileLayer(cmUrl, {styleId: 999,   attribution: cmAttr}),
    motorways = L.tileLayer(cmUrl, {styleId: 46561, attribution: cmAttr});

minimal.addTo(map);
//midnight.addTo(map);

$.ajax({
    type: "GET",
    url: url,//"features",
    dataType: 'json',
    success: function (response) {
	geojsonLayer = L.geoJson(response, {
	    style: myStyle
	}).addTo(map);
	var baseLayers = {
		"Minimal": minimal,
		"Night View": midnight
	};
	var overlays = {
		"Geofier": geojsonLayer
	};
	L.control.layers(baseLayers, overlays).addTo(map);
    }
});
}
