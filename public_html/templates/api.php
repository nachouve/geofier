{% extends "base.twig.html" %}

{% block html_head %}
<style>
.api_wp:hover {
    font-weight: bold; 
    color: blue;
}

body { 
    font-family: "Arial", "Garuda","Lucida Sans Unicode"; 
    font-size: 0.8em; 
}

#functionsbox {
    margin: 0 15%;
}
</style>

<script src="js/jquery-1.10.2.js"></script> 
<script src="js/prettyprint.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script src="http://leafletjs.com/dist/leaflet.js"></script>
<link rel="stylesheet" href="http://leafletjs.com/dist/leaflet.css" />

<script>
$(document).ready(function(){

    $("#tabs").tabs();
    $("#tabs").css('word-wrap', 'break-word');
    function getGeofierBaseURI(evt){
        return window.location.href.replace('/api','');
//        return evt.currentTarget.baseURI.replace('/api','');
    }

    function processResponse(response, query_uri){
        $("#query").html('<a href="'+query_uri+'">'+query_uri+'</a>');
        var parsed_resp = $.parseJSON(response);
        var tbl = prettyPrint(parsed_resp, {maxDepth: 5});
        if (parsed_resp["status"]){
            $("#tabs").tabs('option','active',0);
            $("#tabs").tabs({'disabled': [2]});

            $("#result #tabs-1").html(tbl);
            $("#result #tabs-2").html(response);
        } else {	    
            $("#tabs").tabs('enable');
            $("#tabs").tabs('option','active',2);

            $("#result #tabs-1").html(tbl);
            $("#result #tabs-2").html(response);
            loadMap(query_uri);
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

    $("#id_filter").click(function(a){
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

    $("#col_filter").click(function(a){
        var uri = getGeofierBaseURI(a);
        var func = "feature";
        var col_name = $("#col_name").val();
        var col_value = $("#col_equals").val();
        var query_uri = uri+"/"+func+"/"+col_name+"/"+col_value;
        $.get(query_uri,
            null,
            function(response){
                processResponse(response, query_uri);
            }
        );
    });

});

</script>
{% endblock html_head %}

{% block content %}
<div id="functionsbox">

<h2>API Resources</h2>
<li><div class="api_wp" href="testdb">TestDB connection</div></li>
<li><div class="api_wp" href="features">All features</div></li>
<li><div class="api_wp" href="columns">Columns</div></li>
<li>
    <div> 
	FeatureID: <input id="id_num"/>
	<input id="id_filter" type="submit" value="Request">
    </div> 
</li>

<li>
    <div> 
	ColumnName: <input id="col_name"/> 
	equalsto: <input id="col_equals"/> 
        <input id="col_filter" type="submit" value="Request">
    </div> 
</li>

<h2>Description</h2>
<h2>Service URL</h2>
<div id="query"></div>

<h2>Service Output</h2>
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
	   <div id="map" style="width: 700px; height: 500px"> </div>
  </div>
  </div> <!-- tabs -->
</div>

</div> <!-- funtions-box -->
<script src="js/map.js"></script>
{% endblock content %}
