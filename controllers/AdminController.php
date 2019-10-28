<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class AdminController extends Controller
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

        return $this->render('index', [

        ]);
    }

    public function actionDelete()
    {
        $del = Yii::$app->db->createCommand('DELETE FROM message')
            ->execute();

        return $this->render('delete', [
            'del' => $del,
        ]);

    }

    public function actionStats()
    {
        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM message')
            ->queryOne();
        $neu = Yii::$app->db->createCommand('SELECT max(datum) FROM message')
            ->queryOne();
        $alt = Yii::$app->db->createCommand('SELECT min(datum) FROM message')
            ->queryOne();

        return $this->render('stats', [
            'count' => $count,
            'neu' => $neu,
            'alt' => $alt,

        ]);
    }

}
