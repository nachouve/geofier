<?php

# TODO: Deal with big queries (http://www.php.net/manual/en/pdo.pgsqllobcreate.php, mysql different methods)
# TODO: Use Prepared statements
# TODO: Deal with different sql flavours [[try with CodeIgniter and its Active Record]]
# TODO: Catch db exceptions on all functions
# TODO: Only access config.php once!!!

class Database{

  ###TODO private!!!!!!!!!!!!!!!!!
  ###TODO private!!!!!!!!!!!!!!!!!
  ###TODO private!!!!!!!!!!!!!!!!!
  ###TODO private!!!!!!!!!!!!!!!!!
  public $db;
  public $status = null;
  public $error_message = '';

  public function __construct() {
    include('config.php');
    try {
      $this->status = 'ready';
      if ($DB_TYPE=='sqlite'){
          $this->db = new PDO($DB_TYPE.':'.$DB_HOST);
        } else if ($DB_TYPE=='oracle'){
          # testing with OCI8 (PDO_OCI is still experimental)
          $tns = '(DESCRIPTION =
             (ADDRESS = (PROTOCOL = TCP)
             (HOST = '.$DB_HOST.')(PORT = '.$DB_PORT.'))
             (CONNECT_DATA =
             (SID='.$DB_NAME.')))';
             # (SERVER = DEDICATED)
             # (SERVICE_NAME = MY_SERVICE_NAME)))';

          $this->db = oci_connect($DB_USER, $DB_PASS , $tns);

          if (!$this->db){
            echo (oci_error());
          } 
        } else if ($DB_TYPE=='pgsql' OR $DB_TYPE=='mysql'){
          $this->db = new PDO($DB_TYPE.':host='.$DB_HOST.
                ';dbname='.$DB_NAME.';port='.$DB_PORT, $DB_USER, $DB_PASS);
          $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $this->db->setAttribute(PDO::ATTR_TIMEOUT, $QUERY_TIMEOUT);
        }
     } catch (PDOException $err) {
         $this->error_message = $err->getMessage();
         $this->status = 'error';
     }
  }

 public function ignoreFields($rows){
    include('config.php');
    ## TODO This are not very optimized
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

  public function getLimit($where_clause){
    include('config.php');
    $limit = "";
    if ($MAX_FEATS>-1){
	if ($DB_TYPE != 'oracle') {
	  $limit = ' LIMIT '.$MAX_FEATS;
	} else {
	  $with_where = ' WHERE ';
	  if ($where_clause){
		$with_where = ' AND ';
	  } 
    	  $limit = $with_where.' ROWNUM <= '.$MAX_FEATS;
	}	
    }
    return $limit;
  }

  public function getID($id){
    include('config.php');
    if (!isset($TBL_ID_TYPE) || $TBL_ID_TYPE == 'text'){
      $where = ' where '.$TBL_ID."='".$id."'";
    } else {
      $where = ' where '.$TBL_ID.'='.$id;
   }
    $limit = $this->getLimit($where);
    $sql = 'select * from '.$TBL_NAME.$where.$limit;
    #echo '<p>'.$sql."</p>\n";
    if ($DB_TYPE != 'oracle'){
      $resp = $this->db->query($sql);
      $rows = $resp->fetchAll(PDO::FETCH_ASSOC);
    } else {
      $resp = oci_parse($this->db, $sql);
      if (!$this->db){
        echo (oci_error());
      }
      oci_execute($resp);
      oci_fetch_all($resp, $rows, null, null, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
    }
    $rows = $this->ignoreFields($rows);
    return $rows;
  }

  public function getByFilter($column, $value){
    include('config.php');
    ## TODO: Solve column type...
    ## TODO: Check if column exists...
    ## TODO: Limits here also
    if (!isset($TBL_ID_TYPE) || $TBL_ID_TYPE == 'text'){
      $where = ' where '.$column."='".$value."'";
    } else {
      $where = ' where '.$column.'='.$value;
   }
    $limit = $this->getLimit($where);
    $sql = 'select * from '.$TBL_NAME.$where.$limit;
    #echo '<p>'.$sql."</p>\n";
    if ($DB_TYPE != 'oracle'){
      $resp = $this->db->query($sql);
      $rows = $resp->fetchAll(PDO::FETCH_ASSOC);
    } else {
      $resp = oci_parse($this->db, $sql);
      if (!$this->db){
        echo (oci_error());
      }
      oci_execute($resp);
      oci_fetch_all($resp, $rows, null, null, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
    }
    $rows = $this->ignoreFields($rows);
    return $rows;
  }

  public function getAll(){
    include('config.php');
    $sql = 'select * from '.$TBL_NAME;
    $where = '';
    $limit = $this->getLimit($where);
    $sql = 'select * from '.$TBL_NAME.$where.$limit;
    #echo '<p>'.$sql."</p>\n";
    if ($DB_TYPE != 'oracle'){
      $resp = $this->db->query($sql);
      $rows = $resp->fetchAll(PDO::FETCH_ASSOC);
    } else {
      $resp = oci_parse($this->db, $sql);
      if (!$this->db){
        echo (oci_error());
      }
      oci_execute($resp);
      oci_fetch_all($resp, $rows, null, null, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
    }
    $rows = $this->ignoreFields($rows);
    return $rows;
  }

}

?>
