<?php namespace DimitriVranken\MySQL_to_webform\Data;

      class ConfigurationReader {
          
          public static function readIniFile($filePath) {
              return parse_ini_file($filePath, true);
          }
          
      }

?>