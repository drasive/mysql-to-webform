<?php namespace FormGenerator\BusinessLogic;
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
          public static function generateInput($name, $required, $type, $default_value, $maximum_length, $minimum_value, $maximum_value) {
              $type = "radio, text, checkbox, password, date, number, email, datetime, color, hidden, month";
          }
          
          public static function generateTextarea($name, $required, $maximum_length, $rows, $columns, $placeholder) {
              return "<textarea name='$name' required='$required' maxLength='$maximum_length' rows='$rows' cols='$columns' placeholder='$placeholder'></textarea>";
          }
          
          public static function generateSelect($name, $required, $size, $options) {
              return "<select name='$name' required='$required' size='$size'>" + generateOptions($options) + "</select>";
          }
          
      }
?>