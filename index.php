<?php
// Make By bonusofficial
// 02/02/2024
// https://github.com/bonusofficial
$users = "xxxx";
$password = md5("xxxx");
// Get Pre1 And Pre 2 in API: https://sso.garena.com/api/prelogin?app_id=10100&account=username&format=json&id=1706885533677
$pre1 = "JjYh8a0l";
$pre2 = "bQEdpXXwhX2Yc1IK";
$decryp = hash('sha256', hash('sha256', $password . $pre1) . $pre2);
function EnCode($plaintext, $key)
{
    $chiperRaw = openssl_encrypt(hex2bin($plaintext), "AES-256-ECB", hex2bin($key), OPENSSL_RAW_DATA);
    return substr(bin2hex($chiperRaw), 0, 32);
}
function curl($url)
{
    $ch = @curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    $head[] = "Connection: keep-alive";
    $head[] = "Keep-Alive: 300";
    $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
    $head[] = "Accept-Language: en-us,en;q=0.5";
    curl_setopt($ch, CURLOPT_USERAGENT, 'Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Expect:'
    ));
    $page = curl_exec($ch);
    curl_close($ch);
    return $page;
}

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    $return = ((float)$usec + (float)$sec);
    $return = str_replace(".", "", $return);
    return substr($return, 0, -1);
}


echo EnCode($password, $decryp);
$results = json_encode(curl("https://sso.garena.com/api/prelogin?app_id=10100&account=$users&format=json&id=" . microtime_float()));
// Make By bonusofficial
// 02/02/2024
// https://github.com/bonusofficial
?>