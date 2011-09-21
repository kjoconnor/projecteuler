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
	print_r($t);
	while(sizeof($t) > 1) {
		
		for($i = 0; $i <= sizeof($t[$row]); $i++) {
			print $row . ", " . $i . "\n";
			if(!isset($t[$row - 1][$i]))
				continue;
			if($t[$row][$i] > $t[$row][$i + 1]) {
				$t[$row - 1][$i] += $t[$row][$i];
			} else {
				$t[$row - 1][$i] += $t[$row][$i + 1];
			}

			unset($t[$row][$i]);
		}

		if(sizeof($t[$row] === 0))
			unset($t[$row]);
		
		$row--;
		print_r($t);
		print "-----------------\n";
	}

	return $t;
}

$reducedTriangle = reduceTriangle($triangle);

print $reducedTriangle[0][0] . "\n";

?>