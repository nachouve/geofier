<html>
<head>
<style>
.api_wp:hover {
    font-weight: bold;
    color: blue;
}
</style>
<script src="js/jquery-1.10.1.min.js"></script> 
<script src="js/prettyprint.js"></script> 
<script>
$(document).ready(function(){

function getGeofierBaseURI(evt){
    return evt.currentTarget.baseURI.replace('/rest.php','');
}

$(".api_wp").click(function(a){
    var uri = getGeofierBaseURI(a);
	var obj = a.currentTarget;
    var query_uri = uri+"/"+$(obj).attr("href");
	$.get(query_uri,
	    null,
 	    function(response){
        $("#query").html('<a href="'+query_uri+'">'+query_uri+'</a>');
        var tbl = prettyPrint(JSON.parse(response), {maxDepth: 5});
		$("#result").html(tbl);
	    }
	);
});

$(":submit").click(function(a){
    var uri = getGeofierBaseURI(a);
	var func = "index.php/feature";
	var num_id = $("#id_num").val();
    var query_uri = uri+"/"+func+"/"+num_id;
	$.get(query_uri,
	    null,
 	    function(response){
        $("#query").html('<a href="'+query_uri+'">'+query_uri+'</a>');
        var tbl = prettyPrint(JSON.parse(response),{maxDepth: 5});
		$("#result").html(tbl);
	    }
	);
});

});

</script>
</head>
<body>
<h1>Geofier</h1>

<h2>API</h2>
<li><div class="api_wp" href="index.php/testdb">TestDB connection</div></li>
<li><div class="api_wp" href="index.php/features">All features</div></li>
<li><div> FeatureID: <input id="id_num"/><input type="submit" value="Submit"></div> </li>

<h1>Query</h1>
<div id="query"></div>

<h1>Result</h1>
<div id="result" style="border: 1px gray solid;">

</div>

</body>
</html>

