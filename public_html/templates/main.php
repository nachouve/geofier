{% extends "base.twig.html" %}
{% block content %}

<div class="jumbotran jumbo_welcome">
	<div class="container">
				<div class="row">
			<div class="col-lg-1">
			</div>
			<div class="col-lg-11">
				<h2 class="font_econ">Welcome to <a style="color:orange" href="http://nuve.hol.es/geofier/">Geofier</a></h2>
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
				Go to the <a href="api" class="btn btn-default" role="button">API</a> or learn more <a href="api" class="btn btn-default" role="button">ABOUT</a> this project
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
		Running Geofier version 0.2.
	</p>
			</div>
					</div>


	</div><!-- /container -->
</div><!-- /jumbotron -->



{% endblock content %}
