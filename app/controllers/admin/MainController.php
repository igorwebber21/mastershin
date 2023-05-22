<?php


namespace app\controllers\admin;


use RedBeanPHP\R;

class MainController extends AppController
{
    public function indexAction()
    {
        $countServices = R::count('articles'); //услуги
        $countPages = R::count('pages');
        $countUserRequests = R::count('claims');

        $this->set(compact('countServices', 'countPages', 'countUserRequests'));

        $this->setMeta('Админ панель');
    }
}