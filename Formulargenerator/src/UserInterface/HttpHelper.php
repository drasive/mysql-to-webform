<?php namespace InputFormGenerator\UserInterface;
      
      abstract class HttpHelper {
          
          // Public methods
          /**
           * @author http://stackoverflow.com/questions/13279801/how-can-i-download-a-string-to-the-browser-using-php-not-a-text-file
           */          
          public static function uploadToWebbrowser($content, $filename, $content_type) {
              // TODO: Test
              
              header('Content-Type: ' . $content_type);
              header('Content-Disposition: attachment; filename="' . $filename . '"');
              header('Content-Length: ' . strlen($result));
              echo $result;
          }
          
      }
      
?>