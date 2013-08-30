<?php

class GeoJSON {

  private $in_proj;
  private $out_proj;

//  public function __construct(){

//  }

  public function __construct($in_srs, $out_srs){
//    include_once("vendor/proj4php/proj4php.php");
     $proj4 = new Proj4php();
     $this->in_proj = new Proj4phpProj($in_srs, $proj4);
     $this->out_proj = new Proj4phpProj($out_srs, $proj4);
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
    if ($this->in_proj->srsCode != $this->out_proj->srsCode) {
      #Init proj4 if needed
      $proj4 = new Proj4php();
    }	
    foreach($resp_array as $data) {
        $properties = $data;
	if (isset($proj4)){
	   $pointSrc = new proj4phpPoint(str_replace(',','.',$data[$x]),
					 str_replace(',','.',$data[$y]));
	   $pointDest = $proj4->transform($this->in_proj, $this->out_proj, $pointSrc);
           $p_x = $pointDest->x;
	   $p_y = $pointDest->y;
        } else {
	   $p_x = $data[$x];
	   $p_y = $data[$y];
	}
        # Remove x and y fields from properties (optional)
        #unset($properties['x']);
        #unset($properties['y']);
        $feature = array(
            'type' => 'Feature',
            'geometry' => 'Geometry',
            'geometry' => array(
                'type' => 'Point',
                'coordinates' => array(
                    $p_x,
                    $p_y
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
