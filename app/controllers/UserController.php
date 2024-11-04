<?php


    namespace app\controllers;


    use app\models\User;
    use RedBeanPHP\R;

    class UserController extends AppController
    {

        private $auth = [
          'login' => 'igortest',
          'password' => 'asdc2121'
        ];

        private $sender = 'Best-Shop';


        public function claimAction(){

          if(!empty($_POST))
          {
            $name = $_POST['userName'];
            $phone = $_POST['userPhone'];
            $message = $_POST['userMessage'];
            $zapisService = $_POST['zapisService'];
            $zapisServiceName = trim($_POST['zapisServiceName']);
            $zapisDate = $_POST['zapisDate'];
            $zapisTime = $_POST['zapisTime'];
            $carModel = $_POST['carModel'];
            $carNumber = $_POST['carNumber'];
            $date = date("Y-m-d H:i:s");

            $sql_part = "('{$name}', '{$phone}', '{$carModel}', '{$carNumber}', '{$message}', '{$date}', '{$zapisService}', '{$zapisDate}', '{$zapisTime}')";
            $res = R::exec("INSERT INTO claims (name, phone, car_model, car_number, message, date, service_id, service_date, service_time) VALUES $sql_part");
            $lastClaimId = R::getInsertID();

            if ($res) {

              $this->responseData['status'] = 1;
              $this->responseData['message'] = 'Вы успешно записались на услугу';

              // Подключаемся к серверу
              $client = new \SoapClient('http://turbosms.in.ua/api/wsdl.html');
              $client->Auth($this->auth);

              $sms = [
                'sender' => $this->sender,
                'destination' => '+380508665607',  //+380939379441
                'text' => $name.' '.$phone.' - запись на прием №'.$lastClaimId
              ];

              $client->SendSMS($sms);

              $sms2 = [
               'sender' => $this->sender,
               'destination' => '+'.preg_replace("/[^0-9]/", '', $phone), //+380939379441
               'text' => 'Вы записаны на услугу "'.$zapisServiceName.'" в шиносервис Мастер шин на '.$zapisDate.' в '.$zapisTime
              ];

              $client->SendSMS($sms2);
            }
            else{
              $this->responseData['status'] = 0;
              $this->responseData['message'] = 'Заявка не отправлена. Попробуйте ещё раз';
            }

            self::sendResponse($this->responseData);
          }

        }

        // Подписаться
        public function subscribeAction()
        {

          if(!empty($_POST['email']))
          {
            $this->responseData['status'] = 1;
            $this->responseData['message'] = 'Вы успешно подписаны на новости';
          }
          else{
            $this->responseData["message"] = 'Ошибка! Проверьте корректность почты';
          }

          self::sendResponse($this->responseData);
        }


        // Регистрация
        public function signupAction()
        {

            if(!empty($_POST))
            {
                $user = new User();
                $user->rules['required'][] = ['password'];
                $user->attributes['password'] = $_POST['password'] ? $_POST['password'] : '';
                $generatedPassword = $user->attributes['password'];

                if(!$user->attributes['password'])
                {
                    $this->responseData["message"] = '<p>Ошибка! Введенные Вами пароли не совпадают</p>';
                    self::sendResponse($this->responseData);
                }

                $user->attributes['email'] = $_POST['email'];
                $user->attributes['login'] = $_POST['login'];
                $user->attributes['fname'] = $_POST['fname'];
                $user->attributes['role'] = $_POST['role'];

               if(!$user->validate($user->attributes) || !$user->checkUnique())
               {
                   $this->responseData['message'] = $user->getErrors();
               }
               else
               {
                   $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
                   $user->attributes['ip_address'] = getUserIP();
                   $user->attributes['ip_location'] = getUserLocation($user->attributes['ip_address']);

                   if ($user->save('user'))
                   {
                       //если зарегистрировали - отправляем Email с данными для входа
                      ///  $user::sendEmailPassword($generatedPassword, $user->attributes);
                        $_SESSION['success'] = 'Изменения сохранены';
                        redirect();
                   }
                   else
                   {
                       $this->responseData['message'] = '<p>Ошибка, не удалось зарегистрироваться. Попробуйте ещё раз</p>';
                   }
               }

              $_SESSION['error'] = $this->responseData['message'];
              redirect();
            }


          $this->set([]);

            $this->setMeta('Регистрация в интернет магазине MegaShop Demo');
        }


        // Авторизация
        public function loginAction()
        {
            if($_POST['userLogin'] && $_POST['userPassword'])
            {
                $user = new User();
                $userData['login'] = $_POST['userLogin'];
                $userData['password'] =  $_POST['userPassword'];

                if($user->login($userData))
                {
                    $this->responseData['status'] = 1;
                    $this->responseData['message'] = 'Вы успешно авторизованы';
                }
                else
                {
                    $this->responseData['message'] = 'Логин/пароль введены неверно';
                }

                self::sendResponse($this->responseData);
            }

            $this->setMeta('Вход');
        }

        // Выход с аккаунта
        public function logoutAction()
        {
            if(isset($_SESSION['user'])) unset($_SESSION['user']);
            redirect(PATH.'/admin');
        }

        // смена пароля
        public function changePasswordAction()
        {
            if(!User::checkAuth())
            {
                $this->responseData['message'] = 'Пожалуйста, авторизуйтесь на сайте';
                self::sendResponse($this->responseData);
            }

            if(!empty($_POST) && isset($_POST['userCurrentPassword']))
            {
              //  debug($_POST,1 );

                $userNewPassword = h($_POST['userNewPassword']);
                $userRepeatPassword = h($_POST['userRepeatPassword']);
                $userCurrentPassword = h($_POST['userCurrentPassword']);

                if($userNewPassword != $userRepeatPassword)
                {
                    $this->responseData['message'] = 'Новые пароли не совпадают';
                    self::sendResponse($this->responseData);
                }

                if($userNewPassword == $userCurrentPassword)
                {
                    $this->responseData['message'] = 'Новый пароль должен быть отличен от старого';
                    self::sendResponse($this->responseData);
                }

                $user = new \app\models\admin\User();
                $user->attributes['id'] = $_SESSION['user']['id'];
                $user->attributes['password'] = $userCurrentPassword;

                if(!$user->checkUserAuth())
                {
                    $this->responseData['message'] = 'Старый пароль введён не верно';
                    self::sendResponse($this->responseData);
                }

                $user->attributes['password'] = password_hash($userNewPassword, PASSWORD_DEFAULT);

                if($user->updateUserPassword()){
                    $this->responseData['message'] = 'Пароль успешно изменён';
                    $this->responseData['status'] = 1;
                    self::sendResponse($this->responseData);
                }

            }

        }

        // восстановление пароля
        public function passwordRecoveryAction()
        {
            if(!empty($_POST) && isset($_POST['emailRecovery']))
            {
                 $email = h($_POST['emailRecovery']);
                 $user = new \app\models\admin\User();

                 if($userData = $user->getUserData($email))
                 {
                     $generatedPassword = $user::generatePassword();

                     $user->attributes['password'] = password_hash($generatedPassword, PASSWORD_DEFAULT);
                     $user->attributes['id'] = $userData['id'];

                     if($user->updateUserPassword())
                     {
                         $user::sendEmailPassword($generatedPassword, $userData);

                         $this->responseData['status'] = 1;
                         $this->responseData['message'] = '<p>Письмо с инструкцией по восстановлению пароля отправлено на почту <strong>'.$email.'</strong></p>';
                         self::sendResponse($this->responseData);
                     }
                     else
                     {
                         $this->responseData['message'] = 'Ошибка, попробуйте позже';
                     }
                 }
                 else{
                     $this->responseData['message'] = 'Аккаунт с почтой '.$email.' не авторизирован на сайте';
                     self::sendResponse($this->responseData);
                 }
            }
        }

        //========== user cabinet  ==========//

    }