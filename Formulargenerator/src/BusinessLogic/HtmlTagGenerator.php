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
          
          public static function generateLabel($content, $for) {
              return "<label for='$for'>$content</label>";
          }
          
          public static function generateInput($name, $required, $type, $maximum_length) {
              return "<input name='$name' required='$required' type='$type' maxLength='$maximum_length' />";
          }
          
          public static function generateTextarea($name, $required, $maximum_length) {
              return "<textarea name='$name' required='$required' maxLength='$maximum_length'></textarea>";
          }
          
          public static function generateRadiobuttons($name, $required, $maximum_length) {
              // TODO: Implement
              return "placeholder";
          }
          
          public static function generateSelect($name, $required, $options) {
              // TODO: options
              return "<select name='$name' required='$required' size='$size'>" + self::generateOptions($options) + "</select>";
          }
          
          public static function generateSubmit($title) {
              return "<input type='submit' value='$title' />"; 
          }
          
      }
      
?>