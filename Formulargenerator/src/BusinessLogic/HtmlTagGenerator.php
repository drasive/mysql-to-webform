<?php namespace InputFormGenerator\BusinessLogic;
      
      class HtmlTagGenerator {
          
          // Stuff
          private static function generateOptions($options) {
              foreach ($options as &$option) {
                  $optionsHtml += generateOption($option);
              }
              return $optionsHtml;
          }
          
          private static function generateOption($value, $name) {
              return "<option value='$value'>$name</option>";
          }
          
          // Public methods
          public static function generateFormStart($action, $method) {
              return "<form action='$action' method='$method'>";
          }
          
          public static function generateInput($name, $required, $default_value, $type, $maximum_length) {
              return "<input name='$name' required='$required' type='$type' maxLength='$maximum_length' />";
          }
          
          public static function generateTextarea($name, $required, $default_value, $maximum_length) {
              return "<textarea name='$name' required='$required' maxLength='$maximum_length'></textarea>";
          }
          
          public static function generateRadiobuttons($name, $required, $default_value, $maximum_length) {
              // TODO: Implement
              return "placeholder";
          }
          
          public static function generateSelect($name, $required, $default_value, $options) {
              // TODO: default_value, options
              return "<select name='$name' required='$required' size='$size'>" + HtmlTagGenerator::generateOptions($options) + "</select>";
          }
          
      }
      
?>