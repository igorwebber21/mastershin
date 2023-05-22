<?php

    namespace app\controllers;

    use app\models\Category;
    use ishop\App;
    use ishop\Router;
    use RedBeanPHP\R as R;
    use ishop\Cache;

    class MainController extends AppController {

//    public $layout = 'test';

        public function indexAction(){

          $this->set([]);

            $this->setMeta('Мастер Шин - Шиномонтаж в Одессе, ул. Весенняя 14',
                      'Мастер Шин - профессиональный шиносервис и реставрация дисков в Одессе',
                       'реставрация дисков, шиносервис, шиномонтаж одесса, шиномонтаж, покраска дисков');

        }

      public function signupAction(){

        $signupMode = 1;
        $this->set(compact('signupMode'));

        $this->setMeta('Запись на прием в шиномонтаж Мастер Шин - Одесса, ул. Весенняя 14',
          'Мастер Шин - профессиональный шиносервис и реставрация дисков в Одессе',
          'запись в шиномонтаж, визит в шиномонтаж, реставрация дисков, шиносервис, шиномонтаж одесса, шиномонтаж, покраска дисков');

      }

    }

