<?php

$i = 1;
$c = FALSE;

function test($i, $maxMultiplier, $minMultiplier = 2) {

	for($a = $minMultiplier; $a <= $maxMultiplier; $a++) {
		if(!digit_compare($i, ($i * $a)))
			return FALSE;
	}
	
	return TRUE;
}

function digit_compare($a, $b) {
	print "Comparing $a and $b.\n";
	if(strlen($a) !== strlen($b)) {
		print "$a is not the same length as $b, returning.\n";
		return FALSE;
	}
	
	$aDigits = str_split($a);
	$bDigits = str_split($b);
	

	foreach($aDigits as $aDigit) {
		$key = array_search($aDigit, $bDigits);
		if($key !== FALSE) {
			unset($bDigits[$key]);
			sort($bDigits);
		} else {
			print "Couldn't find $aDigit in " . implode($bDigits) . ", returning.\n";
			return FALSE;
		}
	}
	
	return TRUE;
}

while(!$c) {
	print "Testing " . $i . "\n";
	$c = test($i, 6);
	if($c)
		print "Found: " . $i . "\n";
	$i++;
}

?>
