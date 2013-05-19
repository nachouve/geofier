<?php

# TODO: Deal with big queries (http://www.php.net/manual/en/pdo.pgsqllobcreate.php, mysql different methods)
# TODO: User Prepared statements
# TODO: Deal with different LIMIT sql flavours

class Database{

  private $db;

  public function __construct() {
    include('config.php');
    $this->db = new PDO($DB_TYPE.':host='.$DB_HOST.';dbname='.$DB_NAME.';port='.$DB_PORT, $DB_USER, $DB_PASS);
    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->db->setAttribute(PDO::ATTR_TIMEOUT, $QUERY_TIMEOUT);
  }

  public function getID($id){
    include('config.php');
    if ($TBL_ID_TYPE == 'text'){
      $where = ' where '.$TBL_ID.'="'.$id.'"';
    } else {
      $where = ' where '.$TBL_ID.'='.$id;
    }
    $sql = 'select * from '.$TBL_NAME.$where;
    #echo '<p>'.$sql."</p>\n";
    $resp = $this->db->query($sql);
    return $resp;
  }

  public function getAll(){
    include('config.php');
    $sql = 'select * from '.$TBL_NAME;
    if ($MAX_FEATS>-1){
      $sql = $sql.' LIMIT '.$MAX_FEATS;
    }
    #echo '<p>'.$sql."</p>\n";
    $resp = $this->db->query($sql);
    return $resp;
  }


}

?>
