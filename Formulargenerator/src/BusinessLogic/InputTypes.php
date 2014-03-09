<?php namespace FormGenerator\BusinessLogic;
      
      abstract class InputTypes extends Enum {
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
      }
      
?>