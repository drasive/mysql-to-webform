<?php namespace InputFormGenerator\BusinessLogic;
      
      class MySqlDatabaseInputElementBuilder {
          
          // Private methods
          private static function getDatabaseFieldInputElementType($databaseField) {
              if (MySqlDatabaseInputElementBuilder::isDatabaseFieldNumeric($databaseField)) {
                  if ($databaseField->maximumLength == 1 && in_array('unsigned', $databaseField->flags)) {
                      return \InputFormGenerator\BusinessLogic\InputElementTypes::checkbox;
                  }
                  else {
                      return \InputFormGenerator\BusinessLogic\InputElementTypes::number;
                  }
              }
              else {
                  if (in_array('enum', $databaseField->flags)) {
                      if (MySqlDatabaseInputElementBuilder::hasDatabaseFieldPostfix($databaseField, '_r')) {
                          return \InputFormGenerator\BusinessLogic\InputElementTypes::radiobuttons;
                      } else {
                          return \InputFormGenerator\BusinessLogic\InputElementTypes::select;
                      }
                  }
                  else {
                      if (MySqlDatabaseInputElementBuilder::hasDatabaseFieldPostfix($databaseField, '_c')) {
                          return \InputFormGenerator\BusinessLogic\InputElementTypes::color;
                      } else if (MySqlDatabaseInputElementBuilder::hasDatabaseFieldPostfix($databaseField, '_d')) {
                          return \InputFormGenerator\BusinessLogic\InputElementTypes::date;
                      } else if (MySqlDatabaseInputElementBuilder::hasDatabaseFieldPostfix($databaseField, '_dt')) {
                          return \InputFormGenerator\BusinessLogic\InputElementTypes::dateTime;
                      } else if (MySqlDatabaseInputElementBuilder::hasDatabaseFieldPostfix($databaseField, '_dtl')) {
                          return \InputFormGenerator\BusinessLogic\InputElementTypes::dateTimeLocal;
                      } else if (MySqlDatabaseInputElementBuilder::hasDatabaseFieldPostfix($databaseField, '_e')) {
                          return \InputFormGenerator\BusinessLogic\InputElementTypes::email;
                      } else if (MySqlDatabaseInputElementBuilder::hasDatabaseFieldPostfix($databaseField, '_f')) {
                          return \InputFormGenerator\BusinessLogic\InputElementTypes::file;
                      } else if (MySqlDatabaseInputElementBuilder::hasDatabaseFieldPostfix($databaseField, '_m')) {
                          return \InputFormGenerator\BusinessLogic\InputElementTypes::month;
                      } else if (MySqlDatabaseInputElementBuilder::hasDatabaseFieldPostfix($databaseField, '_n')) {
                          return \InputFormGenerator\BusinessLogic\InputElementTypes::number;
                      } else if (MySqlDatabaseInputElementBuilder::hasDatabaseFieldPostfix($databaseField, '_p')) {
                          return \InputFormGenerator\BusinessLogic\InputElementTypes::password;
                      } else if (MySqlDatabaseInputElementBuilder::hasDatabaseFieldPostfix($databaseField, '_r')) {
                          return \InputFormGenerator\BusinessLogic\InputElementTypes::range;
                      } else if (MySqlDatabaseInputElementBuilder::hasDatabaseFieldPostfix($databaseField, '_s')) {
                          return \InputFormGenerator\BusinessLogic\InputElementTypes::search;
                      } else if (MySqlDatabaseInputElementBuilder::hasDatabaseFieldPostfix($databaseField, '_tel')) {
                          return \InputFormGenerator\BusinessLogic\InputElementTypes::telephone;
                      } else if (MySqlDatabaseInputElementBuilder::hasDatabaseFieldPostfix($databaseField, '_t')) {
                          return \InputFormGenerator\BusinessLogic\InputElementTypes::time;
                      } else if (MySqlDatabaseInputElementBuilder::hasDatabaseFieldPostfix($databaseField, '_u')) {
                          return \InputFormGenerator\BusinessLogic\InputElementTypes::url;
                      } else if (MySqlDatabaseInputElementBuilder::hasDatabaseFieldPostfix($databaseField, '_w')) {
                          return \InputFormGenerator\BusinessLogic\InputElementTypes::week;
                      }
                      else {
                          return \InputFormGenerator\BusinessLogic\InputElementTypes::text;
                      }
                  }
              }
          }
          
          private static function isDatabaseFieldNumeric($databaseField) {
              return strtolower($databaseField->type) == "int";
          }

          private static function hasDatabaseFieldPostfix($databaseField, $postfix) {
              return \InputFormGenerator\String::endsWith($databaseField->name, $postfix);
          }
          
          private static function getDatabaseFieldNameWithoutPostfix($databaseField) {
              if (strpos($databaseField->name, '_') == false) {
                  return $databaseField->name;
              }
              
              $lastPosition = 0;
              do {
                  $lastPosition = strpos($databaseField->name, '_', $lastPosition + 1);
              } while (strpos($databaseField->name, '_', $lastPosition + 1) != false);
              
              return substr($databaseField->name, 0, $lastPosition);
          }
          
          // Public methods
          public static function buildInputElements($databaseFields) {
              $inputElements = array();
              
              foreach ($databaseFields as $databaseField) {
                  if (in_array('primary_key', $databaseField->flags) || in_array('multiple_key', $databaseField->flags)) {
                      continue;
                  }

                  // TODO: Handle default value and options
                  $type = MySqlDatabaseInputElementBuilder::getDatabaseFieldInputElementType($databaseField);
                  switch ($type) {
                      case \InputFormGenerator\BusinessLogic\InputElementTypes::radiobuttons:
                          $options = '[OPTIONS]';
                          break;
                      case  \InputFormGenerator\BusinessLogic\InputElementTypes::select:
                          $options = '[OPTIONS]';
                          break;
                      default:
                          $options = null;
                  }

                  array_push($inputElements, new \InputFormGenerator\BusinessLogic\InputElement(MySqlDatabaseInputElementBuilder::getDatabaseFieldNameWithoutPostfix($databaseField),
                                                                                                in_array('not_null', $databaseField->flags),
                                                                                                $databaseField->defaultValue,
                                                                                                $type,
                                                                                                $databaseField->maximumLength,
                                                                                                $options));
              }
              
              return $inputElements;
          }
          
      }
      
?>