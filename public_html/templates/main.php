{% extends "base.twig.html" %}
{% block content %}

<div class="jumbotran jumbo_welcome">
    <div class="container">
        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-11">
                <h3 class="title">Welcome to <a style="color:inherit" href="http://geofier.com">Geofier</a></h3>
            </div>
        </div>


    </div><!-- /container -->
</div><!-- /jumbotron -->

<div class="jumbotran jumbo_two">
    <div class="container">
        <div class="row" style="font-family: 'Arapey'; font-size:1.2em">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-8">
                Go to the <a href="demo" class="btn btn-default" role="button">DEMO</a> or learn more <a href="http://geofier.com" class="btn btn-default" role="button">ABOUT</a> this project
            </div>

        </div>

    </div><!-- /container -->

</div><!-- /jumbotron -->

<div class="jumbotran jumbo_welcome">
    <div class="container">
        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-11">
                <p id="version">
                    Running Geofier version 0.2
                </p>
            </div>
        </div>


    </div><!-- /container -->
</div><!-- /jumbotron -->



{% endblock content %}
