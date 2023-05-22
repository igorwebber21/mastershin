<?php


namespace app\models\admin;

use app\models\AppModel;
use ishop\App;
use ishop\libs\Thumbs;

class Blog extends AppModel
{

  public $attributes = [
    'name' => '',
    'category' => '',
    'text' => '',
    'alias' => '',
    'status' => ''
  ];

  public $rules = [
    'required' => [
      'name'
    ]
  ];


}