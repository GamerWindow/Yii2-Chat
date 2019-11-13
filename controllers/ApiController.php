<?php

namespace app\controllers;

use app\models\Message;
use Yii;
use yii\web\Controller;

class ApiController extends Controller
{
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [

            // For cross-domain AJAX request
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors' => [
                    // restrict access to domains:
                    'Origin' => ["*"],
                    'Access-Control-Allow-Origin' => true,
                    // 'Access-Control-Request-Method' => ['POST'],
                    // 'Access-Control-Allow-Credentials' => true,
                    // 'Access-Control-Max-Age' => 3600, // Cache (seconds)
                ],
            ],

        ]);
    }

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

    public function actionStats()
    {
        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM message')
            ->queryOne();
        $neu = Yii::$app->db->createCommand('SELECT max(datum) FROM message')
            ->queryOne();

        $alt = Yii::$app->db->createCommand('SELECT min(datum) FROM message')
            ->queryOne();
        echo '<p> Es sind bereits ' . $count . ' Nachrichten.</p>';
        echo '<p>Die neueste Nachricht ist vom: ' . $neu . '</p>';
        echo '<p>Die älteste Nachricht ist vom: ' . $alt . '</p>';

    }

    public function actionDeletepost($datum)
    {

        $data = $datum;
        Yii::trace("datum=" . $data);
        $numDeleted = Message::deleteAll(['datum' => $datum]);
        return $this->asJson(["succes" => $numDeleted >= 1]);

        /*$data = Message::find()->where('datum =' . $datum)->all();
    foreach ($data as $dat) {
    $dat->delete();
    }*/
    }

    public function actionHello()
    {

        return $this->asJson(["text" => "hello"]);

    }
}
