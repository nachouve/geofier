.. index::
   single: Introduction 

Introducción
============

`Geofier`_ es un pequeño componente para servidor con un fin muy simple: 
transformar dinámicamente a GeoJSON coordenadas geográficas almacenadas en bases de datos alfanuméricas.
Es un software muy ligero de fácil instalación y que dota a tu sistema
de capacidades para servir información geográfica sin hacer cambios en tu sistema.

Durante años en multitud de proyectos, se ha recogido información de Longitud/Latitud o 
Coordenada_X/Coordenada_Y a través de formularios web u otras aplicaciones. Esa información se almacenaba 
en columnas alfanuméricas en bases de datos. Sin embargo, para visualizar esos datos espaciales en un mapa
se deben realizar exportaciones a ficheros GIS o migrar a sistemas más avanzados con bases de datos geográficas,
servidores de mapas, etc. 

`Geofier`_ ofrece una interfaz REST para consumir una capa geográfica generada 
automáticamente a partir de tablas con columnas latlong o XY en un formato abierto y ágil
que pueden consumir visores geográficos modernos como OpenLayers, Leaflet y otros. Además, permite hacer consultas 
para filtrar la información de forma sencilla. Además es una buena base para programar más funcionalidad
sobre dichos datos, porque tiene una estructura muy flexible.


Cuándo utilizar Geofier
-----------------------

`Geofier`_ es muy indicado si...

* tienes una base de datos con columnas lat/lon o X/Y 
* quieres ver los puntos en un mapa en la web
* no es posible incorporar módulos espaciales (p.e por restricciones de administración, costes, etc.)
* tienes aplicaciones de negocio consolidadas y no es posible adaptar
* no tienes tiempo para soluciones complejas

Características
---------------

* Generación de GeoJSON a partir de BD alfanuméricas
* API REST sencilla y funcional 
* Filtros y consultas
* Interfaz web básica para consumir
* Ejemplos de integración en Openlayer y Leaflet
* Muy ligero
* Pocos requisitos de sistema
* Fácil configuración
* Construido con proyectos consolidados PDO, Slim, idiorm, ...
* Testeado con bases de datos PostgreSQL, MySQL y SQLite. Pero debería funcionar con muchas más...


Licencia
--------

A no ser que que se especifique lo contrario en algún fichero, todo el código de **Geofier** es [GPL3 License].

.. _Geofier: http://geofier.com
