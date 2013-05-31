<?php


/*
 * Connection parameters
 */

$DB_TYPE='sqlite'; 	# pgsql|mysql|sqlite|oracle
$DB_HOST='/var/tmp/geofier/test/test_db'; 	# In SQLite set the path to sqlite_db file
$DB_PORT='5432'; 	# Not set in SQLite. Normally ports are 5432(pgsql), 3306(mysql), 1521(oracle)
$DB_NAME='/var/tmp/geofier/test/test_db'; 	# Not set in SQLite. In Oracle set the SID here.
$DB_USER='test_user'; 	# Not set in SQLite
$DB_PASS='test_pwd'; 	# Not set in SQLite

/*
 * Parameters of the table to be served
 */

$TBL_NAME='aforos';
$TBL_ID='idestacion';
$TBL_ID_TYPE='text';	# text|numeric
$TBL_X='xutm';
$TBL_Y='yutm';

$IGNORE_COLUMNS=array('GEOMETRY', 'the_geom');
/**
 * Other options
 */

# Set the maximum number of rows to send. 
# Set to '-1' to not limit.
$MAX_FEATS=200;

# Maximum time for a DB query (in seconds)
$QUERY_TIMEOUT='30';

?>
