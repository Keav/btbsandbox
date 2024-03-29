<?php
  require_once(LIB_PATH.'config.php');

  class MySQLDatabase {

    // Set an attribute rather than a local variable so that it is accessable outside the function
    private $connection;

    // Use a construct function to automatically perform setup tasks when an object is created.
    // There is no situation where we would need the object created without an active connection
    // ready for us to use.
    function __construct() {
      $this->open_connection();
    }

    public function open_connection() {
      $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
      if(mysqli_connect_errno()) {
        die("Database connection failed: " . mysqli_error() . " (" . mysqli_connect_errno() . ")");
      }
    }

    public function close_connection() {
      if(isset($this->connection)) {
        mysqli_close($this->connection);
        unset($this->connection);
      }
    }

    public function query($sql) {
      $result = mysqli_query($this->connection, $sql);
      $this->confirm_query($result);
      return $result;
    }

    private function confirm_query($result) {
      if (!$result) {
        die("Database query failed.<br />");
      }
    }

    public function escape_value($string) {
      $escaped_string = mysqli_real_escape_string($this->connection, $string);
      return $escaped_string;
    }

    // database neutral functions

    public function fetch_array($result_set) {
      return mysqli_fetch_array($result_set);
    }

    public function num_rows($result_set) {
      return mysqli_num_rows($result_set);
    }

    public function insert_id() {
      // get the last id inserted over the current db connection
      return mysqli_insert_id($this->connection);
    }

    public function affected_rows() {
      return mysqli_affected_rows($this->connection);
    }
  }

  // Instantiate class
  $database = new MySQLDatabase();

  // Set reference so either $db OR $database can be used
  $db =& $database;

?>
