<?php namespace InputFormGenerator\BusinessLogic;
      
      class InputElement {
          
          // Private variables
          private $name;
          private $required;
          private $type;          
          private $maximumLength;
          private $options;

          // Public properties
          public function __get($property) {
              if (property_exists($this, $property)) {
                  return $this->$property;
              }
          }
          
          // Public constructors
          function __construct($name, $required, $type, $maximumLength, $options) {
              $this->name = $name;
              $this->required = $required;
              $this->type = $type;
              $this->maximumLength = $maximumLength;
              $this->options = $options;
          }
          
      }
      
?>