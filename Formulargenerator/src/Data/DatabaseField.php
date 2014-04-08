<?php namespace InputFormGenerator\Data;

      /**
       * Ein Feld in einer Datenbank.
       */
      class DatabaseField {

          // Private variables
          private $name;
          private $type;
          private $maximumLength;          
          private $flags;
          private $options;

          // Public properties
          public function __get($property) {
              if (property_exists($this, $property)) {
                  return $this->$property;
              }
          }

          // Public constructors
          function __construct($name, $type, $maximumLength, $flags, $options) {
              $this->name = $name;
              $this->type = $type;
              $this->maximumLength = $maximumLength;             
              $this->flags = $flags;
              $this->options = $options;
          }

      }

?>