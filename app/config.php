<?php

$GEOFIER_VERSION=0.2;


/*
 * Connection parameters
 */
$CURRENT_FOLDER=realpath(dirname(__FILE__));

$DB_TYPE='sqlite'; 	# pgsql|mysql|sqlite|oracle
$DB_HOST= $CURRENT_FOLDER.'/test/test_db'; 	# In SQLite set the path to sqlite_db file
$DB_PORT='5432'; 	# Not set in SQLite. Normally ports are 5432(pgsql), 3306(mysql), 1521(oracle)
$DB_NAME=''; 	# Not set in SQLite. In Oracle set the SID here.
$DB_USER='test_user'; 	# Not set in SQLite
$DB_PASS='test_pwd'; 	# Not set in SQLite

/*
 * Parameters of the table to be served
 */

$TBL_NAME='aforos';
$TBL_ID='idestacion';
###$TBL_ID_TYPE='text';	# text|numeric
$TBL_X='xutm';
$TBL_Y='yutm';

$GEOM_SRS='EPSG:25829';
$TO_SRS='EPSG:4326';

/**
 * $IGNORE_COLUMNS array has columns names that will not be
 *   included on the output.
 */
$IGNORE_COLUMNS=array('GEOMETRY', 'the_geom', 'OGC_FID','caracteris');


/**
 * Other options
 */

# Set the maximum number of rows to send. 
# Set to '-1' to not limit.
$MAX_FEATS=200;

# Maximum time for a DB query (in seconds)
$QUERY_TIMEOUT='30';

?>
