<?php

class GeoJSON {

  public function __construct(){

  }

  public function createJson($resp_array,$x,$y){
    # Build GeoJSON feature collection array
    $geojson = array(
      'type' => 'FeatureCollection',
      'features' => array()
    );
    #https://github.com/bmcbride/PHP-Database-GeoJSON/blob/master/csv_geojson.php

    #$data = $resp_array;#array_combine($header, $row);
    #print_r ($resp_array[0]);
    #print_r ($data);
    foreach($resp_array as $data) {
        $properties = $data;
        # Remove x and y fields from properties (optional)
        #unset($properties['x']);
        #unset($properties['y']);
        $feature = array(
            'type' => 'Feature',
            'geometry' => 'Geometry',
            'geometry' => array(
                'type' => 'Point',
                'coordinates' => array(
                    $data[$x],
                    $data[$y]
                )
            ),
            'properties' => $properties
        );
        # Add feature arrays to feature collection array
        array_push($geojson['features'], $feature);
    }
    return $geojson;
  }
}

#{ "type": "FeatureCollection",
# "features": [
#   { "type": "Feature",
#     "geometry": {"type": "Point", "coordinates": [102.0, 0.5]},
#     "properties": {"prop0": "value0"}
#     },
#   { "type": "Feature",
#     "geometry": {
#       "type": "LineString",
#       "coordinates": [
#         [102.0, 0.0], [103.0, 1.0], [104.0, 0.0], [105.0, 1.0]
#         ]
#       },
#     "properties": {
#       "prop0": "value0",
#       "prop1": 0.0
#       }
#     },
#   { "type": "Feature",
#      "geometry": {
#        "type": "Polygon",
#        "coordinates": [
#          [ [100.0, 0.0], [101.0, 0.0], [101.0, 1.0],
#            [100.0, 1.0], [100.0, 0.0] ]
#          ]
#      },
#      "properties": {
#        "prop0": "value0",
#        "prop1": {"this": "that"}
#        }
#      }
#    ]
#  }

?>
