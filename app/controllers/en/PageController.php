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

      $this->setMeta($currPage['title_en'].' - Tire fitting in Odessa, st. Spring 14',
        $currPage['title_en'].' - Tire fitting in Odessa, st. Spring 14', $currPage['title'].', tire service, rims, tires');
    }
    else{
      throw new \Exception("Page not found", 404);
    }

    $this->set(compact('currPage'));

  }

}

?>
