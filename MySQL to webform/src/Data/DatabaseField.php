<?php namespace InputFormGenerator\Data;

      /**
       * Ein Feld in einer Datenbank.
       */
      class DatabaseField {

          // Private variables
          /**
           * Der Name des Datenbankfeldes.
           */
          private $name;
          
          /**
           * Der Typ des Datenbankfeldes.
           */
          private $type;
          
          /**
           * Die Maximallänge des Datenbankfeldes.
           */
          private $maximumLength;   
          
          /**
           * Die Flags des Datenbankfeldes.
           */
          private $flags;
          
          /**
           * Die möglichen Eingabewerte des Datenbankfeldes.
           */
          private $options;

          // Public properties
          public function __get($property) {
              if (property_exists($this, $property)) {
                  return $this->$property;
              }
          }

          // Public constructors
          /**
           * Erstellt eine neue Instanz der Klasse DatabaseField.
           * @param string $name Der Name des Datenbankfeldes.
           * @param string $type Der Typ des Datenbankfeldes.
           * @param int $maximumLength Die Maximallänge des Datenbankfeldes.
           * @param string[] $flags Die Flags des Datenbankfeldes.
           * @param string[] $options Die möglichen Eingabewerte des Datenbankfeldes.
           */
          function __construct($name, $type, $maximumLength, $flags, $options) {
              $this->name = $name;
              $this->type = $type;
              $this->maximumLength = $maximumLength;             
              $this->flags = $flags;
              $this->options = $options;
          }

      }

?>