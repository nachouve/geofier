{% extends "base.twig.html" %}

{% block html_head %}
<style>
	.api_wp:hover {
		font-weight: bold;
		color: blue;
	}

</style>

<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery.toastmessage.js"></script>
<script src="js/prettyprint.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script src="http://leafletjs.com/dist/leaflet.js"></script>
<link rel="stylesheet" href="http://leafletjs.com/dist/leaflet.css" />

<script>
	$(document).ready(function() {

		$("#tabs").tabs();
		$("#tabs").css('word-wrap', 'break-word');
		function getGeofierBaseURI(evt) {
			return window.location.href.replace('/api', '');
			//        return evt.currentTarget.baseURI.replace('/api','');
		}

		function processResponse(response, query_uri) {
			$("#query").html('<a href="' + query_uri + '">' + query_uri + '</a>');
			var parsed_resp = $.parseJSON(response);
			var tbl = prettyPrint(parsed_resp, {
				maxDepth : 5
			});
                        if (parsed_resp["status"]) {
                                if (parsed_resp["status"]=="success"){
                                    $().toastmessage('showSuccessToast', "Success");
                                } else {
                                    $().toastmessage('showErrorToast', "Error");
                                }
				$("#tabs").tabs('option', 'active', 0);
				$("#tabs").tabs({
					'disabled' : [2]
				});

				$("#result #tabs-1").html(tbl);
				$("#result #tabs-2").html(response);
			} else {
				$("#tabs").tabs('enable');
				$("#tabs").tabs('option', 'active', 2);

				loadMap(query_uri);
				$("#result #tabs-1").html(tbl);
				$("#result #tabs-2").html(response);
			}
		}


		$(".api_wp").click(function(a) {
			a.preventDefault();
			var uri = getGeofierBaseURI(a);
			var obj = a.currentTarget;
			var query_uri = uri + "/" + $(obj).attr("href");
			$.get(query_uri, null, function(response) {
				processResponse(response, query_uri)
			});
		});

		$("#id_filter").click(function(a) {
			a.preventDefault();
			var uri = getGeofierBaseURI(a);
			uri = uri.replace('?', '');
			var func = "feature";
			var num_id = $("#id_num").val();
			var query_uri = uri + "/" + func + "/" + num_id;
			$.get(query_uri, null, function(response) {
				processResponse(response, query_uri);
			});
		});

		$("#col_filter").click(function(a) {
			a.preventDefault();
			var uri = getGeofierBaseURI(a);
			uri = uri.replace('?', '');
			var func = "feature";
			var col_name = $("#col_name").val();
			var col_value = $("#col_equals").val();
			var query_uri = uri + "/" + func + "/" + col_name + "/" + col_value;
			$.get(query_uri, null, function(response) {
        		    processResponse(response, query_uri);
                        }).fail(function(response){
                            processResponse(response.responseText, query_uri);
                        });
		});

	});

</script>
{% endblock html_head %}

{% block content %}
<div class="jumbotran jumbo_welcome" style="font-family:'Arapey'; color:rgb(100,100,100); font-size:1.1em;">
	<div class="container">

		<div class="row">
			<div class="col-lg-12">
				<h4 class="title">API Resources:</h4>
				<p>
					Try one of this options to see the demo file/configuration characteristics:
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-1"></div>
			<div class="col-lg-3">
<ul>
			<li>	<a class="btn btn-default api_wp" href="configuration" role="button">Configuration test characteritics</a></li>
			<li>	<a class="btn btn-default api_wp" href="features" role="button">See all features</a></li>
			<li>	<a class="btn btn-default api_wp" href="columns" role="button">See all columns</a></li>
</ul>
</div>
			<div class="col-lg-3"><ul>
				<li><form class="form-inline" role="form">
					<div class="form-group">
						<input type="text" class="form-control" id="id_num" placeholder="Feature ID">
					</div>
					<button type="submit" class="btn btn-default" id="id_filter">
						See FILTER results BY feature ID
					</button>
				</form></li></ul>
</div>
			<div class="col-lg-3"><ul>
				<li><form class="form-inline" role="form">
					<div class="form-group">
						<input type="text" class="form-control form-inline" id="col_name" placeholder="Column Name">
						<input type="text" class="form-control" id="col_equals" placeholder="Value">
					</div>
					<button type="submit" class="btn btn-default" id="col_filter">
						See FILTER results BY VALUE in column selected
					</button>
				</form></li></ul>
							</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<h4 class="title">Description:</h4>
			</div>
			<div class="col-lg-6">
				<h4 class="title">Service URL: <span id="query"></span></h4>

			</div>
		</div>

		</br>
		<!--		<li>
		<div class="api_wp" href="configuration">
		Configuration Test
		</div>
		</li>
		<li>
		<div class="api_wp" href="features">
		All features
		</div>
		</li>
		<li>
		<div class="api_wp" href="columns">
		Columns
		</div>
		</li>
		<li>
		<!--			<div>
		FeatureID:
		<input id="id_num"/>
		<input id="id_filter" type="submit" value="Request">
		</div>
		</li>

		<li>
		<div>
		ColumnName:
		<input id="col_name"/>
		equalsto:
		<input id="col_equals"/>
		<input id="col_filter" type="submit" value="Request">
		</div>
		</li>
		-->

		<h4 class="title">Service Output</h4>
		<div id="result" style="border: 1px gray solid;">
			<div id="tabs">
				<ul>
					<li>
						<a href="#tabs-1">Table</a>
					</li>
					<li>
						<a href="#tabs-2">Raw</a>
					</li>
					<li>
						<a href="#tabs-3">Map</a>
					</li>
				</ul>
				<div id="tabs-1"></div>
				<div id="tabs-2"></div>
				<div id="tabs-3">
					<div id="map" style="width: 700px; height: 500px"></div>
				</div>
			</div>
			<!-- tabs -->
		</div>

	</div>
</div>

<script src="js/map.js"></script>
{% endblock content %}
