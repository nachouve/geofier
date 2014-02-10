<?php

/**
 * Geofier - GeoJSON REST API from alphanumeric DB
 * 
 * PHP version 5
 * 
 * @category  Geofier
 * @package   Geofier
 * @author    Nacho Varela <nachouve@gmail.com>
 * @copyright 2013-2014 Nacho Varela
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link      http://geofier.com
 * 
 */

class GeoJSON
{
    private $_inproj;
    private $_outproj;

    public function __construct($insrs, $outsrs)
    {
        $proj4 = new Proj4php();
        $this->_inproj = new Proj4phpProj($insrs, $proj4);
        $this->_outproj = new Proj4phpProj($outsrs, $proj4);
    }

    public function createJson($resp_array,$x,$y)
    {
        // Build GeoJSON feature collection array
        $geojson = array(
            'type' => 'FeatureCollection',
            'features' => array()
        );

        if ($this->_inproj->srsCode != $this->_outproj->srsCode) {
            //Init proj4 if needed
            $proj4 = new Proj4php();
        }	
        foreach ($resp_array as $data) {
            $properties = $data;
            if ( isset($proj4) ) {
                $pointSrc = new proj4phpPoint(
                    str_replace(',', '.', $data[$x]),
                    str_replace(',', '.', $data[$y])
                );
                $pointDest = $proj4->transform(
                    $this->_inproj, 
                    $this->_outproj, 
                    $pointSrc
                );
                $p_x = $pointDest->x;
                $p_y = $pointDest->y;
            } else {
                $p_x = $data[$x];
                $p_y = $data[$y];
            }
            // Remove x and y fields from properties (optional)
            //unset($properties['x']);
            //unset($properties['y']);
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
            // Add feature arrays to feature collection array
            array_push($geojson['features'], $feature);
        }
        return $geojson;
    }
}
