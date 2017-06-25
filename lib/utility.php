<?php

// collection of utility functions

function colourBrightness($hex, $percent) {
	// Work out if hash given
	$hash = '';
	if (stristr($hex,'#')) {
		$hex = str_replace('#','',$hex);
		$hash = '#';
	}
	/// HEX TO RGB
	$rgb = array(hexdec(substr($hex,0,2)), hexdec(substr($hex,2,2)), hexdec(substr($hex,4,2)));
	//// CALCULATE
	for ($i=0; $i<3; $i++) {
		// See if brighter or darker
		if ($percent > 0) {
			// Lighter
			$rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
		} else {
			// Darker
			$positivePercent = $percent - ($percent*2);
			$rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1-$positivePercent));
		}
		// In case rounding up causes us to go to 256
		if ($rgb[$i] > 255) {
			$rgb[$i] = 255;
		}
	}
	//// RBG to Hex
	$hex = '';
	for($i=0; $i < 3; $i++) {
		// Convert the decimal digit to hex
		$hexDigit = dechex($rgb[$i]);
		// Add a leading zero if necessary
		if(strlen($hexDigit) == 1) {
		$hexDigit = "0" . $hexDigit;
		}
		// Append to the hex string
		$hex .= $hexDigit;
	}
	return $hash.$hex;
}

// utf8 capitalize
function mb_ucfirst($str) {
    $fc = mb_strtoupper(mb_substr($str, 0, 1));
    return $fc.mb_substr($str, 1);
}

// make colored spans, depending on the stock
function spanify($x, $min=0, $max=0, $u=U_NAMES[U_STD][1]){
    if($x!=0){
    ?>
    <span class="label label-<?=($x>$max?'success':($x<$min?'danger':'default'))?>"><?=$x?>&nbsp;<?=$u?></span>
<?php
    }
    else {
        ?>
        <span class="label label-default">-&nbsp;<?=$u?></span>
            <?php
    }
}

// thousands separator
function ezres($x)
{
	$y = "".$x;
	if(strlen($y)<=3){ return $y; }
	return substr($y,	0, -3).'.'.substr($y, -3,3);
}

// link to the github issues on the main page
function issueLink($url, $title){
	?><a href="<?=$url?>" target="_blank"><i class="fa fa-github" aria-hidden="true"></i> #<?=explode('/',$url)[count(explode('/',$url))-1]?></a> - <?=$title?><?
}

// water drops for the humidity
function csepp($x){
	return str_repeat('<span class="glyphicon glyphicon-tint" title="'.NEDVESSEG[$x][1].'"></span>',NEDVESSEG[$x][0]);
}
?>
