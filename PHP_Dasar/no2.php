<?php
     $input = "TranSISI";
     $inputLength = strlen($input);

     $upper = 0;
     $lower = 0;
     $number = 0;
     $special = 0;
     for ($i = 0; $i < $inputLength; $i++)
     {
          if ($input[$i] >= 'a' && $input[$i] <= 'z')
               $lower++;
     }

     print("Lower case letters : ". $lower);