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

    $this->setMeta($article['name_en']." - price Master Shin, Odessa, st. Spring 14",
      $article['name_en']." - price in Master Shin, Odessa, st. Spring 14",
      mb_strtolower($article['name_en']).', price, service, tire service, tire fitting Odessa, tire fitting, wheel painting');

    $this->set(compact('article', 'services'));

  }

}