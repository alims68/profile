<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');



function to_long_xml($longVal) {
  return '<long>' . $longVal . '</long>';
}

function from_long_xml($xmlFragmentString) {
  return (string)strip_tags($xmlFragmentString);
}

function send_sms($to , $text , $isFlash = FALSE)
{
$_user = "pamenary";
$_pass = "123254";
$_from = "30005825000166";
$_web_service = "http://sms.azin-sms.ir/API/send.asmx?WSDL";

    $client = new SoapClient($_web_service,array(
      'typemap' => array(
        array(
          'type_ns' => 'http://www.w3.org/2001/XMLSchema',
          'type_name' => 'long',
          'to_xml' => 'to_long_xml',
          'from_xml' => 'from_long_xml',
        ),
      ),
    ));
    $to = explode(",", $to);
    $status                 = array();
    $recId                  = array();
    $params['username']     = $_user;
    $params['password']     = $_pass;
    $params['from']         = $_from;
    $params['to']           = $to;
    $params['text']         = iconv('UTF-8', 'UTF-8//TRANSLIT',$text);;
    $params['flash']        = $isFlash;
    $params['udh']          = '';
    $params['status']       = $status;
    $params['recId']        = $recId;
    
    $result     = @$client->SendSms($params);
    $SendResult = $result->SendSmsResult;
    
    //$recId      = (array) $result->recId->long;
    return $SendResult;
}