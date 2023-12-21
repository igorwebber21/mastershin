<?php


namespace app\models\admin;

use app\models\AppModel;
use ishop\App;
use ishop\libs\Thumbs;

class Blog extends AppModel
{

  public $attributes = [
    'name' => '',
    'name_ua' => '',
    'name_en' => '',
    'category' => '',
    'text' => '',
    'text_ua' => '',
    'text_en' => '',
    'alias' => '',
    'status' => ''
  ];

  public $rules = [
    'required' => [
      'name',
      'name_ua',
      'name_en'
    ]
  ];


}