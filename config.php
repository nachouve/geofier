<?php


/*
 * Connection parameters
 */

$DB_TYPE='pgsql'; 	# pgsql|mysql|sqlite
$DB_HOST='localhost'; 	# for sqlite path to the sqlite_db file
$DB_PORT='5432'; 	# not set in SQLite
$DB_NAME='test_db'; 	# not set in SQLite
$DB_USER='test_user'; 	# not set in SQLite
$DB_PASS='test_pwd'; 	#not set in SQLite

/*
 * Parameters of the table to be served
 */

$TBL_NAME='my_nongeo_table';
$TBL_ID='gid';
$TBL_X='coorx';
$TBL_Y='coory';


/**
 * Other options
 */

# Set the maximum number of rows to send. 
# Set to '-1' to not limit.
$MAX_FEATS=200;

# Maximum time for a DB query (in seconds)
$QUERY_TIMEOUT='30';

?>
