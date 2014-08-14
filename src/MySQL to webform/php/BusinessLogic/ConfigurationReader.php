<?php namespace InputFormGenerator\BusinessLogic;

      require_once('php/Data/ConfigurationReader.php');
      
      /**
       * Provides functionality to read the application configuration.
       */
      class ConfigurationReader {
          
          // Variables
          protected static $m_configurationFile = 'application.ini';
          
          protected static $m_sectionRelease = 'release';
          protected static $m_debugMode = 'debugMode';
          
          // Release section
          /**
           * Gets the defined debug mode.
           * @return bool The defined debug mode.
           */
          public static function getDebugMode() { 
              return \InputFormGenerator\Data\ConfigurationReader::readIniFile(self::$m_configurationFile)[self::$m_sectionRelease][self::$m_debugMode];
          }
          
      }

?>