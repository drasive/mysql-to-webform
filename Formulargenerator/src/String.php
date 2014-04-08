<?php namespace InputFormGenerator;
      
      /**
       * Stellt Methoden bereit, um mit Strings zu arbeiten.
       * @author http://stackoverflow.com/questions/834303/php-startswith-and-endswith-functions
       */
      class String {
          
          public static function startsWith($haystack, $needle) {
              return $needle === "" || strpos($haystack, $needle) === 0;
          }

          public static function endsWith($haystack, $needle) {
              return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
          }

      }
      
?>