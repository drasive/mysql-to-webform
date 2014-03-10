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
                  // TODO: Pretty shitty condition
                  if ($inputElement->type < 100) {
                      array_push($HtmlElements, \InputFormGenerator\BusinessLogic\HtmlTagGenerator::generateInput($inputElement->name,$inputElement->required, $inputElement->defaultValue, InputFormGenerator::convertInputElementTypeToHtmlInputType($inputElement->type), $inputElement->maximumLength));
                  }
                  else {
                      switch ($inputElement->type) {
                          case 100:
                              array_push($HtmlElements, \InputFormGenerator\BusinessLogic\HtmlTagGenerator::generateTextarea($inputElement->name,$inputElement->required, $inputElement->defaultValue, $inputElement->maximumLength));
                              break;
                          case 101:
                              array_push($HtmlElements, \InputFormGenerator\BusinessLogic\HtmlTagGenerator::generateRadiobuttons($inputElement->name,$inputElement->required, $inputElement->defaultValue, $inputElement->options));
                              break;
                          case 102:
                              array_push($HtmlElements, \InputFormGenerator\BusinessLogic\HtmlTagGenerator::generateSelect($inputElement->name,$inputElement->required, $inputElement->defaultValue, $inputElement->options));
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
              // TODO: Cceck if table exists

              $mySqlDatabaseReader = new \InputFormGenerator\Data\MySqlDatabaseReader($server, $database, $username, $password);
              if ($mySqlDatabaseReader->canConnectToDatabase()) {
                  echo '<h3>Info</h3>';
                  echo 'Connection succesfull<br /><br />';

                  // ------------------------------------------------------------------------------------------------------------------------

                  $databaseFields = $mySqlDatabaseReader->getFields($table);

                  echo '<h3>Database fields</h3>';
                  echo '<table cellpadding="5">
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Max. Length</th>
                                <th>Flags</th>
                                <th>Default</th>
                            </tr>';
                  foreach ($databaseFields as $databaseField) {
                      echo '<tr>';

                      echo '<td>' . $databaseField->name . '</td>';
                      echo '<td>' . $databaseField->type . '</td>';
                      echo '<td>' . $databaseField->maximumLength . '</td>';
                      echo '<td>' . implode('/ ', $databaseField->flags) . '</td>';
                      echo '<td>' . $databaseField->defaultValue . '</td>';

                      echo '</tr>';
                  }
                  echo '</table>';

                  // ------------------------------------------------------------------------------------------------------------------------

                  $inputElements = \InputFormGenerator\BusinessLogic\MySqlDatabaseInputElementBuilder::buildInputElements($databaseFields);

                  echo '<h3>Input elements</h3>';
                  echo '<table cellpadding="5">
                            <tr>
                                <th>Name</th>
                                <th>Required</th>
                                <th>Default</th>
                                <th>Type</th>
                                <th>Max. Length</th>
                                <th>Options</th>
                            </tr>';
                  foreach ($inputElements as $inputElement) {
                      echo '<tr>';

                      echo '<td>' . $inputElement->name . '</td>';
                      echo '<td>' . $inputElement->required . '</td>';
                      echo '<td>' . $inputElement->defaultValue . '</td>';
                      echo '<td>' . $inputElement->type . '</td>';
                      echo '<td>' . $inputElement->maximumLength . '</td>';
                      echo '<td>' . $inputElement->options . '</td>';

                      echo '</tr>';
                  }
                  echo '</table>';

                  // ------------------------------------------------------------------------------------------------------------------------
                  // Make this to a method (in this class) called ~"generateInputElements"

                  $HtmlElements = InputFormGenerator::generateHtmlElements($inputElements);

                  echo '<h3>HTMl input elements</h3>';
                  echo '<table cellpadding="5">';
                  foreach ($HtmlElements as $htmlElement) {
                      echo "<tr><td>$htmlElement</tr></td>";
                  }
                  echo '</table>';



                  //$form = $htmlTagGenerator->generateFormStart('', 'post');
              }
              else {
                  echo 'Connection failed<br />';
              }
          }

      }

?>