<?php


namespace app\controllers;


use RedBeanPHP\R;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

class MailController extends AppController
{

  public $auth = [
    'login' => 'igortest',
    'password' => 'asdc2121'
  ];

  public function checkAction()
  {
    date_default_timezone_set('Europe/Kiev');

    $services = R::getAll("SELECT claims.*, articles.name AS service_name  FROM claims
                               LEFT JOIN articles 
                               ON articles.id = claims.service_id
                               WHERE confirm = \"yes\" AND send_notify = \"no\" ORDER BY id");

    $now = strtotime(date("d-m-Y H:i"));
    echo date("d-m-Y H:i"); echo "<br/>";


    if($services)
    {
      // Подключаемся к серверу
      $client = new \SoapClient('http://turbosms.in.ua/api/wsdl.html');
      $res = $client->Auth($this->auth);
      var_dump($res);

      foreach ($services as $service)
      {
       $claimDate = strtotime(str_replace('.', '-', $service['service_date'].' '.$service['service_time']));

       echo round(($claimDate - $now)/3600, 2);
       echo " часа осталось <br/>";

       // send notification if < 1 hour
       $hourDif = round(($claimDate - $now)/3600, 2);
       if($hourDif < 1 && $hourDif > 0)
       {
           $sms = [
             'sender' => 'MasterShin',
             'destination' => '+'.preg_replace("/[^0-9]/", '', $service['phone']),  //+380939379441
             'text' => 'До визита в шиномонтаж Мастер Шин: 1 час. Наш сайт - mastershin.od.ua'
           ];
             /*  'До визита в шиномонтаж Мастер Шин: 1 час. '.str_replace('/', '.', $service['service_date']).'
                на '.$service['service_time'].' Наш сайт - https://mastershin.od.ua/'*/

           $result = $client->SendSMS($sms);
           // debug($sms); debug($result);
           if($result->SendSMSResult->ResultArray[0] == "Сообщения успешно отправлены")
           {
             $serviceId =  $service['id'];
             R::exec("UPDATE claims SET send_notify = 'yes' WHERE id = $serviceId");
           }
       }

      }
    }


    debug($services);

    $test = json_encode($services);

    $this->responseData['status'] = 1;
    $this->responseData['message'] = $test;


    self::sendResponse($this->responseData);
exit;
  }


}