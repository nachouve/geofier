{% extends "base.twig.html" %}
{% block content %}

     <div class="middle">
        <p id="first_line"> Welcome to  <a href="http://nuve.hol.es/geofier/">GEOFIER</a> </p>
     </div>

       <div class="middle">
         <div class="column fifth">

        		<ul id="api" class="p_class">
	        		<li>Go to the <a href="api">API</a></li>
        		</ul></br>
        		<ul id="about" class="p_class">
	        		<li>learn more <a href="about">ABOUT</a> this project</li>
        		</ul></br>
<!--                        <p id="version"> Running Geofier version {{ geofierversion }}.</p>-->
                        <p id="version"> Running Geofier version 0.2.</p>
         </div>

         <div class="column sixth">
        		<ul class="p_class">
	        		<li>some other text here</li>
        		</ul></br>
         </div>
       </div>
{% endblock content %}
