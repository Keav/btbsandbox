<?php
  // If it's going to need the database, then it's
  // probably smart to require it before we start.
  require_once(LIB_PATH.'database.php');

  class DatabaseObject {

    // protected static $table_name;

    // COMMON DATABASE METHODS

    public static function find_all() {
      return static::find_by_sql("SELECT * FROM " . static::$table_name);
    }

    public static function find_by_id($id=0) {
      global $database;
      $result_array = static::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE id={$id} LIMIT 1");
      return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function find_by_sql($sql="") {
      global $database;
      $result_set = $database->query($sql);
      $object_array = array();
      while ($row = $database->fetch_array($result_set)) {
        $object_array[] = static::instantiate($row);
      }
      return $object_array;
    }

    private static function instantiate($record) {
        // Could check that $record exists and is an array

        // To check the called class (make sure it's not using self), use
        // $class_name = get_called_class();
        // Then could also use
        // $object = new $class_name;

        $object = new static;

        // Simple, long-form approach
        // $object->id = $record['id'];
        // $object->username = $record['username'];
        // $object->password = $record['password'];
        // $object->first_name = $record['first_name'];
        // $object->last_name = $record['last_name'];

        // More dynamic, short-form approach
        foreach($record as $attribute=>$value) {
          if($object->has_attribute($attribute)) {
            $object->$attribute = $value;
          }
        }
        return $object;
    }

    private function has_attribute($attribute) {
      // get_object_vars returns and associative array with all attribute
      // (incl. private ones!) as the keys and their current values as the value
      $object_vars = $this->attributes();
      // We don't care about the value, we just want to know if they key exists
      // Will return true or false
      return array_key_exists($attribute, $object_vars);
    }

    protected function attributes() {
      // return an array of attribute keys and their values
      // return get_object_vars($this);
      $attributes = array();
      foreach(static::$db_fields as $field) {
        if(property_exists($this, $field)) {
          $attributes[$field] = $this->$field;
        }
      }
      return $attributes;
    }

    protected function sanitized_attributes() {
      global $database;

      $clean_attributes = array();

      // sanitize the values before submitting
      // Note: does not alter the actual value of each attribute
      foreach ($this->attributes() as $key => $value) {
        $clean_attributes[$key] = $database->escape_value($value);
      }
      return $clean_attributes;
    }

    // REPLACED WITH A CUSTOM SAVE - currently located in photograph.php
    // public function save() {
      // A new record won't have an id yet.
      // So if it has an id run update, if not, run create
      // return isset($this->id) ? $this->update() : $this->create();
    // }

    public function create() {
      global $database;

      // Don't forget your SQL syntax and good habits:
      // - INSERT INTO table (key, key) VALUES (value, value)
      // - single-quotes around all values
      // - escape all values to prevent SQL injection

      $attributes = $this->sanitized_attributes();

      $sql = "INSERT INTO " . static::$table_name . " (";
      $sql .= join(", ", array_keys($attributes));
      $sql .= ") VALUES ('";
      $sql .= join("', '", array_values($attributes));
      // $sql .= $database->escape_value($this->username) . "', '";
      // $sql .= $database->escape_value($this->password) . "', '";
      // $sql .= $database->escape_value($this->first_name) . "', '";
      // $sql .= $database->escape_value($this->last_name) . "')";
      $sql .= "')";

      if($database->query($sql)) {
        $this->id = $database->insert_id();
        return true;
      } else {
        return false;
      }
    }

    public function update() {
      global $database;

      // Don't forget your SQL syntax and good habits:
      // - UPDATE table SET key='value', key='value' WHERE condition
      // - single-quotes around all values
      // - escape all values to prevent SQL injection

      $attributes = $this->sanitized_attributes();

      $attribute_pairs = array();
      foreach ($attributes as $key => $value) {
        $attribute_pairs[] = "{$key}='{$value}'";
      }

      $sql = "UPDATE " . static::$table_name . " SET ";
      // $sql .= "username='" . $database->escape_value($this->username) . "', ";
      // $sql .= "password='" . $database->escape_value($this->password) . "', ";
      // $sql .= "first_name='" . $database->escape_value($this->first_name) . "', ";
      // $sql .= "last_name='" . $database->escape_value($this->last_name) . "' ";
      $sql = join(", ", $attribute_pairs);
      $sql .= " WHERE id=" . $database->escape_value($this->id);

      $database->query($sql);
      return ($database->affected_rows() == 1) ? true : false;
    }

    public function delete() {
      global $database;

      // Don't forget your SQL syntax and good habits:
      // - DELETE FROM table WHERE condition LIMIT=1
      // - single-quotes around all values
      // - use LIMIT 1

      $sql = "DELETE FROM " . static::$table_name;
      $sql .= " WHERE id=" . $database->escape_value($this->id);
      $sql .= " LIMIT 1";

      $database->query($sql);
      return ($database->affected_rows() == 1) ? true : false;
    }

  }
?>
