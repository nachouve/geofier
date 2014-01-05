.. index::
   single: GUI

Interfaz 
==========

La instalación por defecto  incluye una interfaz web para operar con los servicios de **Geofier**
y así poder probar su correcto funcionamiento.

Se puede acceder a esta inferfaz en `geofier/public_html/demo`_

Esta interfaz permite acceder de forma rápida a las funciones disponibles seleccionando los
parámetros si los hubiese y visualizar la respuesta recibida.

Permite ver las respuestas de 3 formas diferentes:

* **Tabla:** Muestra la respuesta recibida de forma amigable en una tabla formateada y aplicando colores.
* **Respuesta plana (raw):** Muestra la respuesta recibida sin ningún formateo.
* **Mapa:** Muestra la respuesta recibida en los casos que se trate de un GeoJSON en un visor geográfico web.


Configuración de la Interfaz
----------------------------

Al instalar **Geofier** en un propio sistema concreto, es posible que se necesiten ciertos ajustes en el servidor para
que la interfaz funcione correctamente.

Esta GUI está construida y probada con un servidor Apache, haciendo uso de `.htaccess`. Ten encuenta que puedes
necesitar ajustar algunos parámetros, por ejemplo, la directiva `AllowOverride`.

.. _geofier/public_html/demo: ../geofier/public_html/demo

