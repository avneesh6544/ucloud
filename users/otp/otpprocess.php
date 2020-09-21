<?php
	define('OTP_AUTH_KEY','b7fa3845ca1a462cc60a71130f7e2775');

class otpprocess
{

public static function send($mobileNo,$randomid)
{
  
    $mobile=trim($mobileNo);
    $otp = trim($randomid);
    $curl_scraped_page='';
    $auth_key = "25a7ceb685a34aefcadc857a6d356b02";

    $route = "route=4";
 
    $headers = array('Content-Type: application/x-www-form-urlencoded');
      

    $url="http://enterprise.smsgupshup.com/GatewayAPI/rest?method=SendMessage&send_to=".$mobile;
    // add the message
    $url.="&msg=Hi%20";
    // Add the message type, api user id, api password, and message mask word
    $url.="&msg_type=TEXT&userid=".$auth_key."&auth_scheme=plain&v=1.1&format=text";

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => $headers,
        ));
        $response = curl_exec($curl);
        print_r($response);die();
        curl_close($curl);

 
 
    



}
}




?>
