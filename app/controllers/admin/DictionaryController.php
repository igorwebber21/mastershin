<?php


namespace app\controllers\admin;


use app\models\admin\Blog;
use app\models\admin\Dictionary;
use app\models\AppModel;
use ishop\App;
use ishop\Cache;
use ishop\libs\Pagination;
use RedBeanPHP\R;
use RedBeanPHP\RedException\SQL;

class DictionaryController extends AppController
{

  public function indexAction()
  {
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perpage = 150;
    $count = R::count('dictionary');
    $pagination = new Pagination($page, $perpage, $count);
    $start = $pagination->getStart();
    $dictionaryAdmin = R::getAll("SELECT * FROM dictionary
                                     ORDER BY id DESC LIMIT $start, $perpage");

    $this->setMeta('Список слов');
    $this->set(compact('dictionaryAdmin', 'pagination', 'count', 'perpage', 'page'));

  }

  public function sortAction()
  {

    if (isset($_POST) && $_POST['action'] == 'sortGrid') {

      if ($_POST['data']) {
        foreach ($_POST['data'] as $id => $sortId) {
          $res = R::exec("UPDATE articles SET orderId = $sortId WHERE id = $id");
        }
      }

      echo 1;
      exit;
    }
  }

  public function addAction()
  {
    if (!empty($_POST)) { //debug($_POST, 1);
      $dictionary = new Dictionary();
      $data = $_POST;
      $dictionary->load($data);

      if (!$dictionary->validate($data)) {
        $dictionary->getErrors();
      }
      if ($id = $dictionary->save('dictionary')) {

        $_SESSION['success'] = 'Слово добавлено';
      }

      redirect(ADMIN . '/dictionary/add');
    }
    $this->setMeta('Новое слово');
  }

  public function editAction()
  {

    if (!empty($_POST)) {  //debug($_POST, 1);
      $id = $this->getRequestID(false);

      $dictionary = new Dictionary();
      $data = $_POST;
      $dictionary->load($data);

      if (!$dictionary->validate($data)) {
        $dictionary->getErrors();
        redirect();
      }

      if ($dictionary->update('dictionary', $id)) {

        $_SESSION['success'] = 'Изменения сохранены';
        redirect();
      }
    }

    $id = $this->getRequestID();
    $dictionaryAdmin = R::load('dictionary', $id);
    $this->setMeta("Редактирование слова {$dictionaryAdmin->keyword}");
    $this->set(compact('dictionaryAdmin'));
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