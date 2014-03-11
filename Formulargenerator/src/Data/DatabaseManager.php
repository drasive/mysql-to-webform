<?php namespace InputFormGenerator\Data;

      abstract class DatabaseManager {

          // Private variables
          private $server;
          private $database;
          private $username;
          private $password;

          // Public properties
          public function __get($property) {
              if (property_exists($this, $property)) {
                  return $this->$property;
              }
          }

          // Public constructors
          function __construct($server, $database, $username, $password) {
              $this->server = $server;
              $this->database = $database;
              $this->username = $username;
              $this->password = $password;
          }

          // Public methods
          public abstract function canConnect();
          
          public abstract function doesTableExist($table);

          public abstract function executeSelect($selectStatement);

          public abstract function getFields($table);

      }

?>