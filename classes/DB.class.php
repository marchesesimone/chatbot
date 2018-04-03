<?php
namespace DBApp;

use ConfigApp\Config;

/**
 * Class DB
 */
class DB {

  protected $link;

  private static $instance = null;

  protected $error;

  public function __construct() {

    try {
      $this->link = new \mysqli(Config::DB_HOST, Config::DB_USER, Config::DB_PASS, Config::DB_NAME);

      if ($this->link) {
        $this->createShema();
      }

    } catch (PDOException $e) {

      echo $e->getMessage();
    }

  }

  /**
   * @return \DBApp\DB|null
   */
  public static function getInstance() {
    if (self::$instance == null) {
      self::$instance = new DB();
    }
    return self::$instance;
  }

  /**
   * @return \mysqli
   */
  public function getConnection() {
    return $this->link;
  }

  /**
   * Create Schema DB
   */
  public function createShema() {
    $this->link->query("CREATE TABLE IF NOT EXISTS user (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    botman_id VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
    ) ENGINE = InnoDB") or die(mysqli_error($this->link));
  }

  public function insert($table, array $dataArray, $returnID = false) {
  	$getColumnsKeys = array_keys($dataArray);
	  $implodeColumnKeys = implode(",",$getColumnsKeys);

	  $getValues = array_values($dataArray);
	  $implodeValues = "'".implode("','",$getValues)."'";

	  $sql = "INSERT INTO $table (".$implodeColumnKeys.") values (".$implodeValues.")";
	  $this->link->query($sql) or die(mysqli_error($this->link));

    if($returnID == true) {
      return $this->link->insert_id;
    } else {
      return $this->link->affected_rows;
    }
  }

  public function update() {

  }

  /**
   * @param $table
   * @param $condition
   */
  public function delete($table, $field_condition, $where_condition) {
    $sql = "DELETE FROM $table WHERE $field_condition = '$where_condition'; ";
    if ($this->link->query($sql)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  /**
   * @param $table
   * @param $field_condtion
   * @param $id
   *
   * @return int|object|\stdClass
   */
  public function find($table, $field_condition, $where_condition) {
    $sql = "SELECT * FROM $table WHERE $field_condition = '$where_condition'; ";
    $result = $this->link->query($sql) or die(mysqli_error($this->link));
    if ($result->num_rows) {
      return $result->fetch_object();
    } else {
      return 0;
    }
  }
  /**
   * Close connection DB
   */
  public function closeConnection() {
    $this->link = NULL;
  }

}