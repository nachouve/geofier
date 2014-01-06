<?php

/**
 * Geofier - GeoJSON REST API from alphanumeric DB
 * 
 * @author Nacho Varela (nachouve at gmail dot com)
 * @copyright Copyright (C) 2013-2014 Nacho Varela (nachouve at gmail dot com)
 * @package Geofier
 * 
 */

require_once 'vendor/autoload.php';

class Database{

    public $db;
    public $status = null;
    public $error_message = '';

    public function __construct() {
        include('config.php');
        $this->status = 'ready';
        if ($DB_TYPE=='sqlite'){
            ORM::configure($DB_TYPE.':'.$DB_HOST);
        } else { 
            ORM::configure($DB_TYPE.':host='.$DB_HOST.';dbname='.$DB_NAME.';port='.$DB_PORT);
            ORM::configure('username', $DB_USER);
            ORM::configure('password',$DB_PASS);
        }
        ORM::configure('id_column_overrides', array(
            $TBL_NAME => $TBL_ID 
        ));
        ORM::configure('return_result_sets', true); 
        try {
            $this->db = ORM::get_db();
        } catch (PDOException $err) {
            $this->status = 'Error';
            $this->error_message = $err->getMessage()." (CODE: ".$err->getCode().")";
        }
    }

    public function ignoreFields($rows){
        include('config.php');
        ## TODO Optimize
        if (isset($IGNORE_COLUMNS)){
            foreach($rows as $row_num=>$row){
                foreach ($row as $k=>$v){
                    if (in_array($k, $IGNORE_COLUMNS)) {
                        unset($rows[$row_num][$k]);
                    }
                }
            }
        }
        return $rows;
    }

    public function getID($id){
        include('config.php');

        $rows = ORM::for_table($TBL_NAME)
            ->where($TBL_ID,$id)
            ->limit($MAX_FEATS)
            ->find_array();
        $rows = $this->ignoreFields($rows);
        return $rows;
    }

    public function getByFilter($column, $value){
        include('config.php');
        ## TODO: Check if column exists...
        $rows = ORM::for_table($TBL_NAME)
            ->where($column,$value)
            ->limit($MAX_FEATS)
            ->find_array();

        $rows = $this->ignoreFields($rows);
        return $rows;
    }

    public function getAll(){
        include('config.php');

        $rows = ORM::for_table($TBL_NAME)->limit($MAX_FEATS)->find_array();
        $rows = $this->ignoreFields($rows);
        return $rows;
    }

    public function getAllColumns(){
        include('config.php');
        $rows = ORM::for_table($TBL_NAME)->limit(1)->find_array();
        $rows = $this->ignoreFields($rows);
        $keys = array_keys($rows[0]);
        return $keys;
    }

    public function getDistinctValues($column){
        include('config.php');
        $rows = ORM::for_table($TBL_NAME)->distinct()->select($column)->order_by_asc($column)->find_array();
        $values = array();
        foreach ($rows as $key => $value) {
            $val = array_values($value);
            $values[]=$val[0];
        }
        return $values;
    }
}

