<?php namespace InputFormGenerator\Data;

      /**
       * Stellt Nethoden bereit, um mit einer Datenbank zu arbeiten.
       */
      abstract class DatabaseManager {

          // Private variables
          /**
           * Der Hostname oder die IP-Adresse des MySQL-Servers für die Datenbank.
           */
          private $server;
          
          /**
           * Der Name der Datenbank.
           */
          private $database;
          
          /**
           * Der Benutzername für den Zugriff auf die Datenbank.
           */
          private $username;
          
          /**
           * Das Password für den Zugriff auf die Datenbank.
           */
          private $password;

          // Public properties
          public function __get($property) {
              if (property_exists($this, $property)) {
                  return $this->$property;
              }
          }

          // Public constructors
          /**
           * Erstellt eine neue Instanz der Klasse DatabaseManager.
           * @param string $server Der Hostname oder die IP-Adresse des MySQL-Servers für die Datenbank.
           * @param string $database Der Name der Datenbank.
           * @param string $username Der Benutzername für den Zugriff auf die Datenbank.
           * @param string $password Das Password für den Zugriff auf die Datenbank.
           */
          function __construct($server, $database, $username, $password) {
              $this->server = $server;
              $this->database = $database;
              $this->username = $username;
              $this->password = $password;
          }

          // Public methods
          /**
           * Gibt an, ob mit der festgelegten Datenbank verbunden werden kann.
           */
          public abstract function canConnect();
          
          /**
           * Gibt an, ob die angegebene Tabelle in der festgelegten Datenbank existiert.
           */
          public abstract function doesTableExist($table);

          /**
           * Führt den angegebenen Select auf der festgelegten Datenbank aus.
           */
          public abstract function executeSelect($selectStatement);

          /**
           * Gibt die Datenbankfelder in der angegebenen Tabelle in der festgelegten Datenbank zurück.
           */
          public abstract function getFields($table);

      }

?>