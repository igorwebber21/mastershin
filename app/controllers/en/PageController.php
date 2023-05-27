<?php

namespace app\controllers\en;


use ishop\App;
use ishop\Cache;
use RedBeanPHP\R;
use app\controllers\AppController;

class PageController extends AppController
{

  public function viewAction()
  {

    $currPage = R::findOne('pages', 'alias = ?', [$this->route['alias']]);
    $currPage = object_to_array($currPage);

    if($currPage){

      $this->setMeta($currPage['title'].' - Шиномонтаж 4 в Одессе, ул. Весенняя 14',
        $currPage['title'].' - Шиномонтаж в Одессе, ул. Весенняя 14', $currPage['title'].', шиносервис, диски, шины');
    }
    else{
      throw new \Exception("Страница не найдена", 404);
    }

    $this->set(compact('currPage'));

  }

}

?>
