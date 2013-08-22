<html>
<head>
<style>
.api_wp:hover {
    font-weight: bold; 
    color: blue;
}
body { 
    font-family: "Arial", "Garuda","Lucida Sans Unicode"; 
    font-size: 0.8em; 
    margin: 0 15%;
}

</style>
<script src="js/jquery-1.10.1.min.js"></script> 
<script src="js/prettyprint.js"></script>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 
<script>
$(document).ready(function(){
$("#tabs").tabs();
function getGeofierBaseURI(evt){
    return evt.currentTarget.baseURI.replace('/api','');
}

function processResponse(response, query_uri){
    $("#query").html('<a href="'+query_uri+'">'+query_uri+'</a>');
    var parsed_resp = JSON.parse(response);
    var tbl = prettyPrint(parsed_resp, {maxDepth: 5});
    if (parsed_resp["status"]){
	    $("#result #tabs-1").html(tbl);
	    $("#result #tabs-2").html(response);
    } else {
	    $("#result #tabs-1").html(tbl);
	    $("#result #tabs-2").html(response);
	    $("#result #tabs-3").html("********** MAP HERE *************");
    }
}

$(".api_wp").click(function(a){
    var uri = getGeofierBaseURI(a);
	var obj = a.currentTarget;
    var query_uri = uri+"/"+$(obj).attr("href");
	$.get(query_uri,
	    null,
        function(response){
            processResponse(response, query_uri)
        }
	);
});

$(":submit").click(function(a){
    var uri = getGeofierBaseURI(a);
	var func = "feature";
	var num_id = $("#id_num").val();
    var query_uri = uri+"/"+func+"/"+num_id;
	$.get(query_uri,
	    null,
        function(response){
	        processResponse(response, query_uri);
        }
	);
});

});

</script>
</head>
<body>
<h1><a href="/geofier"> <img src="images/geofier-logo.png" height="100px"/></a>Geofier API</h1>

<h2>API</h2>
<li><div class="api_wp" href="testdb">TestDB connection</div></li>
<li><div class="api_wp" href="features">All features</div></li>
<li><div class="api_wp" href="columns">Columns</div></li>
<li><div> FeatureID: <input id="id_num"/><input type="submit" value="Submit"></div> </li>

<h2>Query</h2>
<div id="query"></div>

<h2>Result</h2>
<div id="result" style="border: 1px gray solid;">
  <div id="tabs">
  <ul>
    <li><a href="#tabs-1">Table</a></li>
    <li><a href="#tabs-2">Raw</a></li>
    <li><a href="#tabs-3">Map</a></li>
  </ul>
  <div id="tabs-1">
  </div>
  <div id="tabs-2">
  </div>
  <div id="tabs-3">
  </div>
  </div> <!-- tabs -->
</div>

</body>
</html>

