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

require '../app/vendor/autoload.php';

require_once '../app/Database.php';
require_once '../app/Geojson.php';
require_once '../app/MainFunctions.php';

$MAIN_PAGE='intro.php';
require '../app/config.php';

$app = new \Slim\Slim(
    array(
        'debug' => $DEBUG_MODE,
        'mode' => 'web_demo', //'develepment', 'web_demo', 'production',
        'templates.path' => __DIR__.'/templates/',
    )
);

$app->error(
    function (\Exception $e) use ($app) {
        $app->view()->setData(array('exception' => $e));
        $app->render('error.php');
    }
);

$app->notFound(
    function () use ($app) {
        $app->render('404.php');
    }
);

$app->configureMode(
    'web_demo', 
    function () use ($app) {
        global $MAIN_PAGE;
        $MAIN_PAGE = 'main.php';
    }
);

\Slim\Extras\Views\Twig::$twigOptions = array(
    'charset'           => 'utf-8',
//    'cache'             => 'templates/cache',
    'auto_reload'       => true,
    'strict_variables'  => false,
    'autoescape'        => false
);

\Slim\Extras\Views\Twig::$twigExtensions = array(
    'Twig_Extensions_Slim',
);

$app->view(new \Slim\Extras\Views\Twig());


$app->get(
    '/', 
    function () use ($app) {
        global $MAIN_PAGE;
        $app->render($MAIN_PAGE);
    }
);

$app->get(
    '/main', 
    function () use ($app) {
        include '../app/config.php';
        //TODO Twig variable is not working
        $app->view()->setData(array('geofierversion' => $GEOFIER_VERSION));
        $app->render('main.php');
    }
);

$app->get(
    '/demo', 
    function () use ($app) {
        $app->render('demo.php');
    }
);

// Test function
$app->get(
    '/configuration', 
    function () {
        testDB();
        exit(0);
    }
);

$app->get('/features', getAllFeatures);

$app->get('/feature/:id', getFeatureID);

$app->get('/columns', getAllColumns);

$app->get('/distinct/:column', getDistinctValues);

// Filter by any column of the table
$app->get(
    '/feature/:column/:value', 
    function ($column, $value) {
        $db = new Database();
        $resp = $db->getByFilter($column, $value);
        echo toJSON($resp);
    }
);

// Filter by any column of the table
$app->get(
    '/like/:column/:value', 
    function ($column, $value) {
        $db = new Database();
        $resp = $db->getByFilter($column, $value, FALSE);
        echo toJSON($resp);
    }
);


$app->run();

if ( isset($argv[1]) ) {
    $debug=$argv[1];
    print "\nDEBUG OPTION: ".$debug."\n";
    if ($debug=='all') {
        getAllFeatures();
    }
    if ($debug=='id') {
        getFeatureID($argv[2]);
    }
    if ($debug=='test') {
        testDB();
    }
    if ($debug=='cols') {
        getAllColumns();
    }
}
