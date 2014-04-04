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
          
          /**
           * @author http://stackoverflow.com/questions/2350052/how-can-i-get-enum-possible-values-in-a-mysql-database
           */
          private function getPossbleEnumValues($table, $fieldname) {
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

          public function executeSelect($selectStatement) {
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
                      $fieldName = mysql_field_name($result, $fieldIndex);
                      $fieldType = mysql_field_type($result, $fieldIndex);
                      $fieldLength = mysql_field_len($result, $fieldIndex);
                      $fieldFlags = explode(' ', mysql_field_flags($result, $fieldIndex));
                      if (in_array('enum', $fieldFlags)) {
                          $fieldOptions = self::getPossbleEnumValues($table, $fieldName);
                      }
                      else {
                          $fieldOptions = null;
                      }
                      
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