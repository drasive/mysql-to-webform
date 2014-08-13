<?php namespace InputFormGenerator\BusinessLogic;
      
      /**
       * Ein Eingabeelement, welches Nutzereingaben erfordert.
       */
      class InputElement {
          
          // Private variables
          /**
           * Der Name des Eingabeelementes.
           */
          private $name;
          
          /**
           * Zeigt an, ob dieses Eingabeelement ausgefüllt werden muss.
           */
          private $required;
          
          /**
           * Der Typ des Eingabeelementes.
           */
          private $type;          
          
          /**
           * Die Maximallänge des Eingabeelementes.
           */
          private $maximumLength;
          
          /**
           * Die möglichen Eingabewerte des Eingabeelementes.
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
           * Erstellt eine neue Instanz der Klasse InputElement.
           * @param string $name Der Name des Eingabeelementes.
           * @param bool $required Zeigt an, ob dieses Eingabeelement ausgefüllt werden muss.
           * @param InputElementType $type Der Typ des Eingabeelementes.
           * @param int $maximumLength Die Maximallänge des Eingabeelementes.
           * @param string[] $options Die möglichen Eingabewerte des Eingabeelementes.
           */
          function __construct($name, $required, $type, $maximumLength, $options) {
              $this->name = $name;
              $this->required = $required;
              $this->type = $type;
              $this->maximumLength = $maximumLength;
              $this->options = $options;
          }
          
      }
      
?>