<html>
<head>

<script src="js/jquery-1.10.1.min.js"></script> 
<script>
$(document).ready(function(){

$(".api_wp").click(function(a){
	console.log(a);
	var uri = a.currentTarget.baseURI;
	var obj = a.currentTarget;
	$.get(uri+"/"+$(obj).attr("href"),
	    null,
 	    function(response){
		$("#result").text(response);
	    }
	);
});

$(":submit").click(function(a){
	console.log(a);
	var uri = a.currentTarget.baseURI;
	var func = "index.php/feature";
	var num_id = $("#id_num").val();
	$.get(uri+"/"+func+"/"+num_id,
	    null,
 	    function(response){
		$("#result").text(response);
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
<li><a href="index.php/testdb">TestDB connection</a></li>
<li><a href="index.php/testdb">TestDB connection</a></li>

<h1>Result</h1>
<div id="result" style="border: 1px gray solid;">

</div>

</body>
</html>

