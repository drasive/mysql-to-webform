<?php namespace InputFormGenerator\BusinessLogic;
      
      /**
       * Generiert HTML-Elemente für die Anzeige in einem Webbrowser.
       */
      class HtmlTagGenerator {
          
          // Private methods
          /**
           * Generiert ein Input-Element vom Typ "radio".
           * @return string Das Element.
           */
          private static function generateRadiobutton($value, $name, $required) {
              return "<input value='$value' name='$name' required='$required' type='radio' />";
          }
          
          /**
           * Generiert Option-Elemente.
           * @return string Die Elemente.
           */
          private static function generateOptions($options) {
              // Für jede $option ein Option-Element generieren.
              foreach ($options as $option) {
                  $optionsHtml = $optionsHtml . self::generateOption($option);
              }
              
              return $optionsHtml;
          }
          
          /**
           * Generiert ein Option-Element.
           * @return string Das Element.
           */
          private static function generateOption($value) {
              return "<option value='$value'>$value</option>";
          }
          
          // Public methods       
          /**
           * Generiert den Starttag eines Formulares.
           * @return string Der Starttagt.
           */
          public static function generateFormStart($action, $method) {
              return "<form action='$action' method='$method'>";
          }
          
          
          /**
           * Generiert ein Label-Element.
           * @return string Das Element.
           */
          public static function generateLabel($content, $for) {
              return "<label for='$for'>$content</label>";
          }
          
          /**
           * Generiert ein Input-Element mit variablem typ.
           * @return string Das Element.
           */
          public static function generateInput($name, $required, $type, $maximum_length) {
              return "<input id='$name' name='$name' required='$required' type='$type' maxLength='$maximum_length' />";
          }
          
          /**
           * Generiert ein Textarea-Element.
           * @return string Das Element.
           */
          public static function generateTextarea($name, $required, $maximum_length) {
              return "<textarea id='$name' name='$name' required='$required' maxLength='$maximum_length'></textarea>";
          }
          
          /**
           * Generiert Radiobutton-Elemente.
           * @return string Dstringie Elemente.
           */
          public static function generateRadiobuttons($name, $required, $options) {              
              // Für jede $option einen Radiobutton mit voranstehendem Wert generieren.
              foreach ($options as $option) {                  
                  $radiobuttons .= $option . ":";
                  $radiobuttons .= self::generateRadiobutton($option, $name, $required);
              }
              
              return $radiobuttons;
          }
          
          /**
           * Generiert ein Select-Element.
           * @return string Das Element.
           */
          public static function generateSelect($name, $required, $options) {
              return "<select id='$name' name='$name' required='$required' size='$size'>" . self::generateOptions($options) . "</select>";
          }
          
          /**
           * Generiert ein Input-Element vom Typ "submit".
           * @return string Das Element.
           */
          public static function generateSubmit($title) {
              return "<input type='submit' value='$title' />"; 
          }
          
      }
      
?>