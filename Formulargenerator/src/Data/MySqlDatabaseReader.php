<?php namespace InputFormGenerator\Data;

      require_once('src/Data/DatabaseField.php');
      require_once('src/Data/DatabaseManager.php');

      class MySqlDatabaseReader extends DatabaseManager {

          // Public constructors
          function __construct($server, $database, $username, $password) {
              parent::__construct($server, $database, $username, $password);
          }

          // Private methods
          private function getDatabaseHandle() {
              return mysql_connect($this->server, $this->username, $this->password);
          }

          private function closeDatabaseHandle($database_handle) {
              mysql_close($database_handle);
          }

          // Public methods
          public function canConnectToDatabase() {
              try {
                  $database_handle = $this->getDatabaseHandle();
                  return mysql_select_db($this->database, $database_handle);
              }
              catch (Exception $exception) {
                  return false;
              }
              // TODO: close connection
          }

          public function executeSelect ($selectStatement) {
              // TODO: Escape the sql query
              try {
                  $database_handle = $this->getDatabaseHandle();
                  return mysql_query($selectStatement);
              }
              catch (Exception $exception) {
                  throw $exception;
              }
              // TODO: close connection
          }

          public function getFields($table) {
              $fields = array();
              
              $rows = $this->executeSelect("SELECT *
                                            FROM $table
                                            LIMIT 0, 0");

              for ($fieldIndex = 0; $fieldIndex < mysql_num_fields($rows); $fieldIndex++) {
                  array_push($fields, new DatabaseField(mysql_field_name($rows, $fieldIndex),
                                                        mysql_field_type($rows, $fieldIndex),
                                                        mysql_field_len($rows, $fieldIndex),
                                                        explode(' ', mysql_field_flags($rows, $fieldIndex)),
                                                        '[PH]'));
              }

              return $fields;
          }

      }

?>