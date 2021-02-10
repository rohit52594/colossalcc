<?php
function sendsms($mobileno, $template, $variables){
    $vars1 = '';
    $total = count($variables);
    foreach ($variables as $key => $value) {
        $vars1 .= '&'.$key.'='.$value;
    }
    $sender = 'BUYSRA';
    $api = '';
    $baseurl = 'https://2factor.in/API/R1/?module=TRANS_SMS&apikey='.$api.'&to='.$mobileno.'&from='.$sender.'&templatename='.$template.$vars1;
    // var1=VAR1_VALUE&var2=VAR2_VALUE'
    // echo $baseurl;
    $url = $baseurl;    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Use file get contents when CURL is not installed on server.
    if(!$response){
        $response = file_get_contents($url);
    } 
}
function saleIdGenerate($n) { 
    $ci =& get_instance();
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz'; 
    $randomString = '';
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    }
    $ifExists = $ci->Crud->Count('orders', " `ukey` = '$randomString'");
    if ($ifExists > 0) {
        saleIdGenerate(16);
    } else {
        return $randomString; 
    }
  }
  
  function trackingIdGenerate($n) { 
    $ci =& get_instance();
    $characters = '0123456789'; 
    $randomString = '';
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    }
    $ifExists = $ci->Crud->Count('parcels', " `tracking_id` = '$randomString'");
        if ($ifExists > 0) {
            trackingIdGenerate(8);
        } else {
            return $randomString; 
        }
  }
?>