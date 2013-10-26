.. index::
   single: Devel 

Desarrollo 
==========

Como cualquier software, **Geofier** está en continuo proceso de desarrollo y mejora por lo que toda
ayuda es bienvenida.


Recursos para desarrolladores
------------------------------

* Haz un fork del repositorio en `github`_
* Pueder crear y chequear `tickets`_


Tecnologías
------------

**Geofier** es un proyecto de software libre que usa fantásticos proyectos libres de base:

* `Slim framework`_: para crear la API Rest
* `Twig`_: motor de plantillas
* `PDO`_: extensión PHP de abstracción da capa de acceso a datos
* `Idiorm`_: mapeador de objectos relacionales y creador fluido de consultas
* `Proj4php`_: adaptación  de PROJ4 para PHP


Estructura interna
------------------

**Geofier** está programado en PHP y tiene la siguiente estructura básica:

* html_public
* app

  * Database.php
  * config.php
  * GeoJSON.php
* docs

.. _tickets: https://github.com/nachouve/geofier/issues
.. _github: https://github.com/nachouve/geofier
.. _Slim framework: http://www.slimframework.com/
.. _Twig: http://twig.sensiolabs.org/
.. _PDO: http://www.php.net/manual/en/intro.pdo.php
.. _Idiorm: http://j4mie.github.io/idiormandparis/
.. _Proj4php: http://sourceforge.net/projects/proj4php/

