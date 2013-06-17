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

# Test function
$app->get('/testdb', function () {
    include('config.php');
    $db = new Database();
    echo '<h1>Connection to DB '.$DB_TYPE.' with success!!!</h1>';
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

}


?>
