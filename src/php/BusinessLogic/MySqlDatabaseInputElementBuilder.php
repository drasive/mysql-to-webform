<?php namespace DimitriVranken\MySQL_to_webform\BusinessLogic;
      
      /**
       * Generiert Eingabeelemente (InputElement) aus den Datenbankfeldern einer MySQL Tabelle.
       */
      class MySqlDatabaseInputElementBuilder {
          
          // Private methods
          /**
           * Bestimmt den Typen des Eingabeelementes, der für das angegebene Datenbankfeld am passendsten ist.
           * @return InputElementTypes Der passendste Eingabeelementtyp für das angegebene Datenbankfeld.
           */
          private static function getDatabaseFieldInputElementType($databaseField) {
              if (self::isDatabaseFieldNumeric($databaseField)) { // Das Datenbankfeld ist numerisch
                  if ($databaseField->maximumLength == 1 && in_array('unsigned', $databaseField->flags)) { // Der Datentyp "Bit"
                      return \DimitriVranken\MySQL_to_webform\BusinessLogic\InputElementTypes::checkbox;
                  }
                  else {
                      return \DimitriVranken\MySQL_to_webform\BusinessLogic\InputElementTypes::number;
                  }
              }
              else { // Das Datenbankfeld ist nicht numerisch
                  if (in_array('enum', $databaseField->flags)) {
                      if (self::hasDatabaseFieldPostfix($databaseField, '_r')) {
                          return \DimitriVranken\MySQL_to_webform\BusinessLogic\InputElementTypes::radiobuttons;
                      } else {
                          return \DimitriVranken\MySQL_to_webform\BusinessLogic\InputElementTypes::select;
                      }
                  }
                  else {
                      // http://www.reddit.com/r/Eyebleach/
                      if (self::hasDatabaseFieldPostfix($databaseField, '_c')) {
                          return \DimitriVranken\MySQL_to_webform\BusinessLogic\InputElementTypes::color;
                      } else if (self::hasDatabaseFieldPostfix($databaseField, '_d')) {
                          return \DimitriVranken\MySQL_to_webform\BusinessLogic\InputElementTypes::date;
                      } else if (self::hasDatabaseFieldPostfix($databaseField, '_dt')) {
                          return \DimitriVranken\MySQL_to_webform\BusinessLogic\InputElementTypes::dateTime;
                      } else if (self::hasDatabaseFieldPostfix($databaseField, '_dtl')) {
                          return \DimitriVranken\MySQL_to_webform\BusinessLogic\InputElementTypes::dateTimeLocal;
                      } else if (self::hasDatabaseFieldPostfix($databaseField, '_e')) {
                          return \DimitriVranken\MySQL_to_webform\BusinessLogic\InputElementTypes::email;
                      } else if (self::hasDatabaseFieldPostfix($databaseField, '_f')) {
                          return \DimitriVranken\MySQL_to_webform\BusinessLogic\InputElementTypes::file;
                      } else if (self::hasDatabaseFieldPostfix($databaseField, '_m')) {
                          return \DimitriVranken\MySQL_to_webform\BusinessLogic\InputElementTypes::month;
                      } else if (self::hasDatabaseFieldPostfix($databaseField, '_n')) {
                          return \DimitriVranken\MySQL_to_webform\BusinessLogic\InputElementTypes::number;
                      } else if (self::hasDatabaseFieldPostfix($databaseField, '_p')) {
                          return \DimitriVranken\MySQL_to_webform\BusinessLogic\InputElementTypes::password;
                      } else if (self::hasDatabaseFieldPostfix($databaseField, '_r')) {
                          return \DimitriVranken\MySQL_to_webform\BusinessLogic\InputElementTypes::range;
                      } else if (self::hasDatabaseFieldPostfix($databaseField, '_s')) {
                          return \DimitriVranken\MySQL_to_webform\BusinessLogic\InputElementTypes::search;
                      } else if (self::hasDatabaseFieldPostfix($databaseField, '_tel')) {
                          return \DimitriVranken\MySQL_to_webform\BusinessLogic\InputElementTypes::telephone;
                      } else if (self::hasDatabaseFieldPostfix($databaseField, '_t')) {
                          return \DimitriVranken\MySQL_to_webform\BusinessLogic\InputElementTypes::time;
                      } else if (self::hasDatabaseFieldPostfix($databaseField, '_u')) {
                          return \DimitriVranken\MySQL_to_webform\BusinessLogic\InputElementTypes::url;
                      } else if (self::hasDatabaseFieldPostfix($databaseField, '_w')) {
                          return \DimitriVranken\MySQL_to_webform\BusinessLogic\InputElementTypes::week;
                      } else if (self::hasDatabaseFieldPostfix($databaseField, '_ta')) {
                          return \DimitriVranken\MySQL_to_webform\BusinessLogic\InputElementTypes::textarea;
                      }
                      else {
                          return \DimitriVranken\MySQL_to_webform\BusinessLogic\InputElementTypes::text;
                      }
                  }
              }
          }
          
          /**
           * Gibt an, ob der Typ des angegebenen Datenbankfeldes numerisch ist oder nicht.
           * @return bool True, wenn der Typ des angegebenen Datenbankfeldes numerisch ist.
           */
          private static function isDatabaseFieldNumeric($databaseField) {
              return strtolower($databaseField->type) == "int";
          }

          /**
           * Gibt an, ob der Name des angegebenen Datenbankfeldes mit der angegebenen Zeichenfolge endet oder nicht.
           * @return bool True, wenn der Name des angegebenen Datenbankfeldes mit der angegebenen Zeichenfolge endet.
           */
          private static function hasDatabaseFieldPostfix($databaseField, $postfix) {
              return \DimitriVranken\MySQL_to_webform\String::endsWith($databaseField->name, $postfix);
          }
          
          /**
           * Gibt den Namen des angegebenen Datenbankfeldes ohne einen möglicherweise vorhandenen Postfix zurück.
           * @return string Der Name des angegebenen Datenbankfeldes ohne einen Postfix.
           */
          private static function getDatabaseFieldNameWithoutPostfix($databaseField) {
              // Wenn kein Postfix vorhanden, dann ganzen Namen zurückgeben
              if (strpos($databaseField->name, '_') == false) {
                  return $databaseField->name;
              }
              
              // Letztes "_" im Namen suchen und den Teil davor zurückgeben.
              $lastPosition = 0;
              do {
                  $lastPosition = strpos($databaseField->name, '_', $lastPosition + 1);
              } while (strpos($databaseField->name, '_', $lastPosition + 1) != false);
              
              return substr($databaseField->name, 0, $lastPosition);
          }
          
          // Public methods
          /**
           * Generiert Eingabeelemente aus den angegebenen MySQL Datenbankfeldern.
           * @return InputElement[] Die generierten Eingabeelemente.
           */
          public static function buildInputElements($databaseFields) {
              $inputElements = array();
              
              foreach ($databaseFields as $databaseField) {
                  // Spezielle Keys auslassen
                  if (in_array('primary_key', $databaseField->flags) || in_array('multiple_key', $databaseField->flags)) {
                      continue;
                  }

                  $type = self::getDatabaseFieldInputElementType($databaseField);
                  // Falls nötig, die möglichen Eingabewerte des Eingabeelementes festlegen
                  $options = null;
                  switch ($type) {
                      case \DimitriVranken\MySQL_to_webform\BusinessLogic\InputElementTypes::radiobuttons:
                          $options = $databaseField->options;
                          break;
                      case  \DimitriVranken\MySQL_to_webform\BusinessLogic\InputElementTypes::select:
                          $options = $databaseField->options;
                          break;
                  }

                  // Neues Eingabeelement zum Array hinzufügen
                  array_push($inputElements, new \DimitriVranken\MySQL_to_webform\BusinessLogic\InputElement(self::getDatabaseFieldNameWithoutPostfix($databaseField),
                                                                                                in_array('not_null', $databaseField->flags),
                                                                                                $type,
                                                                                                $databaseField->maximumLength,
                                                                                                $options));
              }
              
              return $inputElements;
          }
          
      }
      
?>