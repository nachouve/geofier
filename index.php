<?php

require 'vendor/autoload.php';

require_once('Database.php');
require_once('Geojson.php');

$app = new \Slim\Slim(
array(
    'debug' => true,
    'mode' => 'development'
)
);

$app->get('/', function() use ($app){
    $app->render('intro.php');
});


# Test function
$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
    exit(0);
});

function idiormTest(){ 
    include('config.php');

    if ($DB_TYPE == 'sqlite'){
        ORM::configure($DB_TYPE.':'.$DB_HOST);
    } else {
           $tns = '(DESCRIPTION =
             (ADDRESS = (PROTOCOL = TCP)
             (HOST = '.$DB_HOST.')(PORT = '.$DB_PORT.'))
             (CONNECT_DATA =
             (SID='.$DB_NAME.')))';
             # (SERVER = DEDICATED)
             # (SERVICE_NAME = MY_SERVICE_NAME)))';

            // $this->db = oci_connect($DB_USER, $DB_PASS , $tns);
            ORM::configure('oci8:dbname='.$tns);
            ORM::configure('username', $DB_USER);
            ORM::configure('password', $DB_PASS);
    }
    ORM::configure('id_columns_overrides', array(
           $TBL_NAME -> $TBL_ID    
    )); 

    $rows = ORM::for_table($TBL_NAME)->find_many();
    foreach ($rows as $row){
        echo $row->$TBL_ID.'<br>'."\n";
    }
}

function testDB(){

    include('config.php');
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

# Test function
$app->get('/testdb', function () {
    testDB();
    exit(0);
});


function toJSON($resp){
    include('config.php');
    $json_conv = new GeoJSON($GEOM_SRS,$TO_SRS);
    #var_dump($resp);
    $a = $json_conv->createJson($resp, $TBL_X, $TBL_Y);
    header('Content-type: application/json');
    #echo '<p>['.json_encode($a, JSON_NUMERIC_CHECK).']</p>';
    return json_encode($a, JSON_NUMERIC_CHECK);
}

function getAllFeatures(){
    include('config.php');
    $db = new Database();
    #echo "<h1>Feature All </h1>";
    $resp = $db->getAll();
    echo toJSON($resp);
}

function getFeatureID($id){
    include('config.php');
    $db = new Database();
    #echo "<h1>Feature $id </h1>";
    $resp = $db->getID($id);
    echo toJSON($resp);
}

$app->get('/features', getAllFeatures);

$app->get('/feature/:id', getFeatureID);

# Filter by any column of the table
$app->get('/feature/:column/:value', function ($column, $value){
    include('config.php');
    $db = new Database();
    #echo "<h1>Feature Filter By $column </h1>";
    $resp = $db->getByFilter($column, $value);
    echo toJSON($resp);
});

$app->run();


if (isset($argv[1])){
   $debug=$argv[1];
   print "\n".$debug."\n";
   if ($debug=='all'){
	getAllFeatures();
   }
   if ($debug=='id1'){
	getFeatureID(431);
   }
   if ($debug=='testdb'){
    testDB();
   }
   if ($debug=='idiorm'){
    idiormTest();
   }
}


?>
