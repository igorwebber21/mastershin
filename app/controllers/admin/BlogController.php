<?php


namespace app\controllers\admin;


use app\models\admin\Blog;
use app\models\AppModel;
use ishop\App;
use ishop\Cache;
use ishop\libs\Pagination;
use RedBeanPHP\R;
use RedBeanPHP\RedException\SQL;

class BlogController extends AppController
{

  public function indexAction()
  {
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perpage = 15;
    $count = R::count('articles');
    $pagination = new Pagination($page, $perpage, $count);
    $start = $pagination->getStart();
    $articles = R::getAll("SELECT * FROM articles
                                     ORDER BY orderId LIMIT $start, $perpage");

    $this->setMeta('Список статей');
    $this->set(compact('articles', 'pagination', 'count'));

  }

  public function sortAction(){

    if(isset($_POST) && $_POST['action'] == 'sortGrid'){

      if($_POST['data']){
        foreach ($_POST['data'] as $id => $sortId){
          $res = R::exec("UPDATE articles SET orderId = $sortId WHERE id = $id");
        }
      }

      echo 1;
      exit;
    }
  }

  public function addAction()
  {
    if(!empty($_POST))
    {
      $blog = new Blog();
      $data = $_POST;
      $blog->load($data);
      $blog->attributes['date_add'] = date('Y-m-d H:i');
      $blog->attributes['status'] = $blog->attributes['status'] ? 'visible' : 'hidden';

      if(!$blog->validate($data))
      {
        $blog->getErrors();
      }
      if($id = $blog->save('articles'))
      {
        $alias = AppModel::createAlias('articles', 'alias', $data['name'], $id);
        $loadedArticle = R::load('articles', $id);
        $loadedArticle->alias = $alias;
        R::store($loadedArticle);

        $_SESSION['success'] = 'Статья добавлена';
      }

      redirect(ADMIN.'/blog/add');
    }
    $this->setMeta('Новая статья');
  }

  public function editAction()
  {

    if(!empty($_POST))
    {
      $id = $this->getRequestID(false);
      $blog = new Blog();
      $data = $_POST;
      $blog->load($data);
      $blog->attributes['status'] = $blog->attributes['status'] ? 'visible' : 'hidden';

      if(!$blog->validate($data)){
        $blog->getErrors();
        redirect();
      }

      if($blog->update('articles', $id))
      {
        $alias = AppModel::createAlias('articles', 'alias', $data['name'], $id);
        $loadedArticle = R::load('articles', $id);
        $loadedArticle->alias = $alias;
        R::store($loadedArticle);

        $_SESSION['success'] = 'Изменения сохранены';
        redirect();
      }
    }

    $id = $this->getRequestID();
    $article = R::load('articles', $id);
    $this->setMeta("Редактирование статьи {$article->name}");
    $this->set(compact('article'));
  }

  public function deleteAction()
  {
    $article_id = $this->getRequestID();
    $article = R::load('articles', $article_id);
    R::trash($article);

    $_SESSION['success'] = 'Статья удалена';
    redirect(ADMIN . '/blog');
  }



}