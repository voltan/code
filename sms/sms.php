<?php
// turn off the WSDL cache
ini_set("soap.wsdl_cache_enabled", "0");
  try {

$client = new SoapClient("http://sms1000.ir/webservice/sms.asmx?wsdl");

$origtext = "mississippi";

print("The original text : $origtext");
    $parameters['uUsername'] = "";
    $parameters['uPassword'] = "";
    $parameters['uNumber'] = "";
    $parameters['uCellphones'] = "";
    $parameters['uMessage'] = "";
    $parameters['uFarsi'] = "True";
echo $client->getInfo(array("uUsername"=>"yourname","uPassword"=>"your password"))->getInfoResult;
echo $client->doSendSMS($parameters)->doSendSMSResult;

print_r($output);
echo '<pre>'.htmlspecialchars($soap->request).'</pre>';
echo '<pre>'.htmlspecialchars($soap->response).'</pre>';
 } catch (SoapFault $ex) {
    echo $ex->faultstring;
}
// http://smsonline.ir/post/send.asmx
?>