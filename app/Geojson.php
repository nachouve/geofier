<?php

/**
 * Geofier - GeoJSON REST API from alphanumeric DB
 * 
 * @author Nacho Varela (nachouve at gmail dot com)
 * @copyright Copyright (C) 2013-2014 Nacho Varela (nachouve at gmail dot com)
 * @package Geofier
 * 
 */

class GeoJSON {

    private $in_proj;
    private $out_proj;

    public function __construct($in_srs, $out_srs){
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

