<?php
if(!defined('ABSPATH')){
    $pagePath = explode('/wp-content/', dirname(__FILE__));
    include_once(str_replace('wp-content/' , '', $pagePath[0] . '/wp-load.php'));
}
if(WP_DEBUG == false){
error_reporting(0);	
}
include_once(ABSPATH."wp-load.php");
include_once(ABSPATH .'wp-content/plugins/vtupress/functions.php');

$custom_arr["format"] = $_REQUEST["format"];
$custom_arr["baseurl"] = $_REQUEST["baseurl"];
$custom_arr["network"] = $_REQUEST["network"];
$custom_arr["quantity"] = $_REQUEST["quantity"];
$custom_arr["planid"] = $_REQUEST["planid"];
$custom_arr["plan"] = $_REQUEST["plan"];
$custom_arr["volume"] = $_REQUEST["volume"];
$custom_arr["network_name"] = $_REQUEST["network_name"];
$custom_arr["amount"] = $_REQUEST["amount"];
$custom_arr["type"] = $_REQUEST["type"];
$custom_arr["apikey"] =  $_REQUEST["apikey"];
$custom_arr["check_ussd"] =  $_REQUEST["check_ussd"];
$custom_arr["load_ussd"] =  $_REQUEST["load_ussd"];

extract($custom_arr);

vp_updateoption("datacard_apikey",$apikey);

if(empty($format) || empty($baseurl)){
die("Please Import An Api Provider");
}

foreach($custom_arr as $req){
    if(empty($req)){
        die("All Fields Are Mandatory. Please Check");
    }
}

switch($format){

    case"vtupress":
    // $url = "https://betabundles.com.ng/wp-content/plugins/vprest/?q=Data_card&id=1&apikey=2000&network=mtn&denomination=&quantity=59";
    if(stripos($custom_arr["apikey"],":") === false){
        $api_key = "Make sure you use a valid api key in the form of ID:APIKEY. I.e You are to enter a correct ID, followed by a SEMI-COLON [:] and your APIKEY. Without spaces please";
        die($api_key);
    }

    $arr = explode(":",$custom_arr["apikey"]);
    $id = $arr[0];
    $apikey = $arr[1];

    $url = $custom_arr["baseurl"]."&id=$id&apikey=$apikey&dataplan={$custom_arr["planid"]}&quantity={$custom_arr["quantity"]}&network={$custom_arr["network"]}";
        $curl = curl_init(); 

        curl_setopt_array($curl,array(
            CURLOPT_URL => $url, 
            CURLOPT_RETURNTRANSFER => true, 
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10, 
            CURLOPT_TIMEOUT => 0, 
            CURLOPT_FOLLOWLOCATION => true, 
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, 
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json') )); 
        
       // $response = curl_exec($curl); 
        /*{"api_response":"","request-id":"DATA_Card_6459f91a91256","status":"success","network":"MTN","plan_type":"SME","plan_name":"500MB","amount":"130.00","oldbal":"480.00","pin":"9427721883,0460368153","serial":"SN63281647A,SN64186829A","load_pin":"*347*383*3*3*PIN#"}*/
       // curl_close($curl); 


        $echo = curl_exec($curl);
if (curl_errno($curl)) {
    $error_msg = curl_error($curl);
}
curl_close($curl);

if (isset($error_msg)) {
    // TODO - Handle cURL error accordingly
    die("CURL ERROR =: ".$error_msg);
}
else{
    
$response =  $echo;


    $response_array = json_decode($response,true);
    
if(isset($response_array["status"])){
    if($response_array["status"] != "100"){

        if(isset($response_array["message"])){
            die($response_array["message"]);
        }
        die($response);
    }
    else{

    
        $pinss = $response_array["pin"].",non";
        $eachex = explode(",",$pinss);
    foreach($eachex as $thispin){

        if(!empty($thispin) && $thispin != "non"){
    $data = [
        "network" => strtoupper($network_name),
        "plan" => $plan,
        "value" => $amount,
        "type" => $type,
        "volume" => strtoupper($volume),
        "pin" => $thispin,
        "status" => "unused",
        "check_ussd" => $check_ussd,
        "load_ussd" => $load_ussd,
        "the_time" => date("Y-m-d H:i:s"),

    ];

global $wpdb;
$table_name = $wpdb->prefix."vpdatas";
$wpdb->insert($table_name,$data);

}

}



}
die("100");
}
else{
die($response);
}


}

    break;

    case"ncwallet":

        $curl = curl_init(); 

        $payload = [
            "network" => $network,
            "plan_type" => $planid,
            "card_name" => "vtupress",
            "quantity" => $quantity,
            ];
        curl_setopt_array($curl,array(
            CURLOPT_URL => $baseurl, 
            CURLOPT_RETURNTRANSFER => true, 
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10, 
            CURLOPT_TIMEOUT => 0, 
            CURLOPT_FOLLOWLOCATION => true, 
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, 
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>json_encode($payload),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Token '.$apikey ) )); 
        
       // $response = curl_exec($curl); 
        /*{"api_response":"","request-id":"DATA_Card_6459f91a91256","status":"success","network":"MTN","plan_type":"SME","plan_name":"500MB","amount":"130.00","oldbal":"480.00","pin":"9427721883,0460368153","serial":"SN63281647A,SN64186829A","load_pin":"*347*383*3*3*PIN#"}*/
       // curl_close($curl); 


        $echo = curl_exec($curl);
if (curl_errno($curl)) {
    $error_msg = curl_error($curl);
}
curl_close($curl);

if (isset($error_msg)) {
    // TODO - Handle cURL error accordingly
    die("CURL ERROR =: ".$error_msg);
}
else{
    
$response =  $echo;


    $response_array = json_decode($response,true);
    
if($response_array["status"]){
    if($response_array["status"] != "success"){
        die($response);
    }
    else{

    
        $pinss = $response_array["pin"].",non";
        $eachex = explode(",",$pinss);
    foreach($eachex as $thispin){

        if(!empty($thispin) && $thispin != "non"){
        $data = [
            "network" => strtoupper($network_name),
            "plan" => $plan,
            "value" => $amount,
            "type" => $type,
            "volume" => strtoupper($volume),
            "pin" => $thispin,
            "status" => "unused",
            "check_ussd" => $check_ussd,
            "load_ussd" => $load_ussd,
            "the_time" => date("Y-m-d H:i:s"),
    
        ];
    
    global $wpdb;
    $table_name = $wpdb->prefix."vpdatas";
    $wpdb->insert($table_name,$data);
    }
}

}
die("100");
}
else{
die($response);
}


}

    break;


    case"easyaccessapi":
$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => $baseurl,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => array(
'network' =>$network,
'no_of_pins' => $quantity,
'dataplan' => $planid,
),
CURLOPT_HTTPHEADER => array(
"AuthorizationToken: $apikey",
"cache-control: no-cache"
),
));

$echo = curl_exec($curl);
if (curl_errno($curl)) {
    $error_msg = curl_error($curl);
}
curl_close($curl);

if (isset($error_msg)) {
    // TODO - Handle cURL error accordingly
    die("CURL ERROR =: ".$error_msg);
}
else{
    
$response = str_replace('"pin"','"pin1"', $echo);


    $response_array = json_decode($response,true);
    
if($response_array["success"]){
    if($response_array["success"] != "true"){
        die($response);
    }
    else{
    for($x = 1; $x <= $quantity; $x++){
        $data = [
            "network" => strtoupper($network_name),
            "plan" => $plan,
            "value" => $amount,
            "type" => $type,
            "volume" => strtoupper($volume),
            "pin" => $response_array["pin$x"],
            "status" => "unused",
            "check_ussd" => $check_ussd,
            "load_ussd" => $load_ussd,
            "the_time" => date("Y-m-d H:i:s"),
    
        ];
    
    global $wpdb;
    $table_name = $wpdb->prefix."vpdatas";
    $wpdb->insert($table_name,$data);
    }

}

    /* 
Error Loading
{"success":"true","message":"Data Card Purchase was Successful","network":"MTN","pin1":"505824875S","dataplan":"1.5GB","amount":285,"balance_before":"430","balance_after":145,"transaction_date":"08-05-2023 07:15:11 pm","reference_no":"ID99023628363","client_reference":"client_ref02247176172040","status":"Successful","auto_refund_status":"success"}


{"success":"true","message":"Data Card Purchase was Successful","network":"MTN","pin1":"316927314S","dataplan":"1.5GB","amount":285,"balance_before":"950","balance_after":665,"transaction_date":"08-05-2023 07:32:15 pm","reference_no":"ID66225908810","client_reference":"client_ref48998285635010","status":"Successful","auto_refund_status":"success"}
*/
die("100");
}
else{
die($response);
}


}




    break;
  
}





?>