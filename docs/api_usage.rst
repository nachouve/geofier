Uso de los servicios
====================

**Geofier** está especialmente pensado para ser consumido desde aplicaciones web geomáticas.
Se puede consumir una capa servida desde Geofier con cualquier software que permita visualizar 
capa vectorial en formato GeoJSON, p.e. Leaflet o Openlayers.

Para acceder a los servicios sólo es necesario componer una URL de forma adecuada a la `API <api.html>`_.
**Geofier** devuelve un JSON o un GeoJSON con la información consultada 
(pronto tambien en JSONP para evitar problemas de cross-domain).

Un ejemplo de uso en JavaScript (puedes probarlo desde la consola de desarrollo de Chrome o Firefox):

.. code-block:: javascript
   :emphasize-lines: 3

    $.ajax({
        type: "GET",
        url: "../geofier/public_html/features",
        dataType: "json",
        success: function(data) {
            $.each(data, function(i, row) {
                console.log(row);
            });
        },
        error: function(error, status, desc) {
            console.log(status, desc);
        }
    });

