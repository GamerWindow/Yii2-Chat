<?php

namespace app\controllers;

use app\models\Message;
use yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class MessageController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $messages = Message::find()->orderBy('datum DESC')->all();

        return $this->render('index', [
            "messages" => $messages,
        ]);
    }

    public function actionEingabe()
    {
        $message = new Message();
        Yii::trace("post:" . print_r(Yii::$app->request->post(), true));
        if ($message->load(Yii::$app->request->post())) {
            Yii::trace("message:" . print_r($message->attributes, true));
            if ($message->validate() && $message->save()) {
                Yii::$app->session->setFlash('success', "Danke für deine Nachricht :3");
                return $this->redirect(['message/index']);
            } else {
                Yii::$app->session->setFlash('error', "Eingabe falsch!");
            }
        }
        return $this->render('eingabe', ['message' => $message]);
    }

    public function actionGrid()
    {
        $provider = new ActiveDataProvider([
            'query' => Message::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        // get the posts in the current page
        //$posts = $provider->getModels();

        return $this->render('grid', [
            "provider" => $provider,
        ]);
    }

    public function actionCar()
    {

    }

}
