<?php

require 'vendor/autoload.php';

require_once('Database.php');
require_once('Geojson.php');

$app = new \Slim\Slim();

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

$app->get('/features', function (){

    include('config.php');
    $db = new Database();
    #echo "<h1>Feature All </h1>";
    $resp = $db->getAll();
    $json_conv = new GeoJSON();
    #var_dump($resp);
    $a = $json_conv->createJson($resp, $TBL_X, $TBL_Y);
    header('Content-type: application/json');
    #echo '<p>['.json_encode($a, JSON_NUMERIC_CHECK).']</p>';
    echo json_encode($a, JSON_NUMERIC_CHECK);

});


$app->get('/feature/:id', function ($id){

    include('config.php');
    $db = new Database();
    #echo "<h1>Feature $id </h1>";
    $resp = $db->getID($id);
    $json_conv = new GeoJSON();
    $a = $json_conv->createJson($resp, $TBL_X, $TBL_Y);
    header('Content-type: application/json');
    #echo '<p>['.json_encode($a, JSON_NUMERIC_CHECK).']</p>';
    echo json_encode($a, JSON_NUMERIC_CHECK);
});

# Filter by any column of the table
$app->get('/feature/:column/:value', function ($column, $value){

    include('config.php');
    $db = new Database();
    #echo "<h1>Feature Filter By $column </h1>";
    $resp = $db->getByFilter($column, $value);
    $json_conv = new GeoJSON();
    $a = $json_conv->createJson($resp, $TBL_X, $TBL_Y);
    header('Content-type: application/json');
    #echo '<p>['.json_encode($a, JSON_NUMERIC_CHECK).']</p>';
    echo json_encode($a, JSON_NUMERIC_CHECK);
});

$app->run();

?>
