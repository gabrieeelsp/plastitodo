<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use SoapClient;

use SimpleXMLElement;
use stdClass;

class WebserviceController extends Controller
{
    public function enviarPeticion(Request $request){
      $url = 'https://secure.softwarekey.com/solo/webservices/XmlCustomerService.asmx?WSDL';
      $client = new SoapClient($url);
      $xmlr = new SimpleXMLElement("<CustomerSearch></CustomerSearch>");
      $xmlr->addChild('AuthorID', 1);
      $xmlr->addChild('UserID', 'mchojrin');
      $xmlr->addChild('UserPassword', '1234');
      $xmlr->addChild('Email', 'mauro.chojrin@leewayweb.com');return $xmlr;
      $params = new stdClass();
      $params->xml = $xmlr->asXML();
      $result = new SimpleXMLElement($client->CustomerSearchS($params)->CustomerSearchSResult->any);
      $r = current($result->xpath('/Customers/ResultCode'));
      if ( $r == '-1' ) {
              return 'Fallo: '.$result->xpath('/Customers/ErrorMessage')[0];
      } else {
              return 'Exito!';
      }

    }

    public function enviarPeticionAdd(Request $request){

      $opts = array(
        'ssl' => array('ciphers'=>'RC4-SHA', 'verify_peer'=>false, 'verify_peer_name'=>false)
      );
      $params = array ('encoding' => 'UTF-8', 'verifypeer' => false, 'verifyhost' => false, 'soap_version' => SOAP_1_2, 'trace' => 1, 'exceptions' => 1, "connection_timeout" => 180, 'stream_context' => stream_context_create($opts) );
      $url = 'http://www.dneonline.com/calculator.asmx?WSDL';
      try{
          $client = new SoapClient($url,$params);

          $result = $client->Add(['intA' => 12, 'intB' => 232]);
          //dd($result->AddResult);
          //dd(compact('result')['result']->AddResult);

          $result = $client->Multiply(['intA' => 12, 'intB' => 232]);
          dd($result->MultiplyResult);


          dd($client->__getTypes());
      }
      catch(SoapFault $fault) {
          echo '<br>'.$fault;
      }

    }

    public function enviarPeticionOtro(Request $request){

      $opts = array(
        'ssl' => array('ciphers'=>'RC4-SHA', 'verify_peer'=>false, 'verify_peer_name'=>false)
      );
      $params = array ('encoding' => 'UTF-8', 'verifypeer' => false, 'verifyhost' => false, 'soap_version' => SOAP_1_2, 'trace' => 1, 'exceptions' => 1, "connection_timeout" => 180, 'stream_context' => stream_context_create($opts) );
      $url = 'http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL';
      try{
          $client = new SoapClient($url,$params);
          $result = $client->CountryCurrency(['sCountryISOCode' => 'ARs']);
          dd($result);
          dd($client->__getTypes());

          $result = $client->Add(['intA' => 12, 'intB' => 232]);
          //dd($result->AddResult);
          //dd(compact('result')['result']->AddResult);

          $result = $client->Multiply(['intA' => 12, 'intB' => 232]);
          dd($result->MultiplyResult);



      }
      catch(SoapFault $fault) {
          echo '<br>'.$fault;
      }

    }
}
