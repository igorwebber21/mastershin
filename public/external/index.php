<?php  header('Content-type: text/html; charset=utf-8');
/**
 * Данный пример предоставляет возможность отправлять СМС сообщения
 * с подменой номера, просматривать остаток кредитов пользователя,
 * просматривать статус отправленных сообщений.
 * -----------------------------------------------------------------
 * Для работы данного примера необходимо подключить SOAP-расширение.
 */

// Все данные возвращаются в кодировке UTF-8


//echo '<pre>';


try {

  // Подключаемся к серверу
  $client = new SoapClient('http://turbosms.in.ua/api/wsdl.html');

  // Можно просмотреть список доступных методов сервера
  // print_r($client->__getFunctions());

  // Данные авторизации
  $auth = [
    'login' => 'igortest',
    'password' => 'asdc2121'
  ];

  // Авторизируемся на сервере
  $result = $client->Auth($auth);

  // Результат авторизации
  //   echo $result->AuthResult . PHP_EOL;

  // Получаем количество доступных кредитов
  $result = $client->GetCreditBalance();
  //  echo $result->GetCreditBalanceResult . PHP_EOL;

  // Текст сообщения ОБЯЗАТЕЛЬНО отправлять в кодировке UTF-8
  $text = iconv('windows-1251', 'utf-8', 'Тестовое сообщение из turbo sms 22');

  // Отправляем сообщение на один номер.
  // Подпись отправителя может содержать английские буквы и цифры. Максимальная длина - 11 символов.
  // Номер указывается в полном формате, включая плюс и код страны
  $sms = [
    'sender' => 'Best-offer',
    'destination' => '+380936104804',  //+380939379441
    'text' => 'Создай сайт своей мечты - http://megashop.od.ua/.'
  ];
  /* $result = $client->SendSMS($sms);

    var_dump($result);*/



  // Отправляем сообщение на несколько номеров.
  // Номера разделены запятыми без пробелов.
  /*  $sms = [
        'sender' => 'Rassilka',
        'destination' => '+380XXXXXXXX1,+380XXXXXXXX2,+380XXXXXXXX3',
        'text' => $text
    ];
    $result = $client->SendSMS($sms);  */

  // Выводим результат отправки.
//    echo $result->SendSMSResult->ResultArray[0] . PHP_EOL;

  // ID первого сообщения
  //   echo $messID = $result->SendSMSResult->ResultArray[1] . PHP_EOL;

  // ID второго сообщения
  // echo $result->SendSMSResult->ResultArray[2] . PHP_EOL;

  // Отправляем сообщение с WAPPush ссылкой
  // Ссылка должна включать http://
  /* $sms = [
       'sender' => 'Rassilka',
       'destination' => '+380XXXXXXXXX',
       'text' => $text,
       'wappush' => 'http://super-site.com'
   ];
   $result = $client->SendSMS($sms);  */

  // Запрашиваем статус конкретного сообщения по ID
 /* $sms = ['MessageId' => $messID];
  $status = $client->GetMessageStatus($sms);
  echo $status->GetMessageStatusResult . PHP_EOL;*/

} catch(Exception $e) {
  echo 'Ошибка: ' . $e->getMessage() . PHP_EOL;
}
//echo '</pre>';
?>