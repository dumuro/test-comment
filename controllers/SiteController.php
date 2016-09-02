<?php

namespace app\controllers;

use app\models\Comments;
use app\models\Topic;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * Class SiteController
 * @package app\controllers
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
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
        $model = new Topic();
        $dataProvider = $model->search();

        return $this->render('index',[
            'model' => $model,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        /** @var $model Topic */
        $model = Topic::find()->where(['id' => $id, 'is_published' => 1])->one();
        if( $model === null )
            throw new NotFoundHttpException('Статья не найдна');

        $comments = new Comments();
        $search   = $comments->search($model->id);

        return $this->render('view',[
            'model' => $model,
            'comments' => $comments,
            'search' => $search
        ]);
    }
}
