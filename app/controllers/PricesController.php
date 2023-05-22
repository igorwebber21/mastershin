<?php


namespace app\controllers;


class PricesController  extends AppController
{
  public function viewAction()
  {
    $this->set([]);

    $this->setMeta('Прайс лист по услугам рестоврации дисков и шиномонтажа',
      'Прайс лист по услугам рестоврации дисков и шиномонтажа',
      'прайс, цены, шиномонтаж, мастершин');
  }
}