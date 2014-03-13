<?php namespace InputFormGenerator\Data;

      require_once('src/Data/DatabaseField.php');
      require_once('src/Data/DatabaseManager.php');

      class MySqlDatabaseReader extends DatabaseManager {

          // Public constructors
          function __construct($server, $database, $username, $password) {
              parent::__construct($server, $database, $username, $password);
              mysql_select_db($this->database, $this->getDatabaseHandle());
          }

          // Private methods
          private function getDatabaseHandle() {
              return mysql_connect($this->server, $this->username, $this->password);
          }

          // Public methods
          public function canConnect() {
              try {
                  return mysql_select_db($this->database, $this->getDatabaseHandle());
              }
              catch (Exception $exception) {
                  return false;
              }
          }
          
          /**
           * @author http://www.electrictoolbox.com/check-if-mysql-table-exists/php-function/
           */
          public function doesTableExist($table) {
              try {
                  $result = $this->executeSelect("SELECT COUNT(*) AS count 
                                                  FROM information_schema.tables
                                                  WHERE table_schema = '$this->database'
                                                  AND table_name = '$table'");
                  
                  return mysql_result($result, 0) > 0;
              }
              catch (Exception $exception) {
                  return false;
              }
          }

          public function executeSelect ($selectStatement) {
              try {
                  return mysql_query($selectStatement, $this->getDatabaseHandle());
              }
              catch (Exception $exception) {
                  throw $exception;
              }
          }

          public function getFields($table) {
              try {
                  $fields = array();
                  
                  $result = $this->executeSelect("SELECT *
                                                  FROM $table
                                                  LIMIT 0, 0");

                  for ($fieldIndex = 0; $fieldIndex < mysql_num_fields($result); $fieldIndex++) {
                      array_push($fields, new DatabaseField(mysql_field_name($result, $fieldIndex),
                                                            mysql_field_type($result, $fieldIndex),
                                                            mysql_field_len($result, $fieldIndex),
                                                            explode(' ', mysql_field_flags($result, $fieldIndex))));
                  }

                  return $fields;
              }
              catch (Exception $exception) {
                  throw $exception;
              }
          }

      }

?>