<?php


namespace app\controllers\ua;


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

    $this->setMeta($article['name_ua']." - ціна у Майстер Шин, Одеса, вул. Весняна 14",
      $article['name_ua']." - ціна в Майстер Шин, Одеса, вул. Весняна 14",
      mb_strtolower($article['name_ua']).', ціна, послуга, шиносервіс, шиномонтаж одеса, шиномонтаж, фарбування дисків');

    $this->set(compact('article', 'services'));

  }

}