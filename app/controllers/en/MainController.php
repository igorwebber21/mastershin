<?php


namespace app\controllers\en;


use app\controllers\AppController;
use RedBeanPHP\R;

class MainController extends AppController
{
  public function indexAction(){

    $this->set([]);

    $this->setMeta('Master Shin - Tire fitting in Odessa, st. Spring 14',
      'Master Shin - professional tire service and wheel restoration in Odessa',
      'disk restoration, tire service, tire fitting Odessa, tire fitting, wheel painting');

  }

  public function signupAction(){

    $signupMode = 1;
    $this->set(compact('signupMode'));

    $this->setMeta('Make an appointment at the tire fitting Master Shin - Odessa, st. Spring 14',
      'Master Tire - professional tire service and wheel restoration in Odessa',
      'recording in a tire fitting, a visit to a tire fitting, wheel restoration, tire service, tire fitting Odessa, tire fitting, wheel painting');

  }
}