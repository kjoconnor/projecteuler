<?php

if(isset($_SERVER['argv'][1])) {
	if(!is_numeric($_SERVER['argv'][1]))
		die("Argument is not numeric!\n");
	
	$limit = $_SERVER['argv'][1];
} else {
	$limit = 1000;
}

$lettersum = 0;

// Words!
$words[0] = '';
$words[1] = 'one';
$words[2] = 'two';
$words[3] = 'three';
$words[4] = 'four';
$words[5] = 'five';
$words[6] = 'six';
$words[7] = 'seven';
$words[8] = 'eight';
$words[9] = 'nine';
$words[10] = 'ten';
$words[11] = 'eleven';
$words[12] = 'twelve';
$words[13] = 'thirteen';
$words[14] = 'fourteen';
$words[15] = 'fifteen';
$words[16] = 'sixteen';
$words[17] = 'seventeen';
$words[18] = 'eighteen';
$words[19] = 'nineteen';
$words[20] = 'twenty';
$words[30] = 'thirty';
$words[40] = 'forty';
$words[50] = 'fifty';
$words[60] = 'sixty';
$words[70] = 'seventy';
$words[80] = 'eighty';
$words[90] = 'ninety';

// This is ugly as heck, I'm sorry
for($i = 1; $i <= $limit; $i++) {
	// If the word is in our dictionary, just set and be done
	if(isset($words[$i])) {
		$str = $words[$i];
	} else {
		// Otherwise we have to check through each digit and construct the term
		$lastdigit = '';
		foreach(str_split((string) $i) as $pos => $digit) {

			$place = strlen($i) - $pos;
			
			if($place === 4) {
				$str .= $words[$digit] . ' thousand ';
			} else if($place === 3) {
				if($digit != 0) {
					if($str != '') {
						$str .= 'and ';
					}
					$str .= $words[$digit] . ' hundred ';
				}
			} else if($place === 2) {
				if($digit != 0) {
					if($str != '') {
						$str .= 'and ';
					}
					if((int)$digit != 1) {
						$str .= $words[$digit . '0'];
					}
				}
			} else if($place === 1) {
				if($digit != 0 || (int)$lastdigit === 1) {
					if($str !== '' && (int)$lastdigit !== 0) {
						if((int)$lastdigit !== 1)
							$str .= '-';
					} else {
						$str .= 'and ';
					}
					if((int)$lastdigit === 1) {
						$str .= $words['1' . $digit];
					} else {
						$str .= $words[$digit];
					}
				}
			}

			$lastdigit = $digit;
		}
	}
	$lettersum += strlen(str_replace(' ', '', str_replace('-', '', $str)));

	$str = '';
}

print $lettersum . "\n";

?>