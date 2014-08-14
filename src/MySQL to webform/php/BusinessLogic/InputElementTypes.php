<?php namespace DimitriVranken\MySQL_to_webform\BusinessLogic;
           
      /**
       * Die verschiedenen Typen von Eingabeelementen (InputElement).
       */
      abstract class InputElementTypes {
          // Input (0 - 99)
          const checkbox = 0;
          const color = 1;
          const date = 2;
          const dateTime = 3;
          const dateTimeLocal = 4;
          const email = 5;          
          const file = 6;
          const month = 7;
          const number = 8;
          const password = 9;
          const range = 10;
          const search = 11;
          const telephone = 12;
          const text = 13;
          const time = 14;
          const url = 15;
          const week = 16;
          
          // Others (100 - 199)
          const textarea = 100;          
          const radiobuttons = 101;
          const select = 102;
      }
      
?>