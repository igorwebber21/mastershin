<?php

    namespace app\controllers;

    use app\models\AppModel;
    use app\widgets\currency\Currency;
    use ishop\App;
    use ishop\base\Controller;
    use ishop\Cache;
    use RedBeanPHP\R;

    class AppController extends Controller
    {
        public $responseData = [
            'status' => 0,
            'message' => ''
        ];

        public function __construct($route)
        {
            parent::__construct($route);
            new AppModel();
        }

        public static function sendResponse($data)
        {
            echo json_encode($data);
            exit;
        }

    }