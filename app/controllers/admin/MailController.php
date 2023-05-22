<?php

namespace app\controllers\admin;

use app\models\admin\Blog;
use app\models\AppModel;
use ishop\App;
use ishop\Cache;
use ishop\libs\Pagination;
use RedBeanPHP\R;
use RedBeanPHP\RedException\SQL;
use Swift_Attachment;

class MailController extends AppController
{

  public function indexAction()
  {
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perpage = 15;
    $count = R::count('claims');
    $pagination = new Pagination($page, $perpage, $count);
    $start = $pagination->getStart();

    $claims = R::getAll("SELECT claims.*, articles.name AS service_name  FROM claims 
                              LEFT JOIN articles 
                              ON articles.id = claims.service_id
                              ORDER BY claims.id DESC LIMIT $start, $perpage");
   // debug($mails);
    $this->setMeta('Список заявок');
    $this->set(compact('claims', 'count', 'pagination'));

  }

  public function addAction()
  {
    $mail_template = R::getRow("SELECT * FROM mail_templates WHERE id = 1");

    if(!empty($_POST))
    {
      $receiver = $_POST['name'];
      $subject = $_POST['title'];
      $message = $_POST['text'];
      $date = date("Y-m-d H:i:s");

      $res = self::sendMail($_POST['name'], $_POST['title'], $_POST['text']);

      if($res == 1){
        $sql_part = "('{$receiver}', '{$subject}', '{$message}', 'yes', '{$date}')";
        R::exec("INSERT INTO mails (receiver, subject, message, status, date) VALUES $sql_part");
        $_SESSION['success'] = 'Письмо отправлено';
      }
      else{
        $sql_part = "('{$receiver}', '{$subject}', '{$message}', 'no', '{$date}')";
        R::exec("INSERT INTO mails (receiver, subject, message, status, date) VALUES $sql_part");
        $_SESSION['error'] = 'Ошибка, попробуйте ещё раз!';
      }

      redirect();
    }

    $this->setMeta('Отправка mail');
    $this->set(compact('mail_template'));

  }

  public function changeAction()
  {
    $claim_id = $this->getRequestID();
    $confirm = !empty($_GET['status'])  && $_GET['status'] == 1 ? 'yes' : 'no';
    R::exec( "UPDATE claims SET confirm='{$confirm}' WHERE id = {$claim_id}");

    $_SESSION['success'] = 'Изменения сохранены';
    redirect();
  }

  public function editAction()
  {

    if(!empty($_POST))
    {
      $id = $this->getRequestID(false);
      $blog = new Blog();
      $data = $_POST;
      $blog->load($data);
      $blog->getImages();

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

    unset($_SESSION['blog_img_preview']);
    unset($_SESSION['blog_img_full']);

    $id = $this->getRequestID();
    $article = R::load('articles', $id);
    $this->setMeta("Редактирование статьи {$article->name}");
    $this->set(compact('article'));
  }

  public function deleteAction()
  {
    $article_id = $this->getRequestID();
    $claims = R::load('claims', $article_id);
    R::trash($claims);

    $_SESSION['success'] = 'Заявка удалена';
    redirect(ADMIN . '/mail');
  }

  public static function sendMail($receiver, $subject, $message)
  {
    // https://mail.ukr.net/


    //============================= send email by SwiftMailer =======================================//
    $transport = (new \Swift_SmtpTransport(App::$app->getProperty('smtp_host'),
      App::$app->getProperty('smtp_port'), App::$app->getProperty('smtp_protocol')))
      ->setUsername(App::$app->getProperty('smtp_login'))
      ->setPassword(App::$app->getProperty('smtp_password'));

    $mailer = new \Swift_Mailer($transport);

    $messageClient = (new \Swift_Message($subject))
      ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('shop_name')])
      ->setTo($receiver)
      ->setBody($message, 'text/html')
      ->attach(Swift_Attachment::fromPath(PATH.'/files/Kommercheskoe_predlozhenie_MEGASHOP.pdf'));

    // Send a message
    $result = $mailer->send($messageClient);
    //============================= send email by SwiftMailer =======================================//

    return ($result == 1) ? 1 : 0;

  }

}