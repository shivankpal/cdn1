<?php
$newUrl = str_replace(" ","%20",$_GET['url']);
echo get_web_page($newUrl);
function get_web_page( $url )
{
 $options = array(
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_VERBOSE        => true,
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_USERAGENT      => "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8", // who am i
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 100,       // stop after 10 redirects
        CURLOPT_COOKIEJAR      => "/var/www/farm/cookie.txt",
	    CURLOPT_COOKIEFILE     => "/var/www/farm/cookie.txt"
    );

    $ch      = curl_init( $url );
    curl_setopt_array( $ch, $options );
    $content = curl_exec( $ch );
    $err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
    curl_close( $ch );
    $header['content'] = $content;
    return $content;
}


?>
