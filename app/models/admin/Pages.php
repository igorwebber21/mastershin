<?php


namespace app\models\admin;

use app\models\AppModel;

class Pages extends AppModel
{

  public $attributes = [
    'title' => '',
    'title_ua' => '',
    'title_en' => '',
    'text' => '',
    'text_ua' => '',
    'text_en' => '',
    'alias' => '',
    'status' => ''
  ];

  public $rules = [
    'required' => [
          ['title'],
          ['title_ua'],
          ['title_en'],
          ['text']
      ]
  ];


}