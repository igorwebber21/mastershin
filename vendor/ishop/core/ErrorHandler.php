<?php


    namespace ishop;

    use app\models\Page;
    use ishop\base\View;
    use RedBeanPHP\R;

    class ErrorHandler extends View
    {

        public function __construct()
        {
            DEBUG ? error_reporting(-1) : error_reporting(0);
            set_exception_handler([$this, "exceptionHandler"]);
        }

        // my error handler method
        public function exceptionHandler($e){
            $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
            $this->displayError("Исключение", $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
        }

        // write errors to file
        protected function logErrors($message = '', $file = '', $line = ''){

            error_log("[". date("d.m.Y H:i:s") . "]
                                Текст ошибки: {$message} | 
                                Файл: {$file} | 
                                Строка: {$line} \n ___________________________________ \n",
                                3, ROOT.'/tmp/errors.log');
        }

        // display errors on site
        protected function displayError($errno, $errstr, $errfile, $errline, $responce = 404){

            http_response_code($responce);

            if(DEBUG){
                $file = "dev.php";
            }
            else{
               $file = ($responce == 404) ? "404.php" : "prod.php";
            }

            $pageModel = new Page();
            $pages = $pageModel->getPages();
            $mainServices = $pageModel->getMainServices();
            
            
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

          // get $dictionary
          $dictionaryDB = object_to_array(R::getAll('SELECT * FROM dictionary')); 

          $dictionary= array();
          if($dictionaryDB){
            foreach ($dictionaryDB as $dictionaryRow){
             $dictionary[$dictionaryRow['keyword']] = $dictionaryRow;
            }
           }

          $lang = 'ru';
          $langUrl = '';

          

            ob_start();
            require WWW."/errors/".$file;
            $content = ob_get_clean();

            require APP . "/views/layouts/mastershin.php";



        }
    }