<?php 
/*------------------------------------------------*/
/* MOBILE CHECK                                   */
/*------------------------------------------------*/

function isMobile() {
	return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

/*------------------------------------------------*/
/* TEXT LIMITERS                                  */
/*------------------------------------------------*/

function limitStrlen($input, $length, $ellipses = '[...]', $strip_html = true) {
    //strip tags, if desired
    if ($strip_html) {
        $input = strip_tags($input);
    }

    //no need to trim, already shorter than trim length
    if (strlen($input) <= $length) {
        return $input;
    }

    //find last space within length
    $last_space = strrpos(substr($input, 0, $length), ' ');
    if($last_space !== false) {
        $trimmed_text = substr($input, 0, $last_space);
    } else {
        $trimmed_text = substr($input, 0, $length);
    }
    //add ellipses (...)
    $trimmed_text .= $ellipses;


    return $trimmed_text;
}

/** 
	usage : echo limitStrlen(get_the_title(), 100, true, true);	
 **/

function limit_text($text, $limit) {
      $text = strip_tags($text); 
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]) . '...';
      }
      return $text;
}

/**
 	usage : echo limit_text(get_the_excerpt(), 100); //100 words
**/

/*------------------------------------------------*/
/* CLEAN STRING                                   */
/*------------------------------------------------*/

function clean_text($string='', $array=array()) {

	$default = array( 
		'lower' => true,
		'space' => true
	);

	$param = array_merge($default, $array); 

    // Strip HTML Tags
    $clear = strip_tags($string);
    // Clean up things like &amp;
    $clear = html_entity_decode($clear);
    // Strip out any url-encoded stuff
    $clear = urldecode($clear);
    // Replace non-AlNum characters with space
    $clear = preg_replace('/[^A-Za-z0-9\-\_]/', ' ', $clear);
    // Replace Multiple spaces with single space
    $clear = preg_replace('/ +/', ' ', $clear);
    // Trim the string of leading/trailing space
    $clear = trim($clear);    

	if($param['space'] == true)
    	$clear = str_replace(' ', '', $clear);

	if($param['lower'] == true)
    	$clear = strtolower($clear);

    return $clear;
}

function phone_format($number) {
		$number = preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $number). "";
		return $number;
}

/*------------------------------------------------*/
/* NUMBER FORMAT PRECISION                        */
/*------------------------------------------------*/

function numPrecision($number, $precision = 2, $separator = '.')
{
    $numberParts = explode($separator, $number);
    $response = $numberParts[0];
    if (count($numberParts)>1 && $precision > 0) {
        $response .= $separator;
        $response .= substr($numberParts[1], 0, $precision);
    }
    return $response;
}

/*------------------------------------------------*/
/* FILTER ONLY NUMBERS                            */
/*------------------------------------------------*/

function num_filter($val) {
    $val = preg_replace('#[^0-9\.]#', '', $val);
    return $val;
} 

function num_price($val) {
    $val = preg_replace('#[^0-9\.]#', '', $val);
	$val = number_format($val); //adds comma
	//number_format($number, 2, '.', ','); 1,234.56
    return $val;
}

/*------------------------------------------------*/
/* WP KSES                                        */
/*------------------------------------------------*/
function text_allowed_html() {

	$allowed_tags = array(
		'b' => array(),
        'p' => array(),
        'br' => array(),
		'em' => array(),
		'i' => array(),
		'strike' => array(),
		'strong' => array(),        
        'a' => array(
			'class' => array(),
			'href'  => array(),
			'rel'   => array(),
			'title' => array(),
		),
		'p' => array(
			'class' => array(),
		),        
		'abbr' => array(
			'title' => array(),
		),
		'blockquote' => array(
			'cite'  => array(),
		),
		'cite' => array(
			'title' => array(),
		),
		'code' => array(),
		'del' => array(
			'datetime' => array(),
			'title' => array(),
		),
		'dd' => array(),
		'div' => array(
			'class' => array(),
			'title' => array(),
			'style' => array(),
		),
		'dl' => array(),
		'dt' => array(),
		'h1' => array(),
		'h2' => array(),
		'h3' => array(),
		'h4' => array(),
		'h5' => array(),
		'h6' => array(),
		'img' => array(
			'alt'    => array(),
			'class'  => array(),
			'height' => array(),
			'src'    => array(),
			'width'  => array(),
		),
		'li' => array(
			'class' => array(),
		),
		'ol' => array(
			'class' => array(),
		),
		'p' => array(
			'class' => array(),
		),
		'q' => array(
			'cite' => array(),
			'title' => array(),
		),
		'span' => array(
			'class' => array(),
			'title' => array(),
			'style' => array(),
		),
		'ul' => array(
			'class' => array(),
		), 
	);
	
	return $allowed_tags;
}

//usage :
/**
  $sanitized = text_allowed_html($bar);
  
  $allowed_html = adsDetail_allowed_html();
  $sanitized_string = wp_kses($raw_string, $allowed_html);
**/

?>