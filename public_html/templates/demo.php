{% extends "base.twig.html" %}

{% block html_head %}

<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery.toastmessage.js"></script>
<script src="js/prettyprint.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script src="http://leafletjs.com/dist/leaflet.js"></script>
<link rel="stylesheet" href="http://leafletjs.com/dist/leaflet.css" />

{% endblock html_head %}

{% block content %}
<div class="jumbotran jumbo_welcome" style="font-family:'Arapey'; color:rgb(100,100,100); font-size:1.1em;">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 column_left">                
                <h3>CHOOSE AN OPTION</h3>
                <ul>
                    <li>Check the configuration
                        <ul>
                            <li><a class="btn btn-default demo_wp" href="configuration" role="button">See Geofier Configuration</a></li>
                            <li><a class="btn btn-default demo_wp" href="columns" role="button">Get columns</a></li>
                        </ul>
                    </li>
                    <li>Check the features
                        <ul>
                            <li><a class="btn btn-default demo_wp" href="features" role="button">Get All Features</a></li>
                        </ul>
                    </li>
                    <li id="filters">Try these filters          
                        <ul> 
                            <li>
                                <form class="form-inline" role="form">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="id_num" placeholder="Feature ID">
                                    </div>
                                    <button type="submit" class="btn btn-default" id="id_filter">
                                        Get Features FILTERED BY ID
                                    </button>
                                </form>
                            </li>
                            <li>
                                <form class="form-inline" role="form">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-inline" id="col_name" placeholder="Column Name">
                                        <input type="text" class="form-control" id="col_equals" placeholder="Value">
                                    </div>
                                    <button type="submit" class="btn btn-default" id="col_filter">
                                        Get Features with column EQUALS TO value
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li> 
                </ul>
            </div>

            <div class="col-lg-8 column_right">
                <h4 class="title">Service URL: <span id="query" class="well well-sm"></span>  </h4>  
                <h4 class="title">Service Output: </h4>
                <div id="result">
                    <div id="tabs">
                        <ul>
                            <li><a href="#tabs-1">Table</a></li>
                            <li><a href="#tabs-2">Raw</a></li>
                            <li><a href="#tabs-3">Map</a></li>
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

<script>
    $(document).ready(function() {

        $("#tabs").tabs();
        $("#tabs").css('word-wrap', 'break-word');
        function getGeofierBaseURI(evt) {
            return window.location.href.replace('/demo', '');
        }

        function processResponse(response, query_uri) {
            $("#query").html('<a href="' + query_uri + '">' + query_uri + '</a>');
            var parsed_resp = $.parseJSON(response);
            var tbl = prettyPrint(parsed_resp, {
                maxDepth: 5
            });
            if (parsed_resp["status"]) {
                if (parsed_resp["status"] == "success") {
                    $().toastmessage('showSuccessToast', "Success");
                } else {
                    $().toastmessage('showErrorToast', "Error");
                }
                $("#tabs").tabs('option', 'active', 0);
                $("#tabs").tabs({
                    'disabled': [2]
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


        $(".demo_wp").click(function(a) {
            a.preventDefault();
            var uri = getGeofierBaseURI(a);
            var obj = a.currentTarget;
            var query_uri = uri + "/" + $(obj).attr("href");
            $.get(query_uri, null, function(response) {
                processResponse(response, query_uri)
            }).fail(function(response) {
                processResponse(response.responseText, query_uri);
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
            }).fail(function(response) {
                processResponse(response.responseText, query_uri);
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
            }).fail(function(response) {
                processResponse(response.responseText, query_uri);
            });
        });

    });

</script>


            <script src="js/map.js"></script>


{% endblock content %}
