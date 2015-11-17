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

function testDB()
{
    include '../app/config.php';
    $db = new Database();
    if ( $db->status == 'ready' ) {        
        $msg['status'] = 'success';
        $sql = 'select * from '.$TBL_NAME;
        $resp = '';
        try { 
            $resp = $db->db->query($sql);
        } catch (Exception $e){
            $resp = false;
        }
        if ( $resp === false ) {
            $msg['status'] = 'error';
            $error_info = $db->db->errorInfo();
            $msg['message'] = 'query not successful: '.$error_info[2];
        } else if ( sizeof($resp) == 0 ) {
            $msg['status'] = 'error';
            $msg['message'] = 'no rows in the table';
        }
    } else {
        $msg['status'] = 'error';
        $msg['message'] = $db->error_message;
    }
    $msg_text['DB_TYPE'] = $DB_TYPE;
    $msg_text['TBL_NAME'] = $TBL_NAME;
    $msg_text['TBL_ID'] = $TBL_ID;
    $msg_text['TBL_X']=$TBL_X;
    $msg_text['TBL_Y']=$TBL_Y;
    $msg_text['GEOM_SRS']=$GEOM_SRS;
    $msg_text['TO_SRS']=$TO_SRS;
    $msg_text['IGNORE_COLUMNS']=$IGNORE_COLUMNS;
    $msg_text['MAX_FEATS']=$MAX_FEATS;
    $msg['data'] = $msg_text;
    echo json_encode($msg);

}

function toJSON($resp)
{
    include '../app/config.php';
    $json_conv = new GeoJSON($GEOM_SRS, $TO_SRS);
    $a = $json_conv->createJson($resp, $TBL_X, $TBL_Y);
    header('Content-type: application/json');
    //echo '<p>['.json_encode($a, JSON_NUMERIC_CHECK).']</p>';
    return json_encode($a, JSON_NUMERIC_CHECK);
}

function errorPre($db, $resp)
{
    $msg['status'] = $db->status;
    if ( $db->status != 'ready' ) {
       $msg['status'] = 'error';
       $msg['message'] = $db->error_message;
    }
    if ( $resp != null ) {
        if ( $resp === false ) {
            $msg['status'] = 'error';
            $error_info = $db->db->errorInfo();
            $msg['message'] = 'query not successful: '.$error_info[2];
        } else if ( sizeof($resp)==0 ) {
            $msg['status'] = 'error';
            $msg['message'] = 'no rows in the table';
        }
    }
    return $msg;
}

function getAllFeatures()
{
    $db = new Database();
    $msg = errorPre($db, null);
    if ( $msg['status']=='error' ) {
        echo json_encode($msg);
        return 0;
    };

    $resp = $db->getAll();

    $msg = errorPre($db, $resp);
    if ($msg['status']=='error') {
        echo json_encode($msg);
        return;
    };
    echo toJSON($resp);
}

function getFeatureID($id)
{
    $db = new Database();
    $resp = $db->getID($id);
    echo toJSON($resp);
}

//TODO Check status...
function getDistinctValues($column)
{
    $db = new Database();
    $resp = $db->getDistinctValues($column);
    if ( $db->status == 'ready' ) {        
        $msg['status'] = 'success';
        //$resp = $db->db->query($sql);
        if ( $resp === false ) {
            $msg['status'] = 'error';
            $error_info = $db->db->errorInfo();
            $msg['message'] = 'query not successful: '.$error_info[2];
        } else if ( sizeof($resp)==0 ) {
            $msg['status'] = 'error';
            $msg['message'] = 'no rows in the table';
        }
    } else {
        $msg['status'] = 'error';
        $msg['message'] = $db->error_message;
    }
    $msg['data'] = $resp;
    echo json_encode($msg);
}

function getAllColumns()
{
    $db = new Database();
    $resp = $db->getAllColumns();
    if ( $db->status == 'ready' ) {        
        $msg['status'] = 'success';
        //$resp = $db->db->query($sql);
        if ( $resp === false ) {
            $msg['status'] = 'error';
            $error_info = $db->db->errorInfo();
            $msg['message'] = 'query not successful: '.$error_info[2];
        } else if ( sizeof($resp) == 0 ) {
            $msg['status'] = 'error';
            $msg['message'] = 'no rows in the table';
        }
    } else {
        $msg['status'] = 'error';
        $msg['message'] = $db->error_message;
    }
    $msg['data'] = $db->getAllColumns();
    echo json_encode($msg);
}