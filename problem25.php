<?php

if(!function_exists(bcadd))
	die("bcmath extension not available, please install it.\n");

$digit_limit = 1000;

$show_your_work_you_stupid_program = true;

$a = $b = 1;
$c = 0;
$i = 3;

while(strlen($b) < $digit_limit) {
	$c = bcadd($a, $b);
	$a = $b;
	$b = $c;
	if($show_your_work_you_stupid_program)
		print "F" . $i . ": " . $b . " (" . strlen($b) . ")\n";
	$i++;
}

if($show_your_work_you_stupid_program)
	print "---------\n";
print "Digit limit reached at F" . ($i - 1) . ": " . $b . " (" . strlen($b) . ")\n";

?>