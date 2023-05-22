<?php

namespace app\models;

use RedBeanPHP\R;

class Page extends AppModel {

  public function getPages()
  {
    return object_to_array(R::getAll('SELECT * FROM pages WHERE status = "visible" ORDER BY orderId'));
  }

  public function getMainServices()
  {
    return object_to_array(R::getAll("SELECT * FROM articles WHERE status = \"visible\" ORDER BY orderId"));
  }

}