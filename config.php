<?php


/*
 * Connection parameters
 */

$DB_TYPE='pgsql';
$DB_HOST='localhost';
$DB_PORT='5432';
$DB_NAME='test_db';
$DB_USER='test_user';
$DB_PASS='test_password';


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
