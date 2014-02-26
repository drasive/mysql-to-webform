<?php namespace FormGenerator\Data;
      abstract class DatabaseManager {
          
          // Private variables
          private $server = "127.0.0.1";
          private $database = "test";
          private $user_name = "root";
          private $password = "";

          // Public properties
          public function __get($property) {
              if (property_exists($this, $property)) {
                  return $this->$property;
              }
          }
          
          // Public constructors
          function __construct($server, $database, $user_name, $password) {
              $this->server = $server;
              $this->database = $database;
              $this->user_name = $user_name;
              $this->password = $password;
          }
          
      }
?>