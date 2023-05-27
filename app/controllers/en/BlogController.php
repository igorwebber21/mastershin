<?php


namespace app\controllers\en;


use ishop\libs\Pagination;
use RedBeanPHP\R;
use app\controllers\AppController;

class BlogController extends  AppController
{

  public function viewAction()
  {
    $alias = $this->route['alias'];
    $article = R::findOne('articles', "alias = ?", [$alias]);

    $services = R::getAll("SELECT * FROM articles
                                        WHERE status = \"visible\" AND category = '".$article['category']."' ORDER BY orderId");

    $this->setMeta($article['name']." - цена ua в Мастер Шин, Одесса, ул. Весенняя 14",
      $article['name']." - цена в Мастер Шин, Одесса, ул. Весенняя 14",
      mb_strtolower($article['name']).', цена, услуга, шиносервис, шиномонтаж одесса, шиномонтаж, покраска дисков');

    $this->set(compact('article', 'services'));

  }

}