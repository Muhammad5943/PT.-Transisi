<?php
     $nilai = "72 65 73 78 75 74 90 81 87 65 55 69 72 78 79 91 100 40 67 77 86";
     $arr = explode(" ", $nilai);

     function bubble_sort($arr) {
          $size = count($arr)-1;
          for ($i=0; $i<$size; $i++) {
               for ($j=0; $j<$size-$i; $j++) {
                    $k = $j+1;
                    if ($arr[$k] < $arr[$j]) {
                         list($arr[$j], $arr[$k]) = array($arr[$k], $arr[$j]);
                    }
               }
          }
          return $arr;
     }

     $arr = bubble_sort($arr);
     // print_r($arr);

     $average = array_sum($arr)/count($arr);
     print_r('Rata-rata Nilai ');
     print_r($average);
     echo "\r\n";

     $vacumMin = [];

     for ($i = 0; $i < 7; $i++) { 
          array_push($vacumMin, $arr[$i]);
     }

     print_r('Nilai Terendah ');
     print_r($vacumMin);

     $vacumMax = [];
     $lastValue = count($arr);

     for ($j = $lastValue - 1; $j > $lastValue - 8; $j--) { 
          array_push($vacumMax, $arr[$j]);
     }

     print_r('Nilai Tertinggi ');
     print_r($vacumMax);