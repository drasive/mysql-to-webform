<?php namespace InputFormGenerator\BusinessLogic;
      
      class InputElementSpecification {
          
          // Private variables
          private $name;
          private $required;
          private $defaultValue;
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
          function __construct($name, $required, $defaultValue, $type, $maximumLength, $options = null) {
              $this->name = $name;
              $this->required = $required;
              $this->defaultValue = $defaultValue;
              $this->type = $type;
              $this->maximumLength = $maximumLength;
              $this->options = $options;
          }
          
      }
      
?>