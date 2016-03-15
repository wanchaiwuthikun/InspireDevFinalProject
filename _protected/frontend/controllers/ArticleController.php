<?php
namespace frontend\controllers;

use common\models\Course;
use frontend\models\Article;
use frontend\models\ArticleSearch;
use common\models\Search;
use yii\helpers\StringHelper;
use yii\web\NotFoundHttpException;
use yii\web\MethodNotAllowedHttpException;
use Yii;
use yii\data\Pagination;
use app\models\Tag;
/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends FrontendController
{



    /**
     * Lists all Article models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Course::find()->where(['category_id' => 2 ]);


        $pagination = new Pagination([
            'defaultPageSize' => 12,
            'totalCount' => $query->count(),
        ]);

        $model = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'models' => $model,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Displays a single Article model.
     *
     * @param  integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionShow($id)
    {
        $model = Article::findAll([
            'course_id' => $id,
            'status' => 2,
        ]);

        $model2 = Course::findOne($id);

        return $this->render('show', [
            'models' => $model,
            'models2' => $model2,
        ]);
    }


    public function actionShowdetail($id)
    {
        $model = Article::findOne([
            'id' => $id,
            'status' => 2,
        ]);
        $model2 = Search::find()->joinWith(['tag','article'])->where(['search.article_id' => $id])->all();

        return $this->render('showdetail', [
            'models' => $model,
            'models2' => $model2,
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Article();
        $model2 = new Tag();
        $model3 = Course::findOne($id);
        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            $article_last_id = Yii::$app->db->getLastInsertID();

            if ($model2->load(Yii::$app->request->post())&& !empty($model2->title)) {
                $tag_title = StringHelper::explode($model2->title, ',');

                foreach ($tag_title as $tag_title_value) {
                    $search = new Search();
                    $model_tmp = $model2->findOne(['title' => $tag_title_value]);
                    $search->tag_id = $model_tmp->id; // tag id from search by title
                    $search->article_id = $article_last_id;
                    $search->save();


                }
            }

            return $this->redirect(['show', 'id' => $model->course_id]);
        }
        else
        {
            return $this->render('create', [
                'model' => $model,
                'model2' => $model2,
                'model3' => $model3,

            ]);
        }
    }
    public function actionCreateadmin()
    {
        $model = new Article();
        $model2 = new Tag();
        $model3 = Course::find()->all();
        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            $article_last_id = Yii::$app->db->getLastInsertID();

            if ($model2->load(Yii::$app->request->post())) {

                $tag_title = StringHelper::explode($model2->title, ',');

                foreach ($tag_title as $tag_title_value) {
                    $search = new Search();
                    $model_tmp = $model2->findOne(['title' => $tag_title_value]);
                    $search->tag_id = $model_tmp->id; // tag id from search by title
                    $search->article_id = $article_last_id;
                    $search->save();


                }
            }

            return $this->redirect(['admin', 'id' => $model->id]);
        }
        else
        {
            return $this->render('formadmin', [
                'model' => $model,
                'model2' => $model2,
                'model3' => $model3,

            ]);
        }
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param  integer $id
     * @return mixed
     *
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model2 = new Tag();



            if ($model->load(Yii::$app->request->post()) && $model->save())
            {
                return $this->redirect(['showdetail', 'id' => $model->id]);
            }
            else
            {
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
        $model3 = Search::find()->joinWith(['tag','article'])->where(['search.article_id' => $id])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $article_last_id = $model->id;

            if ($model2->load(Yii::$app->request->post()) && !empty($model2->title)) {
                $del = Search::deleteAll(['article_id' => $id]);

                $tag_title = StringHelper::explode($model2->title, ',');

                foreach ($tag_title as $tag_title_value) {
                    $search = new Search();
                    $model_tmp = $model2->findOne(['title' => $tag_title_value]);
                    $search->tag_id = $model_tmp->id; // tag id from search by title
                    $search->article_id = $article_last_id;
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
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param  integer $id
     * @return mixed
     *
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Search::deleteAll(['article_id' => $id]);


        return $this->redirect('admin');
    }
    public function actionDeletemember($id)
    {
        $this->findModel($id)->delete();
        Search::deleteAll(['article_id' => $id]);


        return $this->redirect('index');
    }

    /**
     * Manage Articles.
     *
     * @return mixed
     */
    public function actionAdmin()
    {
        /**
         * How many articles we want to display per page.
         * @var integer
         */
        $pageSize = 11;

        /**
         * Only admin+ roles can see everything.
         * Editors will be able to see only published articles and their own drafts @see: search().
         * @var boolean
         */
        $published = (Yii::$app->user->can('admin')) ? false : true ;

        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $pageSize, $published);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer  $id
     * @return Article The loaded model.
     *
     * @throws NotFoundHttpException if the model cannot be found.
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}