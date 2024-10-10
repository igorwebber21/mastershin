<?php

    namespace ishop\base;

    use ishop\Router;
    use RedBeanPHP\R;

    abstract class Controller
    {
        public $route;
        public $controller;
        public $view;
        public $model;
        public $prefix;
        public $layout;
        public $data = [];
        public $meta = ['title' => '', 'description' => '', 'keywords' => ''];

        public function __construct($route)
        {
        //  debug($route, 1);
            $this->route = $route;
            $this->controller = $route['controller'];
            $this->model = $route['controller'];
            $this->view = $route['action'];
            $this->prefix =  $route['prefix'];
        }

        public function getView(){
            $viewObject = new View($this->route, $this->layout, $this->view, $this->meta);
            $viewObject->render($this->data);
        }

        public function set($data)
        {
            date_default_timezone_set('Europe/Kiev');

            $this->data = $data;
            $router = new Router(); 
            $this->data['pages'] = object_to_array(R::getAll('SELECT title, title_ua, title_en, alias FROM pages WHERE status = "visible" ORDER BY orderId'));
            $this->data['currRoute'] = $router::getRoute();
            $this->data['mainServices'] = object_to_array(R::getAll("SELECT * FROM articles WHERE status = \"visible\" ORDER BY orderId"));
//debug($this->data['currRoute'], 1);
            $servicesNotSend = R::getAll("SELECT claims.*, articles.name AS service_name  FROM claims
                               LEFT JOIN articles 
                               ON articles.id = claims.service_id
                               WHERE send_notify = \"no\" ORDER BY id");
            //  confirm = "yes" AND


            // get $dictionary
            $dictionaryDB = object_to_array(R::getAll('SELECT * FROM dictionary'));

            $this->data['dictionary'] = array();
            if($dictionaryDB){
              foreach ($dictionaryDB as $dictionaryRow){
                $this->data['dictionary'][$dictionaryRow['keyword']] = $dictionaryRow;
              }
            }

            $this->data['lang'] = $this->route['prefix'] ? trim($this->route['prefix'], '\\') : 'ua';
            $this->data['langUrl'] = $this->route['prefix'] ? trim($this->route['prefix'], '\\') : '';

            // zapis na priem
            $nowHours = date("H");
            $nowDate = date('d.m.Y');
            $nextDay = ($nowHours >= 19) ? true : false; // 7 >= $nowHours || 
            $zapisDate = $nextDay ? date("d.m.Y", strtotime("+1 day"))
              : date('d.m.Y');

            for($t=8; $t<=19; $t++)
            {
              $res = ($t > $nowHours || $nextDay) ? 1 : 0;
              $timeIntervals[$zapisDate][] = ['time' => $t.':00', 'res' => $res];
            }

            $servicesNotSendArr = [];
            if($servicesNotSend)
            {
                foreach ($servicesNotSend as $item)
                {
                  $servicesNotSendArr[$item['service_date']][] = $item['service_time'];
                }
            }

            if($servicesNotSendArr)
            {
              foreach ($servicesNotSendArr as $itemDate => $itemsTime)
              {
                if ($itemDate == $zapisDate) unset($timeIntervals[$zapisDate]);

                for ($t = 8; $t <= 19; $t++)
                {
                  $res = 1;
                  
                  if ($itemDate == $zapisDate) {
                    $res = ($t > $nowHours || $nextDay) ? 1 : 0;
                  }

                  foreach ($itemsTime as $itemTime)
                  {
                    if ($t.':00' == $itemTime) {
                      $res = 0;
                    }
                  }
                  $timeIntervals[$itemDate][] = ['time' => $t . ':00', 'res' => $res];
                }
              }
            }

            $this->data['timeIntervals'] = $timeIntervals;
            $this->data['zapisDate'] = $zapisDate;
            $this->data['nowDate'] = $nowDate;
            $this->data['nowHours'] = $nowHours;
        }

        public function setMeta($title = '', $description = '', $keywords = ''){
            $this->meta['title'] = h($title);
            $this->meta['description'] = h($description);
            $this->meta['keywords'] = h($keywords);
        }


        public function isAjax() {
            return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
        }

        public function loadView($view, $vars = []){
            extract($vars);
            require APP . "/views/{$this->prefix}{$this->controller}/{$view}.php";
            // session_destroy();
           // debug($_SESSION);
            die;
        }

        public function loadViews($view, $vars = [])
        {
            ob_start();

            extract($vars);
            require APP . "/views/{$this->prefix}{$this->controller}/{$view}.php";

            $content = ob_get_clean();

            return $content;
        }


    }