<?php

namespace frontend\controllers;

use Yii;
use app\models\Videos;
use common\models\Course;
use common\models\CourseSearch;
use app\models\Tag;
use common\models\Search;
use common\models\VideosStatus;
use frontend\models\VideosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\helpers\StringHelper;



/**
 * VideosController implements the CRUD actions for Videos model.
 */
class VideosController extends FrontendController
{

    /**
     * Lists all Videos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VideosSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Displays a single Videos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionLesson() {
        $query = Course::find()->where(['category_id' => 1 ]);


        $pagination = new Pagination([
            'defaultPageSize' => 12,
            'totalCount' => $query->count(),
        ]);

        $model = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('lesson', [
            'models' => $model,
            'pagination' => $pagination,
        ]);
    }

    public function actionShow($id) {

        $query = Videos::find()->where(['course_id' => $id, 'videos_status_id' => 2]);
//        $model = $query->orderBy('id')->all();
        $model2 = Course::findOne($id);
        $model3 = Search::find()->joinWith(['tag','videos'])->groupBy(['search.videos_id','tag.id'])->all();
        $pagination = new Pagination([
            'defaultPageSize' => 1,
            'totalCount' => $query->count(),
        ]);
        $model = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();


        return $this->render('show', [
            'models' =>  $model,
            'models2' => $model2,
            'models3' => $model3,
            'pagination' => $pagination,

        ]);
    }

    public function actionShowdetail($id) {

        $model = Videos::findOne($id);
        $model2 = Search::find()->joinWith(['tag','videos'])->groupBy(['search.videos_id','tag.id'])->all();

        return $this->render('showdetail', [
            'models' => $model,
            'models2' => $model2,


        ]);
    }

    /**
     * Creates a new Videos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Videos();
        $model->user_id = Yii::$app->user->id;
        $model2 = new Tag();
        $query = new Course();
        $model3 = Course::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

                $video_last_id = Yii::$app->db->getLastInsertID();
            $video_url = Videos::findOne(['id' => $video_last_id]);
            $video_url->url = StringHelper::byteSubstr($model->url,32);
            $video_url->save();

                if ($model2->load(Yii::$app->request->post())) {
                    $tag_title = StringHelper::explode($model2->title, ',');

                    foreach ($tag_title as $tag_title_value) {
                        $search = new Search();
                        $model_tmp = $model2->findOne(['title' => $tag_title_value]);
                        $search->tag_id = $model_tmp->id; // tag id from search by title
                        $search->videos_id = $video_last_id;
                        $search->save();
                    }
                }
            Yii::$app->getSession()->setFlash('alert',[
                'body'=>'การอัพโหลดวิดีโอของคุณเสร็จสิ้น...รอการตรวจสอบจากผู้ดูแลระบบ',
                'options'=>['class'=>'alert-success']
            ]);
            return $this->redirect(['status', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'model2' => $model2,
                'model3' => $model3,
            ]);
        }
    }
    public function actionCreateadmin()
    {
        $model = new Videos();
        $model->user_id = Yii::$app->user->id;
        $model2 = new Tag();
        $query = new Course();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $video_last_id = Yii::$app->db->getLastInsertID();

            if ($model2->load(Yii::$app->request->post())) {
                $tag_title = StringHelper::explode($model2->title, ',');

                foreach ($tag_title as $tag_title_value) {
                    $search = new Search();
                    $model_tmp = $model2->findOne(['title' => $tag_title_value]);
                    $search->tag_id = $model_tmp->id; // tag id from search by title
                    $search->videos_id = $video_last_id;
                    $search->save();
                }
            }
            Yii::$app->getSession()->setFlash('alert',[
                'body'=>'บันทึกเรียบร้อย..',
                'options'=>['class'=>'alert-success']
            ]);
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('formadmin', [
                'model' => $model,
                'model2' => $model2,

            ]);
        }
    }

    /**
     * Updates an existing Videos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model2 = new Tag();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'model2' => $model2,
            ]);
        }
    }
    public function actionUpdateadmin($id)
    {
        $model = $this->findModel($id);
        $model2 = new Tag();
        $model3 = Search::find()->joinWith(['tag','videos'])->where(['search.videos_id' => $id])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $video_last_id = $model->id;

                if ($model2->load(Yii::$app->request->post()) && !empty($model2->title)) {
                    $del = Search::deleteAll(['videos_id' => $id]);

                    $tag_title = StringHelper::explode($model2->title, ',');

                    foreach ($tag_title as $tag_title_value) {
                        $search = new Search();
                        $model_tmp = $model2->findOne(['title' => $tag_title_value]);
                        $search->tag_id = $model_tmp->id; // tag id from search by title
                        $search->videos_id = $video_last_id;
                        $search->save();
                    }
                }
                return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('formupdate', [
                'model' => $model,
                'model2' => $model2,
                'model3' => $model3,
            ]);
        }
    }

    /**
     * Deletes an existing Videos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $del = Search::deleteAll(['videos_id' => $id]);

        return $this->redirect(['index']);
    }
    public function actionDeletemember($id)
    {
        $this->findModel($id)->delete();
        $del = Search::deleteAll(['videos_id' => $id]);

        Yii::$app->getSession()->setFlash('alert',[
            'body'=>'ลบข้อมูลสำเร็จ...',
            'options'=>['class'=>'alert-success']
        ]);
        return $this->redirect(['status']);
    }
    public function actionStatus()
    {
        $models = Videos::find()->joinWith(['videosStatus'])->
        where(['user_id' => Yii::$app->user->id])->all();
        return $this->render('status', ['model' => $models]);
    }

    /**
     * Finds the Videos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Videos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Videos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
