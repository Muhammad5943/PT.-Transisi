<?php
     $n = 8;
	for($j = 0; $j < $n; $j++)
	{
		if($j == 0)
			for($i = 1;$i < $n+1; $i++)
				if ($i%3 == 0) {
					echo "* ";
				} elseif ($i%4 == 0) {
					echo "* ";
				} else {
					echo $i . " ";
				}
		else
			for($k = 0;$k < $n; $k++)
			{
				if($k == $n-1)
					if ($i++%3 == 0) {
						echo "* ";
					} elseif ($i++%4 == 0) {
						echo "* ";
					} else {
						echo $i++ . " ";
					}
				else
					if ($i++%3 == 0) {
						echo "* ";
					} elseif ($i++%4 == 0) {
						echo "* ";
					} else {
						echo $i++ -2 . " ";
					}
				echo " ";
			}
		echo "\n";
	}