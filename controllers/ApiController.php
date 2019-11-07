<?php

namespace app\controllers;

use app\models\Message;
use Yii;
use yii\rest\Controller;

class ApiController extends Controller
{

    public function actionMessages()
    {
        $anzahl = Yii::$app->request->post('anzahl');
        Yii::trace("post:" . print_r(Yii::$app->request->post(), true));
        $messages = Message::find()->orderBy('datum DESC')->limit($anzahl)->all();
        return $this->asJson($messages);
    }

    public function actionNewmessage($name, $inhalt)
    {
        Yii::trace("post:" . print_r(Yii::$app->request->post(), true));
        $message = new Message();
        $message->name = $name;
        $message->inhalt = $inhalt;
        if ($message->save()) {
            $ok = true;
        } else {
            $ok = false;
        }
        return $this->asJson(["succes" => $ok]);
    }

    public function actionPostmessage()
    {

        Yii::trace("post:" . print_r(Yii::$app->request->post(), true));
        $request = Yii::$app->request;
        $name = $request->post('name');
        $inhalt = $request->post('inhalt');

        $message = new Message();
        $message->name = $name;
        $message->inhalt = $inhalt;
        if ($message->save()) {
            $ok = true;
        } else {
            $ok = false;
        }
        return $this->asJson(["succes" => $ok]);
    }
}
