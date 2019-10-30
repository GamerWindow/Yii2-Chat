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
    public function actionNewmessage($inhalt, $name)
    {
        $message = new Message();
        $message->name = $name;
        $message->inhalt = $inhalt;
        if ($message->save()) {
            $ok = true;
        } else {
            $ok = false;
        }
        $messages = Message::find()->orderBy('datum DESC')->all();
        return $this->asJson(["succes" => $ok]);
    }
}
