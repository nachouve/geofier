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

Ejemplo de llamada
~~~~~~~~~~~~~~~~~~~~~~

En la siguiente URL se obtiene una capa geojson filtrada por la columna "idsistexpl" en la demo de Geofier online:

http://geofier.com/geofier/public_html/feature/idsistexpl/4

devolviendo como resultado:

.. code-block:: javascript

    {"type":"FeatureCollection",
     "features":[{
        "type":"Feature",
        "geometry":{
            "type":"Point",
            "coordinates":[-8.64242652797,42.6032926737]},
            "properties":{"idestacion":564,"nombre":"UMIA","lugar":"CALDAS DE REIS","idmunicipi":36005,"idparroqui":3600503,"xutm":529333,"yutm":4717000,"idsistexpl":4,"supconcato":446.22,"supconcave":190
            }
     },{
        "type":"Feature",
        "geometry":{
            "type":"Point",
            "coordinates":[-8.76404858423,42.5157141824]},
            "properties":{"idestacion":568,"nombre":"BAIXO UMIA","lugar":"A FIGUEIRA","idmunicipi":36046,"idparroqui":3604604,"xutm":519383,"yutm":4707240,"idsistexpl":4,"supconcato":446.25,"supconcave":386.31
       }
     }]
   }


Otra información
-------------------------

Métodos para obtener otro tipo de datos:

====================================  ============
Resource                              Descripción
====================================  ============
`GET columns`_                          devuelve las columnas disponibles en la tabla (con las que se puede hacer filtros)
`GET configuration`_                             devuelve un JSON con información sobre la configuración actual de Geofier
====================================  ============



.. _GET features: api/fearures
.. _GET feature/:id: api/feature_id
.. _GET feature/:column/:value: api/feature_column

.. _GET columns: api/column
.. _GET configuration: api/configuration

