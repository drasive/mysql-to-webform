<?php namespace InputFormGenerator\BusinessLogic;

      require_once('src\String.php');
      require_once('src\Data\MySqlDatabaseReader.php');
      require_once('src\BusinessLogic\InputElementTypes.php');
      require_once('src\BusinessLogic\InputElementSpecification.php');
      require_once('src\BusinessLogic\HtmlTagGenerator.php');

      class InputFormGenerator {

          public function generateInputForm($name, $server, $database, $table, $username, $password) {
              $mySqlDatabaseReader = new \InputFormGenerator\Data\MySqlDatabaseReader($server, $database, $username, $password);
              if ($mySqlDatabaseReader->canConnectToDatabase()) {
                  echo '<h3>Info</h3>';
                  echo 'Connection succesfull<br /><br />';

                  // ------------------------------------------------------------------------------------------------------------------------
                  // This functionality already is in "Data\MySqlDatabaseReader" and can be removed here

                  echo '<h3>Table</h3>';
                  echo '<table cellpadding="5">
                      <tr>
                          <th>Name</th>
                          <th>Type</th>
                          <th>Max. Length</th>
                          <th>Flags</th>
                          <th>Default</th>
                      </tr>';
                  foreach ($mySqlDatabaseReader->getFields($table) as $databaseField) {
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
                  // Move this to a the new class "BusinessLogic\MySqlDatabaseInputFormSpecificationBuilder"

                  echo '<h3>Input element specifications</h3>';
                  $specifications = array();
                  foreach ($mySqlDatabaseReader->getFields($table) as $databaseField) {
                      $specification = null;
                      $isRequired = in_array('not_null', $databaseField->flags);

                      if (in_array('primary_key', $databaseField->flags)) {
                          continue;
                      }
                      switch ($databaseField->type) {
                          case "string":
                              if (in_array('enum', $databaseField->flags)) {
                                  if (\InputFormGenerator\String::endsWith($databaseField->name, '_r')) {
                                      $specification = new \InputFormGenerator\BusinessLogic\InputElementSpecification($databaseField->name, $isRequired, $databaseField->defaultValue, \InputFormGenerator\BusinessLogic\InputElementTypes::radiobuttons, $databaseField->maximumLength, 'OPTIONS');
                                  } else if (\InputFormGenerator\String::endsWith($databaseField->name, '_s')) {
                                      $specification = new \InputFormGenerator\BusinessLogic\InputElementSpecification($databaseField->name, $isRequired, $databaseField->defaultValue, \InputFormGenerator\BusinessLogic\InputElementTypes::select, $databaseField->maximumLength, 'OPTIONS');
                                  }
                                  else {
                                      // TODO: Error
                                  }
                              }
                              else {
                                  $specification = new \InputFormGenerator\BusinessLogic\InputElementSpecification($databaseField->name, $isRequired, $databaseField->defaultValue, \InputFormGenerator\BusinessLogic\InputElementTypes::text, $databaseField->maximumLength);

                                  // TODO: Implement subtypes

                                  //if (endsWith($name, 'PH')) {

                                  //} else if (endsWith($name, 'PH')) {

                                  //}
                                  //else {
                                  //     // TODO: Error
                                  //}
                              }
                              break;
                          case "int":
                              if ($len == 1 && in_array('unsigned', $databaseField->flags)) {
                                  $specification = new \InputFormGenerator\BusinessLogic\InputElementSpecification($databaseField->name, $isRequired, $databaseField->defaultValue, \InputFormGenerator\BusinessLogic\InputElementTypes::checkbox, $databaseField->maximumLength);
                              }
                              else {
                                  $specification = new \InputFormGenerator\BusinessLogic\InputElementSpecification($databaseField->name, $isRequired, $databaseField->defaultValue, \InputFormGenerator\BusinessLogic\InputElementTypes::number, $databaseField->maximumLength);
                              }
                              break;
                          default:
                          // TODO: error
                      }
                      array_push($specifications, $specification);
                  }
                  echo '<table cellpadding="5">
                      <tr>
                          <th>Name</th>
                          <th>Required</th>
                          <th>Default</th>
                          <th>Type</th>
                          <th>max length</th>
                          <th>Options</th>
                      </tr>';
                  foreach ($specifications as $specification) {
                      echo '<tr>';

                      echo '<td>' . $specification->name . '</td>';
                      echo '<td>' . $specification->required . '</td>';
                      echo '<td>' . $specification->defaultValue . '</td>';
                      echo '<td>' . $specification->type . '</td>';
                      echo '<td>' . $specification->maximumLength . '</td>';
                      echo '<td>' . $specification->options . '</td>';

                      echo '</tr>';
                  }
                  echo '</table>';


                  // ------------------------------------------------------------------------------------------------------------------------
                  // Make this to a method (in this class) called ~"generateInputElements"

                  echo '<h3>Input elements</h3>';
                  $inputElements = array();
                  $htmlTagGenerator = new \InputFormGenerator\BusinessLogic\HtmlTagGenerator();
                  foreach ($specifications as $specification) {
                      // TODO: Pretty shitty condition
                      if ($specification->type < 100) {
                          $inputElement = $htmlTagGenerator->generateInput($specification->name,$specification->required, $specification->defaultValue, $specification->type, $specification->maximumLength);
                      }
                      else {
                          switch ($specification->type) {
                              case 100:
                                  $inputElement = $htmlTagGenerator->generateTextarea($specification->name,$specification->required, $specification->defaultValue, $specification->maximumLength);
                                  break;
                              case 101:
                                  $inputElement = $htmlTagGenerator->generateRadiobuttons($specification->name,$specification->required, $specification->defaultValue, $specification->options);
                                  break;
                              case 102:
                                  $inputElement = $htmlTagGenerator->generateSelect($specification->name,$specification->required, $specification->defaultValue, $specification->options);
                                  break;
                              default:
                              // TODO: handle this bs
                          }
                      }

                      array_push($inputElements, $inputElement);
                  }
                  echo '<table cellpadding="5">';
                  foreach ($inputElements as $inputElement) {
                      echo "<tr><td>$inputElement</tr></td>";
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