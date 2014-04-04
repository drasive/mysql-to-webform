<?php namespace InputFormGenerator\BusinessLogic;
      
      class HtmlTagGenerator {
          
          // Private methods
          private static function generateRadiobutton($value, $name, $required) {
              return "<input value='$value' name='$name' required='$required' type='radio' />";
          }
          
          private static function generateOptions($options) {
              foreach ($options as $option) {
                  $optionsHtml = $optionsHtml . self::generateOption($option);
              }
              
              return $optionsHtml;
          }
          
          private static function generateOption($value) {
              return "<option value='$value'>$value</option>";
          }
          
          // Public methods          
          public static function generateFormStart($action, $method) {
              return "<form action='$action' method='$method'>";
          }
          
          public static function generateLabel($content, $for) {
              return "<label for='$for'>$content</label>";
          }
          
          public static function generateInput($name, $required, $type, $maximum_length) {
              return "<input id='$name' name='$name' required='$required' type='$type' maxLength='$maximum_length' />";
          }
          
          public static function generateTextarea($name, $required, $maximum_length) {
              return "<textarea id='$name' name='$name' required='$required' maxLength='$maximum_length'></textarea>";
          }
          
          public static function generateRadiobuttons($name, $required, $options) {
              foreach ($options as $option) {
                  $radiobuttons .= self::generateRadiobutton($option, $name, $required);
              }
              
              return $radiobuttons;
          }
          
          public static function generateSelect($name, $required, $options) {
              return "<select id='$name' name='$name' required='$required' size='$size'>" . self::generateOptions($options) . "</select>";
          }
          
          public static function generateSubmit($title) {
              return "<input type='submit' value='$title' />"; 
          }
          
      }
      
?>