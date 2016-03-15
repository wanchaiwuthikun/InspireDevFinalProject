<?php

namespace frontend\controllers;

use Yii;
use app\models\ForumAns;
use app\models\ForumAsk;
use common\models\Course;
use app\models\Tag;
use common\models\Search;
use frontend\models\ForumAskSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\helpers\StringHelper;


/**
 * ForumAskController implements the CRUD actions for ForumAsk model.
 */
class ForumAskController extends FrontendController
{

    /**
     * Lists all ForumAsk models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ForumAskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionForum()
    {
        $query = Course::find()->where(['category_id' => 3 ]);
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $model = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $count =  forumAsk::find()
            ->select(['COUNT(*) AS asktotal, course_id'])
            ->groupBy(['course_id'])
            ->all();
        $countans =  forumAns::find()
            ->select(['COUNT(*) AS anstotal, forumAsk_id'])
            ->all();



        return $this->render('forum', [
            'models' => $model,
            'pagination' => $pagination,
            'askmodel' => $count,
            'ansmodel' => $countans,
        ]);
    }

    public function actionShow($id)
    {

//        $model = ForumAsk::findAll([
//            'course_id' => $id,
//        ]);
        $query = ForumAsk::find()->where(['course_id' => $id]);


        $model2 = Course::findOne($id);
        $pagination = new Pagination([
            'defaultPageSize' => 8,
            'totalCount' => $query->count(),
        ]);
        $model = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('show',
            [ 'models' => $model,
              'models2' => $model2,
              'pagination' => $pagination,

            ]);

    }

    public function actionShowdetail($id)
    {

        $model = ForumAsk::findOne([
            'id' => $id,

        ]);

        $modelsans = new ForumAns();
        $modelansC = ForumAns::find()->where([ 'forumAsk_id' => $id ])->count();


        $model3 = Search::find()->joinWith(['tag','forumAsk'])->where(['search.forumAsk_id' => $id])->all();

        return $this->render('showdetail',
            [ 'models' => $model,
              'modelsans' => $modelsans,
              'modeltag' => $model3,
              'modelansC' => $modelansC,



            ]);

    }

    public function actionCreateans()
    {
        $model3 = new ForumAns();
        $model3->user_id = Yii::$app->user->id;
        $model3->forumAsk_id = Yii::$app->request->post('forumAsk_id');

        if ($model3->load(Yii::$app->request->post()) && $model3->save()) {
            return $this->redirect(['showdetail', 'id' =>Yii::$app->request->post('forumAsk_id')]);
        }

    }

    public function actionEditans($id)
    {
        $model = ForumAns::findOne([
            'id' => $id
        ]);

        return $this->render('editans',
            [ 'models' => $model,

            ]);

    }
    public function actionUpdateans($id)
    {
        $model4 = ForumAns::findOne($id);
        if ($model4->load(Yii::$app->request->post()) && $model4->save()) {
            return $this->redirect(['showdetail', 'id' => $model4->id]);
        } else {
            return $this->render('editans', [
                'models' => $model4,
            ]);
        }

    }
    public function actionDeleteans($id)
    {
       $model = ForumAns::findOne([
           'id' => $id
       ]);

       $delans = ForumAns::findOne($id)->delete();



        return $this->redirect(['forum-ask/showdetail', 'id' => $model->forumAsk_id]);
    }


    /**
     * Displays a single ForumAsk model.
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
     * Creates a new ForumAsk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new ForumAsk();
        $model2 = new Tag();
        $model3 = Course::findOne($id);
        $model->user_id = Yii::$app->user->id;


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $forumask_last_id = Yii::$app->db->getLastInsertID();

            if ($model2->load(Yii::$app->request->post())) {
                $tag_title = StringHelper::explode($model2->title, ',');

                foreach ($tag_title as $tag_title_value) {
                    $search = new Search();
                    $model_tmp = $model2->findOne(['title' => $tag_title_value]);
                    $search->tag_id = $model_tmp->id; // tag id from search by title
                    $search->forumAsk_id = $forumask_last_id;
                    $search->save();

                }
            }
            return $this->redirect(['show', 'id' => $model3->id]);
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
        $model = new ForumAsk();
        $model2 = new Tag();
//        $model3 = Course::findOne();
        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $forumask_last_id = Yii::$app->db->getLastInsertID();

            if ($model2->load(Yii::$app->request->post())&& !empty($model2->title)) {
                $tag_title = StringHelper::explode($model2->title, ',');

                foreach ($tag_title as $tag_title_value) {
                    $search = new Search();
                    $model_tmp = $model2->findOne(['title' => $tag_title_value]);
                    $search->tag_id = $model_tmp->id; // tag id from search by title
                    $search->forumAsk_id = $forumask_last_id;
                    $search->save();

                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('formadmin', [
                'model' => $model,
                'model2' => $model2,
//                'model3' => $model3,
            ]);
        }
    }

    /**
     * Updates an existing ForumAsk model.
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
    public function actionUpdatemember($id)
    {
        $model = $this->findModel($id);
        $model2 = new Tag();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['showdetail', 'id' => $model->id]);
        } else {
            return $this->render('formupdatemember', [
                'model' => $model,
                'model2' => $model2,
            ]);
        }
    }
    public function actionUpdateadmin($id)
    {
        $model = $this->findModel($id);
        $model2 = new Tag();
        $model3 = Search::find()->joinWith(['tag','forumAsk'])->where(['search.forumAsk_id' => $id])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $forumAsk_last_id = $model->id;

            if ($model2->load(Yii::$app->request->post()) && !empty($model2->title)) {

                $del = Search::deleteAll(['forumAsk_id' => $id]);

                $tag_title = StringHelper::explode($model2->title, ',');

                foreach ($tag_title as $tag_title_value) {
                    $search = new Search();
                    $model_tmp = $model2->findOne(['title' => $tag_title_value]);
                    $search->tag_id = $model_tmp->id; // tag id from search by title
                    $search->forumAsk_id = $forumAsk_last_id;
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
     * Deletes an existing ForumAsk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = ForumAns::find()->where(['forumAsk_id' => $id])->count();

        if ($model === 0 ) {
            $model3 = Search::find()->joinWith(['tag','forumAsk'])->where(['search.forumAsk_id' => $id])->all();
            $this->findModel($id)->delete();
            $del = Search::deleteAll(['forumAsk_id' => $id]);
        } else {
            $model = ForumAns::deleteAll(['forumAsk_id' => $id]);
            $model3 = Search::find()->joinWith(['tag','forumAsk'])->where(['search.forumAsk_id' => $id])->all();
            $this->findModel($id)->delete();
            $del = Search::deleteAll(['forumAsk_id' => $id]);
        }

        return $this->redirect(['forum']);
    }

    public function actionDeletemember($id)
    {
        $checkans = ForumAns::find($id)->count();

        if ($checkans === 0) {
            $model3 = Search::find()->joinWith(['tag','forumAsk'])->where(['search.forumAsk_id' => $id])->all();
            $this->findModel($id)->delete();
            $del = Search::deleteAll(['forumAsk_id' => $id]);
        } else {


        }

        return $this->redirect(['forum']);
    }

    /**
     * Finds the ForumAsk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ForumAsk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ForumAsk::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
