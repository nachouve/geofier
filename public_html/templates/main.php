{% extends "base.twig.html" %}
{% block content %}

<div class="jumbotran jumbo_welcome">
	<div class="container container_extra_narrow">
		<h2 class="font_econ">Welcome to <a href="http://nuve.hol.es/geofier/">Geofier</a></h2>
	</div><!-- /container -->
</div><!-- /jumbotron -->

<div class="jumbotran jumbo_two">
	<div class="container container_extra_narrow">
		<div class="row">
			<div class="col-lg-6">
				Go to the <a href="api" class="btn btn-warning" role="button">API</a>
			</div>
			<div class="col-lg-6">
				Learn more <a href="api" class="btn btn-warning" role="button">ABOUT</a> this project
			</div>
		</div>

	</div><!-- /container -->

</div><!-- /jumbotron -->
<footer>
	<p id="version">
		Running Geofier version 0.2.
	</p>
</footer>

{% endblock content %}
