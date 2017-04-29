var map = L.map('map').setView([42.845427, -8.080477], 1);
var geojsonLayer = undefined;

var myStyle = {
    "color": "#ff7800",
    "weight": 5,
    "opacity": 0.65
};

L.TileLayer.Common = L.TileLayer.extend({
	initialize(options) {
		L.TileLayer.prototype.initialize.call(this, this.url, options);
	}
});

((() => {
	
	var osmAttr = '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>';

	L.TileLayer.OpenStreetMap = L.TileLayer.Common.extend({
		url: 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
		options: {attribution: osmAttr}
	});
})());

var openStreetMap = new L.TileLayer.OpenStreetMap();
openStreetMap.addTo(map);

function popup(feature, layer) {
     if (feature.properties) {
         var content = '';
         for (var colName in feature.properties){
             content += '<b>'+colName+":</b> "+feature.properties[colName]+"<br>";
         }
         layer.bindPopup(content);
     }
}

//TODO Popup when click on a point
function loadMap(url){
$.ajax({
    type: "GET",
    url,//"features",
    dataType: 'json',
    success(response) {
	if (geojsonLayer){
		map.removeLayer(geojsonLayer);
	}
        if (response.features.length == 0){
            $().toastmessage('showWarningToast', 'No features found.');
            return;
        } else {
            $().toastmessage('showSuccessToast', "Success");
        }
	geojsonLayer = L.geoJson(response, {
	    style: myStyle, 
        onEachFeature: popup
	}).addTo(map);
	map.fitBounds(geojsonLayer.getBounds());
    }
});
}
