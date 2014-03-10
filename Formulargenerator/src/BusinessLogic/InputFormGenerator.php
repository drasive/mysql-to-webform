<?php namespace InputFormGenerator\BusinessLogic;

      class InputFormGenerator {
          
          function generateInputForm($name, $server, $database, $table, $username, $password) {
              $mySqlDatabaseReader = new Data\MySqlDatabaseReader($server, $database, $username, $password);
              $test = $mySqlDatabaseReader->doesDatabaseExist();
              
              $htmlTagGenerator = new HtmlTagGenerator();
              
              $form = $htmlTagGenerator->generateFormStart('', 'post');
          }
          
      }

?>