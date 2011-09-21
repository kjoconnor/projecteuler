<?php

$triangle = triangleFileToArray('problem67/triangle.txt');

function triangleFileToArray($file) {
	$t = file($file);

	foreach($t as $row => $line) {
		foreach(explode(" ", trim($line)) as $o => $item) {
			$triangle[$row][$o] = $item;
		}
	}

	return $triangle;
}

function reduceTriangle($t) {
	// Start from bottom left, find parent
	// From parent, compare left and right child
	// Parent becomes self + the greater of left and right children
	// Delete leftmost child, move to the right and repeat
	// When you reach the end of a row, move up a row and repeat
	//
	// Check to see if your parent is the only item in its row, if it
	// is then it's time to quit - the last operation you did was the
	// final summation.

	$row = sizeof($t) - 1;
	// print_r($t);
	while(sizeof($t) > 1) {

		// print "Working on row " . $row . "\n";
		$rowsize = sizeof($t[$row]);
		
		for($i = 0; $i <= $rowsize; $i++) {
			// print "\$i: " . $i . "\n";
			if(!isset($t[$row - 1][$i])) {
				// print "Top row detected, continuing.\n";
				continue;
			}
			if($t[$row][$i] > $t[$row][$i + 1]) {
				// print "Offset " . $i . " with a value of " . $t[$row][$i] . " was higher than right child, " . $i . " - " . $t[$row][$i + 1] . "\n";
				$t[$row - 1][$i] += $t[$row][$i];
			} else {
				// print "Offset " . $i . " with a value of " . $t[$row][$i] . " was lower than right child, " . $i . " - " . $t[$row][$i + 1] . "\n";
				$t[$row - 1][$i] += $t[$row][$i + 1];
			}

			// print "Unsetting " . $i . ", " . $t[$row][$i] . "\n";
			unset($t[$row][$i]);
		}

		if(sizeof($t[$row] === 0)) {
			// print "Row " . $row . " is empty, unsetting.\n";
			unset($t[$row]);
		}
		
		$row--;
		// print_r($t);
		// print "-----------------\n";
	}

	return $t;
}

$reducedTriangle = reduceTriangle($triangle);

print $reducedTriangle[0][0] . "\n";

?>