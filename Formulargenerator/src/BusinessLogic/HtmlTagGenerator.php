<?php namespace InputFormGenerator\BusinessLogic;
      
      /**
       * Generiert HTML-Elemente für die Anzeige in einem Webbrowser.
       */
      class HtmlTagGenerator {
          
          // Private methods
          /**
           * Generiert ein Required-Attribut oder einen leeren String, abhängig vom angegebenen "required" Parameter.
           * @param string Das generierte Required-Attribut oder ein leerer String. 
           */
          private static function generateRequiredAttribute($required) {
              if ($required) {
                  return "required";
              }
              
              return "";
          }
          
          /**
           * Generiert ein Input-Element vom Typ "radio".
           * @return string Das Element.
           */
          private static function generateRadiobutton($value, $name, $required) {
              $requiredAttribute = self::generateRequiredAttribute($required);
              return "<input value='$value' name='$name' $requiredAttribute type='radio' />";
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
          
          /**
           * Generiert ein Option-Element ohne Wert.
           * @return string Das Element.
           */
          private static function generateOptionEmpty() {
              return "<option value=''>- Bitte Auswaehlen -</option>";
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
          public static function generateLabel($content) {
              return "<label>$content</label>";
          }
          
          /**
           * Generiert ein Label-Element.
           * @return string Das Element.
           */
          public static function generateLabelFor($content, $for) {
              return "<label for='$for'>$content</label>";
          }
          
          /**
           * Generiert ein Input-Element mit variablem typ.
           * @return string Das Element.
           */
          public static function generateInput($name, $required, $type, $maximum_length) {
              // Required-Attribut generieren, falls unterstützt
              $requiredAttribute = "";
              if ($type == 'text' or 
                  $type == 'search' or 
                  $type == 'url' or 
                  $type == 'tel' or 
                  $type == 'email' or 
                  $type == 'password' or
                  $type == 'datetime' or
                  $type == 'date' or
                  $type == 'month' or
                  $type == 'week' or
                  $type == 'time' or
                  $type == 'datetime-local' or
                  $type == 'number') {
                  $requiredAttribute = self::generateRequiredAttribute($required);
              }
              
              // MaxLength-Attribut generieren, falls unterstützt
              $maxLenghtAttribute = "";
              if ($type == 'email' or 
                  $type == 'password' or 
                  $type == 'search' or 
                  $type == 'tel' or 
                  $type == 'text' or 
                  $type == 'url') {
                  $maxLenghtAttribute = "maxLength='$maximum_length'";
              }
              
              return "<input id='$name' name='$name' $requiredAttribute type='$type' $maxLenghtAttribute />";
          }
          
          /**
           * Generiert ein Textarea-Element.
           * @return string Das Element.
           */
          public static function generateTextarea($name, $required, $maximum_length) {
              $requiredAttribute = self::generateRequiredAttribute($required);
              return "<textarea id='$name' name='$name' $requiredAttribute maxLength='$maximum_length' rows='5' cols='25'></textarea>";
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
              // Starttag generieren
              $requiredAttribute = self::generateRequiredAttribute($required);
              $starttag = "<select id='$name' name='$name' $requiredAttribute>";
              
              // Optionen generieren
              $optionsHTML = "";
              if ($required) {
                  $optionsHTML .= self::generateOptionEmpty();
              }
              $optionsHTML .= self::generateOptions($options);
              
              return $starttag . $optionsHTML . "</select>";
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