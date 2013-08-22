<?php

require '../app/vendor/autoload.php';

require_once '../app/Database.php';
require_once '../app/Geojson.php';

$MAIN_PAGE='intro.php';

$app = new \Slim\Slim(
    array(
        'debug' => true,
        'mode' => 'web_demo' //'develepment', 'web_demo', 'production'
    )
);

$app->configureMode('web_demo', function () use ($app) {
    global $MAIN_PAGE;
    $MAIN_PAGE = 'geofier.html';
});

$app->get('/', function() use ($app){
    global $MAIN_PAGE;
    $app->render($MAIN_PAGE);
});

$app->get('/main', function() use ($app){
    $app->render('intro.php');
});

$app->get('/web', function() use ($app){
    $app->render('geofier.html');
});

$app->get('/api', function() use ($app){
    $app->render('api.php');
});

# Test function
$app->get('/testdb', function () {
    testDB();
    exit(0);
});

$app->get('/features', getAllFeatures);

$app->get('/feature/:id', getFeatureID);

$app->get('/columns', getAllColumns);

# Filter by any column of the table
$app->get('/feature/:column/:value', function ($column, $value){
    $db = new Database();
    $resp = $db->getByFilter($column, $value);
    echo toJSON($resp);
});

function testDB(){
    include '../app/config.php';
    $db = new Database();
    if ($db->status == 'ready') {        
        $msg['status'] = 'success';
        $sql = 'select * from '.$TBL_NAME;
        #echo '<p>'.$sql."</p>\n";        
        $resp = $db->db->query($sql);
        if ($resp === false) {
            $msg['status'] = 'error';
            $error_info = $db->db->errorInfo();
            $msg['message'] = 'query not successful: '.$error_info[2];
        } else if (sizeof($resp)==0){
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
    $msg_text['TBL_ID_TYPE']=$TBL_ID_TYPE;
    $msg_text['TBL_X']=$TBL_X;
    $msg_text['TBL_Y']=$TBL_Y;
    $msg_text['GEOM_SRS']=$GEOM_SRS;
    $msg_text['TO_SRS']=$TO_SRS;
    $msg_text['IGNORE_COLUMNS']=$IGNORE_COLUMNS;
    $msg_text['MAX_FEATS']=$MAX_FEATS;
    $msg['data'] = $msg_text;
    echo json_encode($msg);

}

function toJSON($resp){
    include '../app/config.php';
    $json_conv = new GeoJSON($GEOM_SRS,$TO_SRS);
    $a = $json_conv->createJson($resp, $TBL_X, $TBL_Y);
    header('Content-type: application/json');
    #echo '<p>['.json_encode($a, JSON_NUMERIC_CHECK).']</p>';
    return json_encode($a, JSON_NUMERIC_CHECK);
}

function getAllFeatures(){
    $db = new Database();
    $resp = $db->getAll();
    echo toJSON($resp);
}

function getFeatureID($id){
    $db = new Database();
    #echo "<h1>Feature $id </h1>";
    $resp = $db->getID($id);
    echo toJSON($resp);
}

#TODO Check status...
function getAllColumns(){
    $db = new Database();
    $resp = $db->getAllColumns();
    if ($db->status == 'ready') {        
        $msg['status'] = 'success';
        #$resp = $db->db->query($sql);
        if ($resp === false) {
            $msg['status'] = 'error';
            $error_info = $db->db->errorInfo();
            $msg['message'] = 'query not successful: '.$error_info[2];
        } else if (sizeof($resp)==0){
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

$app->run();


if (isset($argv[1])){
   $debug=$argv[1];
   print "\nDEBUG OPTION: ".$debug."\n";
   if ($debug=='all'){
	getAllFeatures();
   }
   if ($debug=='id'){
	getFeatureID($argv[2]);
   }
   if ($debug=='testdb'){
    testDB();
   }
   if ($debug=='cols'){
     getAllColumns();
   }
}


?>
