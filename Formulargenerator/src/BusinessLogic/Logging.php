<?php namespace InputFormGenerator\BusinessLogic;
      
      class Logging {
          
          // Public methods          
          public static function logError($error) {
              error_log($error, 1, 'dimitri.vranken@hotmail.ch');
          }
          
      }
      
?>