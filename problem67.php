<?php

$triangle = triangleFileToArray('problem67/problem18_triangle.txt');

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
	global $pathinfo;
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

	// Keep going until the size of the triangle has been reduced to one level
	while(sizeof($t) > 1) {

		// print "Working on row " . $row . "\n";
		// Store the size of the row before we start unsetting things
		$rowsize = sizeof($t[$row]);
		
		// Go from the leftmost element to the rightmost
		for($i = 0; $i <= $rowsize; $i++) {
			// print "\$i: " . $i . "\n";
			// We're at the second row here, and we've already done the compare - we can stop here.
			if(!isset($t[$row - 1][$i])) {
				// print "Top row detected, continuing.\n";
				continue;
			}
			// Compare the current item to the next item in the row, whichever is higher gets added to the parent
			if($t[$row][$i] > $t[$row][$i + 1]) {
				// print "Offset " . $i . " with a value of " . $t[$row][$i] . " was higher than right child, " . $i . " - " . $t[$row][$i + 1] . "\n";
				$t[$row - 1][$i] += $t[$row][$i];
				$pathinfo[$row - 1][$i] = $i;
			} else {
				// print "Offset " . $i . " with a value of " . $t[$row][$i] . " was lower than right child, " . $i . " - " . $t[$row][$i + 1] . "\n";
				$t[$row - 1][$i] += $t[$row][$i + 1];
				$pathinfo[$row - 1][$i] = $i + 1;
			}

			// Unset the item we were working on
			// print "Unsetting " . $i . ", " . $t[$row][$i] . "\n";
			unset($t[$row][$i]);
		}

		if(sizeof($t[$row] === 0)) {
			// print "Row " . $row . " is empty, unsetting.\n";
			unset($t[$row]);
		}
		
		// Move up the triangle
		$row--;
		// print_r($t);
		// print "-----------------\n";
	}

	return $t;
}

$reducedTriangle = reduceTriangle($triangle);

print $reducedTriangle[0][0] . "\n";

$pathinfo = array_reverse($pathinfo, true);

print_r($pathinfo);

$item = 0;
$path_taken = array();
foreach($pathinfo as $row) {
	print $row[$item] . ",";
	$path_taken[] = $row[$item];
	$item = $row[$item];
}

print_r($path_taken);

foreach($triangle as $level => $row) {
	foreach($row as $offset => $item) {
		if($path_taken[$level - 1] == $offset) {
			print "[" . $item . "] ";
		} else {
			print $item . " ";
		}
	}
	print "\n";
}

?>