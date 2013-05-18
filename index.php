<?php

require 'vendor/autoload.php';

require_once('Database.php');
require_once('Geojson.php');

set_time_limit(40);

$db = new Database();
$json_conv = new GeoJSON();

$app = new \Slim\Slim();

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

$app->get('/features', function (){

    include('config.php');
    global $db;
    global $json_conv;
    #echo "<h1>Feature All </h1>";
    $resp = $db->getAll();
   # while ($r = $resp->fetch()){
   #   print_r($r);
   # }
    $a = $json_conv->createJson($resp->fetchAll(PDO::FETCH_ASSOC), $TBL_X, $TBL_Y);
    header('Content-type: application/json');
    #echo '<p>['.json_encode($a, JSON_NUMERIC_CHECK).']</p>';
    echo json_encode($a, JSON_NUMERIC_CHECK);
});


$app->get('/feature/:id', function ($id){

    include('config.php');
    global $db;
    global $json_conv;
    #echo "<h1>Feature $id </h1>";
    $resp = $db->getID($id);
   # while ($r = $resp->fetch()){
   #   print_r($r);
   # }
    $a = $json_conv->createJson($resp->fetchAll(PDO::FETCH_ASSOC), $TBL_X, $TBL_Y);
    header('Content-type: application/json');
    #echo '<p>['.json_encode($a, JSON_NUMERIC_CHECK).']</p>';
    echo json_encode($a, JSON_NUMERIC_CHECK);
});

$app->run();

?>
