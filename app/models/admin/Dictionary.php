<?php


namespace app\models\admin;

use app\models\AppModel;

class Dictionary extends AppModel
{

  public $attributes = [
    'keyword' => '',
    'ru' => '',
    'ua' => '',
    'en' => ''
  ];

  public $rules = [
    'required' => [
      ['keyword'],
      ['ru'],
      ['ua'],
      ['en']
    ]
  ];


}