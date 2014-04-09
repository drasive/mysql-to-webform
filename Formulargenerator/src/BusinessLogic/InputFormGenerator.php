<?php namespace InputFormGenerator\BusinessLogic;

      require_once('src\String.php');
      require_once('src\Data\MySqlDatabaseReader.php');
      require_once('src\BusinessLogic\InputElementTypes.php');
      require_once('src\BusinessLogic\InputElement.php');
      require_once('src\BusinessLogic\MySqlDatabaseInputElementBuilder.php');
      require_once('src\BusinessLogic\HtmlTagGenerator.php');

      /**
       * Generiert HTML Eingabeformen aufgrund der Felder in einer MySQL Datenbanktabelle.
       */
      class InputFormGenerator {

          // Private methods
          /**
           * Generiert ein passendes HTML-Element für das angegebene Eingabeelement.
           * @return string Das HTML-Element.
           */
          private static function generateHtmlElements($inputElements) {
              $HtmlElements = array();

              foreach ($inputElements as $inputElement) {
                  if ($inputElement->type < 100) { // Das Element wird zu einem Input HTML-Element
                      array_push($HtmlElements, \InputFormGenerator\BusinessLogic\HtmlTagGenerator::generateInput($inputElement->name,$inputElement->required, InputFormGenerator::convertInputElementTypeToHtmlInputType($inputElement->type), $inputElement->maximumLength));
                  }
                  else { // Das Element wird nicht zu einem Input HTML-Element
                      switch ($inputElement->type) {
                          case 100: // Textarea HTML-Element
                              array_push($HtmlElements, \InputFormGenerator\BusinessLogic\HtmlTagGenerator::generateTextarea($inputElement->name,$inputElement->required, $inputElement->maximumLength));
                              break;
                          case 101: // Radiobutton HTML-Element
                              array_push($HtmlElements, \InputFormGenerator\BusinessLogic\HtmlTagGenerator::generateRadiobuttons($inputElement->name, $inputElement->required, $inputElement->options));
                              break;
                          case 102: // Select HTML-Element
                              array_push($HtmlElements, \InputFormGenerator\BusinessLogic\HtmlTagGenerator::generateSelect($inputElement->name,$inputElement->required, $inputElement->options));
                              break;
                      }
                  }
              }

              return $HtmlElements;
          }

          /**
           * Gibt den passenden HTML Input-Type für den angegebenen InputElementType zurück.
           * @return string Der passende HTML Input-Typ.
           */
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
              }
          }

          // Public methods
          /**
           * Generiert eine HTML Eingabeform aus den Feldern der angegebenen MySQL Datenbanktabelle.
           * @param string $name Der Name des Formulares.
           * @param string $server Der Hostname oder die IP-Adresse des MySQL-Servers.
           * @param string $database Der Name der Datenbank, die die angegebene Tabelle enthält.
           * @param string $table Die Datenbanktabelle, für die das Eingabeformular generiert werden soll.
           * @param string $username Der Benutzername für den Zugriff auf die angegebene Datenbanktabelle.
           * @param string $password Das Password für den Zugriff auf die angegebene Datenbanktabelle.
           * @return string Das Eingabeformular.
           */
          public static function generateInputForm($name, $server, $database, $table, $username, $password) {
              // TODO: Debug flag
              $debug = false;
              
              $mySqlDatabaseReader = new \InputFormGenerator\Data\MySqlDatabaseReader($server, $database, $username, $password);
              if ($mySqlDatabaseReader->canConnect()) { // Die Verbindung zur angegebenen Datenbank kann hergestellt werden
                  // Datenbankfelder auslesen
                  $databaseFields = $mySqlDatabaseReader->getFields($table);

                  // Ausgelesene Datenbankfelder ausgeben
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

                  // Eingabeelemente aus ausgelesenen Datenbankfeldern generieren
                  $inputElements = \InputFormGenerator\BusinessLogic\MySqlDatabaseInputElementBuilder::buildInputElements($databaseFields);

                  // Generierte Eingabeelemente ausgeben
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
                          echo '<td>' . implode(', ', $inputElement->options) . '</td>';

                          echo '</tr>';
                      }
                      echo '</table>';
                  }
                  
                  // ------------------------------------------------------------------------------------------------------------------------

                  // HTML-Elemente aus generierten Eingabeelementen generieren
                  $htmlElements = self::generateHtmlElements($inputElements);

                  // ------------------------------------------------------------------------------------------------------------------------
                  // Beginn des Formulares generieren
                  $inputForm .= HtmlTagGenerator::generateFormStart('generate_input_form.php', 'post');
                  // TODO: table cellpadding="5"
                  $inputForm .= '<table cellpadding="5">';
                  
                  // HTML-Elemente in Tabellenzeilen ausgeben
                  for ($inputFormIndex = 0; $inputFormIndex < sizeof($htmlElements); $inputFormIndex++) {
                      $currentInputElement = $inputElements[$inputFormIndex];
                      $currentHtmlElement = $htmlElements[$inputFormIndex];
                      
                      // TODO: td valign="top"
                      $inputForm .= '<tr>
                                         <td valign="top">';
                      // Passendes Label anfügen
                      if (!$currentInputElement->type == InputElementTypes::radiobuttons) {
                          $inputForm .= HtmlTagGenerator::generateLabelFor($currentInputElement->name . ':', $currentInputElement->name);   
                      }
                      else {
                          $inputForm .= HtmlTagGenerator::generateLabel($currentInputElement->name . ':');   
                      }
                      // HTML-Element anfügen
                      $inputForm .= '    </td>
                                         <td valign="top">' . $currentHtmlElement . '</td>
                                     </tr>';                           
                  }
                  $inputForm .= '</table>
                                 <br/>';
                  
                  // Endes des Formulares generieren
                  $inputForm .= HtmlTagGenerator::generateSubmit('Abschicken');
                  $inputForm .= '</form>';
                  
                  return $inputForm;
              }
              else {
                  echo 'Connection failed<br />';
              }
          }

      }

?>