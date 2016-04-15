<?php

namespace app\modules\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public $layout = 'backend';
    public function actionIndex()
    {
        return $this->render('index');
    }
}
