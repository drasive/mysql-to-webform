<?php namespace FormGenerator\BusinessLogic;
      
      class InputFormGenerator {
          
          public function generateForm($name, $databaseSTuff) {
              $htmlTagGenerator = new HtmlTagGenerator();
              
              return $htmlTagGenerator->generateFormStart('', 'post');
          }
          
      }
      
?>