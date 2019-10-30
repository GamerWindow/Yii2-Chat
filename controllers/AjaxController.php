<?php

namespace app\controllers;

use app\models\Message;
use yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class AjaxController extends Controller
{

    public function actionIndex()
    {

        $messages = Message::find()->orderBy('datum DESC')->all();

        $message = new Message();
        Yii::trace("post:" . print_r(Yii::$app->request->post(), true));
        if ($message->load(Yii::$app->request->post())) {
            Yii::trace("message:" . print_r($message->attributes, true));
            if ($message->validate() && $message->save()) {
                Yii::$app->session->setFlash('success', "Danke für deine Nachricht :3");
                //return $this->redirect(['ajax/index']);
            } else {
                Yii::$app->session->setFlash('error', "Eingabe falsch!");
            }
        }
        return $this->render('index', [
            'messages' => $messages,
            'message' => $message,
        ]);

    }

    public function actionLinkForm()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            $res = array(
                'body' => print_r($_POST, true),
                'success' => true,
            );

            return $res;
        }
    }

    public function actionAjax()
    {
        $message = new Message();
        Yii::trace("post:" . print_r(Yii::$app->request->post(), true));
        if ($message->load(Yii::$app->request->post())) {
            Yii::trace("message:" . print_r($message->attributes, true));
            if ($message->validate() && $message->save()) {
                Yii::$app->session->setFlash('success', "Danke für deine Nachricht :3");
                //return $this->redirect(['ajax/ajax']);
            } else {
                Yii::$app->session->setFlash('error', "Eingabe falsch!");
            }
        }

        yii::trace("queryparams:" . print_r(yii::$app->request->queryParams, true));

        $provider = new ActiveDataProvider([
            'query' => Message::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => ['defaultOrder' => ['datum' => SORT_DESC]],
        ]);

        // get the posts in the current page
        //$posts = $provider->getModels();

        return $this->render('ajax', [
            'message' => $message,
            "provider" => $provider,
        ]);
    }

}
