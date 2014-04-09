<?php namespace InputFormGenerator\Data;

      require_once('src/Data/DatabaseField.php');
      require_once('src/Data/DatabaseManager.php');

      class MySqlDatabaseReader extends DatabaseManager {

          // Public constructors
          /**
           * Erstellt eine neue Instanz der Klasse MySqlDatabaseReader.
           * @param string $server Der Hostname oder die IP-Adresse des MySQL-Servers für die Datenbank.
           * @param string $database Der Name der Datenbank.
           * @param string $username Der Benutzername für den Zugriff auf die Datenbank.
           * @param string $password Das Password für den Zugriff auf die Datenbank.
           */
          function __construct($server, $database, $username, $password) {
              parent::__construct($server, $database, $username, $password);
              mysql_select_db($this->database, $this->getDatabaseHandle());
          }

          // Private methods
          /**
           * Gibt ein Datenbankhandle zurück.
           */
          private function getDatabaseHandle() {
              return mysql_connect($this->server, $this->username, $this->password);
          }
          
          /**
           * Gibt alle möglichen Eingabewerte für das angegebene ENUM-Feld in der angegebenen Tabelle zurück.
           * @author http://stackoverflow.com/questions/2350052/how-can-i-get-enum-possible-values-in-a-mysql-database
           */
          private function getPossbleEnumValues($table, $fieldname) {
              // TODO: Important
              
              return array("rb1", "b2", "stuff3");
              
              //try {
              //    $result = $this->executeSelect("SHOW COLUMNS 
              //                                    FROM $table
              //                                    WHERE Field = '$field'");
              //    $row = mysql_fetch_row($result);
              //    $type = mysql_field_type($result, 0);
              //    
              //    //$type = $this->executeSelect("SHOW COLUMNS 
              //    //                             FROM $table
              //    //                             WHERE Field = '$field'")->row(0)->Type;                  
              //    preg_match('/^enum\((.*)\)$/', $type, $matches);
              //    foreach( explode(',', $matches[1]) as $value ) {
              //        $enum[] = trim( $value, "'" );
              //    }
              //    
              //    return $enum;
              //}
              //catch (Exception $exception) {
              //    throw $exception;
              //}
          }

          // Public methods
          /**
           * Gibt an, ob mit der festgelegten Datenbank verbunden werden kann.
           */
          public function canConnect() {
              try {
                  return mysql_select_db($this->database, $this->getDatabaseHandle());
              }
              catch (Exception $exception) {
                  return false;
              }
          }
          
          /**
           * Gibt an, ob die angegebene Tabelle in der festgelegten Datenbank existiert.
           * @author http://www.electrictoolbox.com/check-if-mysql-table-exists/php-function/
           */
          public function doesTableExist($table) {
              try {
                  // Überprüfen, ob eine Tabelle mit dem angegebenen Namen existiert
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

          /**
           * Führt den angegebenen Select auf der festgelegten Datenbank aus.
           */
          public function executeSelect($selectStatement) {
              try {
                  return mysql_query($selectStatement, $this->getDatabaseHandle());
              }
              catch (Exception $exception) {
                  throw $exception;
              }
          }

          /**
           * Gibt die Datenbankfelder in der angegebenen Tabelle in der festgelegten Datenbank zurück.
           */
          public function getFields($table) {
              try {
                  $fields = array();
                  
                  // Leere Abfrage mit allen Spalten auf der Datenbank ausführen
                  $result = $this->executeSelect("SELECT *
                                                  FROM $table
                                                  LIMIT 0, 0");

                  for ($fieldIndex = 0; $fieldIndex < mysql_num_fields($result); $fieldIndex++) {
                      // Feldinformationen auslesen
                      $fieldName = mysql_field_name($result, $fieldIndex);
                      $fieldType = mysql_field_type($result, $fieldIndex);
                      $fieldLength = mysql_field_len($result, $fieldIndex);
                      $fieldFlags = explode(' ', mysql_field_flags($result, $fieldIndex));
                      
                      // Falls nötig, die möglichen Eingabewerte des Datenbankfeldes festlegen
                      if (in_array('enum', $fieldFlags)) {
                          $fieldOptions = self::getPossbleEnumValues($table, $fieldName);
                      }
                      else {
                          $fieldOptions = null;
                      }
                      
                      // Neues Datenbankfeld zum Array hinzufügen
                      array_push($fields, new DatabaseField($fieldName,
                                                            $fieldType,
                                                            $fieldLength,
                                                            $fieldFlags,
                                                            $fieldOptions));
                  }

                  return $fields;
              }
              catch (Exception $exception) {
                  throw $exception;
              }
          }

      }

?>