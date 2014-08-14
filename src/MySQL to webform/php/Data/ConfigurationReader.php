<?php namespace InputFormGenerator\Data;

      class ConfigurationReader {
          
          public static function readIniFile($filePath) {
              return parse_ini_file($filePath, true);
          }
          
      }

?>