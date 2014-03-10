<?php namespace InputFormGenerator\Data;

      class DatabaseField {

          // Private variables
          private $name;
          private $type;
          private $maximumLength;
          private $flags;
          private $defaultValue;

          // Public properties
          public function __get($property) {
              if (property_exists($this, $property)) {
                  return $this->$property;
              }
          }

          // Public constructors
          function __construct($name, $type, $maximumLength, $flags, $defaultValue) {
              $this->name = $name;
              $this->type = $type;
              $this->maximumLength = $maximumLength;
              $this->flags = $flags;
              $this->defaultValue = $defaultValue;
          }

      }

?>