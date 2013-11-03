.. index::
   single: API

.. _api:

API
==========

**Geofier** ofrece una API web muy sencilla que permite acceder a la información.

Capas geográficas
-------------------------

Métodos para obtener una capa geográfica:

====================================  ============
Resource                              Descripción
====================================  ============
`GET features`_                          devuelve un GeoJSON con todas las entidades de la tabla (o el máximo indicado en la configuración)
`GET feature/:id`_                       devuelve un GeoJSON con todas las entidades con el ID indicado
`GET feature/:column/:value`_            devuelve un GeoJSON con todas las entidades que cumplan que *<column>=<value>*
====================================  ============


Otra información
-------------------------

Métodos para obtener otro tipo de datos

====================================  ============
Resource                              Descripción
====================================  ============
`GET columns`_                          devuelve las columnas disponibles en la tabla (con las que se puede hacer filtros)
`GET test`_                             devuelve un JSON con información sobre la configuración actual de Geofier
====================================  ============



.. _GET features: api/fearures
.. _GET feature/:id: api/feature_id
.. _GET feature/:column/:value: api/feature_column

.. _GET columns: api/column
.. _GET test: api/test

