<?php


namespace app\controllers;


use app\controllers\AppController;
use RedBeanPHP\R;

class MainController extends AppController
{
  public function indexAction(){

    $this->set([]);

    $this->setMeta('Майстер Шин - Шиномонтаж в Одесі, вул. Весняна 14',
      'Майстер Шин - професійний шиносервіс та реставрація дисків в Одесі.',
      'реставрація дисків, шиносервіс, шиномонтаж одеса, шиномонтаж, фарбування дисків');

  }

  public function signupAction(){

    $signupMode = 1;
    $this->set(compact('signupMode'));

    $this->setMeta('Запис на прийом у шиномонтаж Майстер Шин - Одеса, вул. Весняна 14',
      'Майстер Шин - професійний шиносервіс та реставрація дисків в Одесі',
      'запис у шиномонтаж, візит у шиномонтаж, реставрація дисків, шиносервіс, шиномонтаж одеса, шиномонтаж, фарбування дисків');

  }
}