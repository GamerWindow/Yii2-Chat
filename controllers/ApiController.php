<?php

namespace app\controllers;

use app\models\Message;
use yii\rest\Controller;

class ApiController extends Controller
{

    public function actionMessage()
    {
        $messages = Message::find()->orderBy('datum DESC')->all();
        return $this->asJson($messages);
    }
}
