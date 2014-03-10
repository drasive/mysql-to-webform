<?php namespace InputFormGenerator\Data;
      
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
          
          public function executeSelect ($SqlQuery) {
              // TODO: Escape the sql query
              try {
                  $database_handle = $this->getDatabaseHandle();
                  return mysql_query($SqlQuery);
              }
              catch (Exception $exception) {
                  throw $exception;
              }
              // TODO: close connection           
          }          
          
      }
      
?>