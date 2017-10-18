<?php
define ("AUTH_KEY","AIzaSyAcjeUnfNlSKHt_3uCAGudw-xi2rQDtsls");  //goo.gl API key
define ("API_URL","https://www.googleapis.com/urlshortener/v1/url");  // goo.gl API url
/**
 * @param bool $long_url send long url
 * @param bool $short_url send short url
 * @return mixed return result API URL
 */

function send($long_url=FALSE, $short_url=FALSE){
    $ku = curl_init();          //open new session
    curl_setopt($ku,CURLOPT_SSL_VERIFYPEER,FALSE);
    curl_setopt($ku,CURLOPT_SSL_VERIFYHOST,FALSE);
    curl_setopt($ku,CURLOPT_RETURNTRANSFER,TRUE);

    //  get long url value and create short url
    if($long_url){
        curl_setopt($ku,CURLOPT_POST,TRUE);
        curl_setopt($ku,CURLOPT_POSTFIELDS,json_encode(array("longUrl"=>$long_url))); //array on php to json
        curl_setopt($ku,CURLOPT_HTTPHEADER,array("Content-Type:application/json"));
        curl_setopt($ku,CURLOPT_URL,API_URL."?key=".AUTH_KEY);  //key auto
    }
    // short url, take the date
    elseif($short_url){
        curl_setopt($ku,CURLOPT_URL,API_URL."?key=".AUTH_KEY."&shortUrl=".$short_url."&projection=ANALYTICS_CLICKS");
    }

    $result = curl_exec($ku);  // send date request

    curl_close($ku);  //close session
    return json_decode($result);
}
$lenght = $_POST['url'];  // post input url on web

$res = send($lenght);   // read for

$res2 = send(FALSE,$res->id); // read  for link

?>