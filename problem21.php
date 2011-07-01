<?php

# I am 100% certain there are better and faster ways of doing this, don't judge me

function getProperDivisors($n) {
	$divisors[] = 1;
	$pivot = ceil($n / 2);

	for($i = 2; $i < $pivot; $i++) {
		if(in_array($i, $divisors))
			continue;
		if(!($n % $i)) {
			$divisors[] = $i;
			$divisors[] = ($n / $i);
		}
	}

	sort($divisors);
	return $divisors;
}

$i = 1;
$amicable = array();

do {
	if(!($i % 1000))
		print "Working on $i\n";
	
	if(in_array($i, $amicable)) {
		$i++;
		continue;
	}
	
	$iDivisors = getProperDivisors($i);
	$iDivisorSum = array_sum($iDivisors);
	
	if($i === $iDivisorSum) {
		$i++;
		continue;
	}

	if(array_sum(getProperDivisors($iDivisorSum)) == $i) {
		print "Pair Found: $i, $iDivisorSum\n";
		$amicable[] = $i;
		$amicable[] = $iDivisorSum;
	}
	
	$i++;
} while($i < 10000);

print_r($amicable);

print "Final Sum: " . array_sum($amicable) . "\n";
?>
