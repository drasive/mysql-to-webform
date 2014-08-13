<?php namespace InputFormGenerator\UserInterface;
      
      /**
       * Stellt Methoden bereit, um HTTP Parameter zu validieren.
       */
      abstract class HttpParameterValidator {
          
          // Public methods
          /**
           * Gibt den angegebenen HTTP Parameter escapt zurück.
           * @return string Den escapten HTTP Parameter.
           */
          public static function escape($httpParameter) {
              return htmlspecialchars($httpParameter);
          }

          /**
           * Gibt an, ob der angegebene HTTP Parameter einen Wert besitzt welcher nicht nur aus Leerzeichen besteht.
           * @return bool True, wenn der angegebene HTTP Parameter einen Wert besitzt welcher nicht nur aus Leerzeichen besteht.
           */
          public static function hasValue($httpParameter) {
              if (!isset($httpParameter)) {
                  return false;
              }
              
              $httpParameter = trim($httpParameter);
              return !empty($httpParameter);
          }
          
      }
      
?>