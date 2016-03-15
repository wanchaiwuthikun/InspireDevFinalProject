<?php

namespace frontend\controllers;

use Yii;
use common\models\Search;
use common\models\SearchAll;
use app\models\Tag;
use frontend\models\Article;
use app\models\ForumAsk;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * SearchController implements the CRUD actions for Search model.
 */
class SearchController extends FrontendController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Search models.
     * @return mixed
     */
    public function actionIndex($search)
    {
            $getsearch = $search;
            $models = Search::find()->joinWith(['tag', 'article'])->where(['tag.title'=>$search, 'status'=>2])->all();
            $models2 = Tag::findOne(['title' => $search]);
            $models3 = Search::find()->joinWith(['tag', 'article'])->where(['tag.title'=>$search, 'status'=>2])->count();



        return $this->render('index', [
            'models' => $models,
            'models2' => $models2,
            'models3' => $models3,
            'modelssearch' => $getsearch,

        ]);
    }
    public function actionVideos($search)
    {
            $getsearch = $search;
            $models = Search::find()->joinWith(['tag', 'videos'])->where(['tag.title'=>$search, 'videos_status_id'=>2])->all();
            $models2 = Tag::findOne(['title' => $search]);
            $models3 = Search::find()->joinWith(['tag', 'videos'])->where(['tag.title'=>$search, 'videos_status_id'=>2])->count();

        return $this->render('videos', [
            'models' => $models,
            'models2' => $models2,
            'models3' => $models3,
            'modelssearch' => $getsearch

        ]);
    }
    public function actionForum($search)
    {
        $getsearch = $search;
        $models = Search::find()->joinWith(['tag'])->where(['tag.title'=>$search])->all();
        $models2 = ForumAsk::find()->all();
        $models3 = Tag::findOne(['title' => $search]);
//        $models4 = Search::find()->joinWith(['tag'])->where(['tag.title'=>$search,])->count();
        $models4 = Search::find('')->joinWith(['tag', 'forumAsk'])->where(['tag.title'=>$search])->count();
        

        return $this->render('forum', [
            'models' => $models,
            'models2' => $models2,
            'models3' => $models3,
            'models4' => $models4,
            'modelssearch' => $getsearch

        ]);
    }

    /**
     * Displays a single Search model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Search model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Search();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Search model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Search model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Search model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Search the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Search::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
