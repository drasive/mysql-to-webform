<?php namespace InputFormGenerator\BusinessLogic;

      require_once('src\String.php');
      require_once('src\Data\MySqlDatabaseReader.php');
      require_once('src\BusinessLogic\InputElementTypes.php');
      require_once('src\BusinessLogic\InputElement.php');
      require_once('src\BusinessLogic\MySqlDatabaseInputElementBuilder.php');
      require_once('src\BusinessLogic\HtmlTagGenerator.php');

      class InputFormGenerator {

          // Private methods
          private static function generateHtmlElements($inputElements) {
              $HtmlElements = array();

              foreach ($inputElements as $inputElement) {
                  if ($inputElement->type < 100) {
                      array_push($HtmlElements, \InputFormGenerator\BusinessLogic\HtmlTagGenerator::generateInput($inputElement->name,$inputElement->required, InputFormGenerator::convertInputElementTypeToHtmlInputType($inputElement->type), $inputElement->maximumLength));
                  }
                  else {
                      switch ($inputElement->type) {
                          case 100:
                              array_push($HtmlElements, \InputFormGenerator\BusinessLogic\HtmlTagGenerator::generateTextarea($inputElement->name,$inputElement->required, $inputElement->maximumLength));
                              break;
                          case 101:
                              array_push($HtmlElements, \InputFormGenerator\BusinessLogic\HtmlTagGenerator::generateRadiobuttons($inputElement->name,$inputElement->required, $inputElement->options));
                              break;
                          case 102:
                              array_push($HtmlElements, \InputFormGenerator\BusinessLogic\HtmlTagGenerator::generateSelect($inputElement->name,$inputElement->required, $inputElement->options));
                              break;
                          default:
                          // TODO: handle this bs
                      }
                  }
              }

              return $HtmlElements;
          }

          private static function convertInputElementTypeToHtmlInputType($inputElementType) {
              switch ($inputElementType) {
                  case InputElementTypes::checkbox:
                      return 'checkbox';
                      break;
                  case InputElementTypes::color:
                      return 'color';
                      break;
                  case InputElementTypes::date:
                      return 'date';
                      break;
                  case InputElementTypes::dateTime:
                      return 'datetime';
                      break;
                  case InputElementTypes::dateTimeLocal:
                      return 'datetime-local';
                      break;
                  case InputElementTypes::email:
                      return 'email';
                      break;
                  case InputElementTypes::file:
                      return 'file';
                      break;
                  case InputElementTypes::month:
                      return 'month';
                      break;
                  case InputElementTypes::number:
                      return 'number';
                      break;
                  case InputElementTypes::password:
                      return 'password';
                      break;
                  case InputElementTypes::range:
                      return 'range';
                      break;
                  case InputElementTypes::search:
                      return 'search';
                      break;
                  case InputElementTypes::telephone:
                      return 'tel';
                      break;
                  case InputElementTypes::text:
                      return 'text';
                      break;
                  case InputElementTypes::time:
                      return 'time';
                      break;
                  case InputElementTypes::url:
                      return 'url';
                      break;
                  case InputElementTypes::week:
                      return 'week';
                      break;
                  default:
                  // TODO: do something
              }
          }

          // Public methods
          public static function generateInputForm($name, $server, $database, $table, $username, $password) {
              $debug = false;
              // TODO: check table existance and stuff
              
              $mySqlDatabaseReader = new \InputFormGenerator\Data\MySqlDatabaseReader($server, $database, $username, $password);
              if ($mySqlDatabaseReader->canConnect()) {
                  $databaseFields = $mySqlDatabaseReader->getFields($table);

                  if ($debug) {
                      echo '<h3>Database fields</h3>';
                      echo '<table cellpadding="5">
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Max. Length</th>
                                <th>Flags</th>
                            </tr>';
                      foreach ($databaseFields as $databaseField) {
                          echo '<tr>';

                          echo '<td>' . $databaseField->name . '</td>';
                          echo '<td>' . $databaseField->type . '</td>';
                          echo '<td>' . $databaseField->maximumLength . '</td>';
                          echo '<td>' . implode('/ ', $databaseField->flags) . '</td>';

                          echo '</tr>';
                      }
                      echo '</table>';
                  }

                  // ------------------------------------------------------------------------------------------------------------------------

                  $inputElements = \InputFormGenerator\BusinessLogic\MySqlDatabaseInputElementBuilder::buildInputElements($databaseFields);

                  if ($debug) {
                      echo '<h3>Input elements</h3>';
                      echo '<table cellpadding="5">
                            <tr>
                                <th>Name</th>
                                <th>Required</th>
                                <th>Type</th>
                                <th>Max. Length</th>
                                <th>Options</th>
                            </tr>';
                      foreach ($inputElements as $inputElement) {
                          echo '<tr>';

                          echo '<td>' . $inputElement->name . '</td>';
                          echo '<td>' . $inputElement->required . '</td>';
                          echo '<td>' . $inputElement->type . '</td>';
                          echo '<td>' . $inputElement->maximumLength . '</td>';
                          echo '<td>' . $inputElement->options . '</td>';

                          echo '</tr>';
                      }
                      echo '</table>';
                  }
                  
                  // ------------------------------------------------------------------------------------------------------------------------

                  $htmlElements = self::generateHtmlElements($inputElements);

                  // ------------------------------------------------------------------------------------------------------------------------
                  $inputForm = "<h1>$name</h1>";
                  $inputForm = $inputForm . HtmlTagGenerator::generateFormStart('', 'post');
                  $inputForm = $inputForm . '<table cellpadding="5">';
                  for ($inputFormIndex = 0; $inputFormIndex < sizeof($htmlElements); $inputFormIndex++) {
                      $currentInputElement = $inputElements[$inputFormIndex];
                      $currentHtmlElement = $htmlElements[$inputFormIndex];
                      
                      $inputForm = $inputForm . '<tr>
                                                    <td>' . HtmlTagGenerator::generateLabel($currentInputElement->name . ':', '[PH]') . '</td>
                                                    <td>' . $currentHtmlElement . '</td>
                                                </tr>';
                  }
                  $inputForm = $inputForm . '</table>';
                  $inputForm = $inputForm . HtmlTagGenerator::generateSubmit('Abschicken');
                  $inputForm = $inputForm . '</form>';
                  return $inputForm;
              }
              else {
                  echo 'Connection failed<br />';
              }
          }

      }

?>