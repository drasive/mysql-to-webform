<?php namespace InputFormGenerator\UserInterface;
      
      abstract class HtmlParameterValidator {
          
          // Public methods
          public static function escape($htmlParameter) {
              return htmlspecialchars($htmlParameter);
          }

          public static function hasValue($httpParameter) {
              if (!isset($httpParameter)) {
                  return false;
              }
              
              $httpParameter = trim($httpParameter);
              return !empty($httpParameter);
          }
          
      }
      
?>