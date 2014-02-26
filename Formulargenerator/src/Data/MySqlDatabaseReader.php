<?php namespace FormGenerator\Data;
      class MySqlDatabaseReader extends DatabaseManager implements iDatabaseReader {
          
          // Private variables
          private $database_handle;
          private $does_database_exist;

          // Public properties
          public function getDoesDatabaseExist() {
              return $does_database_exist;
          }
          
          // Public constructors
          function __construct($server, $database, $user_name, $password) {
              parent::__construct($server, $database, $user_name, $password);
              
              $database_handle = mysql_connect($server, $user_name, $password);
              $does_database_exist = mysql_select_db($database, $db_handle);
          }
          
          // Public methods
          public function select ($SqlStatement) {
              return mysql_query($SqlStatement);
          }
          
          // Public methods
          function __destruct() {
              mysql_close($database_handle);
          }          
          
      }
?>