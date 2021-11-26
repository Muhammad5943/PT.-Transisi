<?php
     $input = "Jakarta adalah ibukota negara Republik Indonesia";
     $lowerCaseInput = strtolower($input);
     $inputLength = strlen($input);

     $arrayInput = explode(' ', $lowerCaseInput);
     
     // print_r($arrayInput);
     $unigramInput = '';
     for ($i = 0; $i < $inputLength; $i++) { 
          if ($lowerCaseInput[$i] == ' ') {
               $unigramInput .= ', ';
          } else {
               $unigramInput .= $lowerCaseInput[$i];
          }

     }

     $j = 0;
     $bigramInput = '';
     foreach ($arrayInput as $itemBi) {
          if ($j < 1) {
               $bigramInput .= $itemBi.' ';
               $j++;
          } else {
               $bigramInput .= $itemBi.', ';
               $j = 0;
          }
     }
     $bigramInput = substr($bigramInput, 0, -2);

     $k = 0;
     $trigramInput = '';
     foreach ($arrayInput as $itemTri) {
          if ($k < 2) {
               $trigramInput .= $itemTri.' ';
               $k++;
          } else {
               $trigramInput .= $itemTri.', ';
               $k = 0;
          }
     }
     $trigramInput = substr($trigramInput, 0, -2);

     print('Unigram: '. $unigramInput. "\n\n");
     print('Bigram: '. $bigramInput. "\n\n");
     print('Trigram: '. $trigramInput. "\n\n");

