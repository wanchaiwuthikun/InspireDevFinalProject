<?php

namespace backend\controllers;

use Yii;
use common\models\Course;
use common\models\CourseSearch;
use common\models\Upload;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\db\ActiveRecord;


/**
 * CourseController implements the CRUD actions for Course model.
 */
class CourseController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'controllers' => ['course'],
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['admin','editor'],
                    ],
                    [
                        // other rules
                    ],

                ], // rules

            ], // access

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ], // verbs

        ]; // return
    }

    /**
     * Lists all Course models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Course model.
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
     * Creates a new Course model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Course();
        $modelUpload = new Upload();

        if ($model->load(Yii::$app->request->post())) {


            if (!empty($file = UploadedFile::getInstance($modelUpload, 'images'))) {

                //upload image
                $modelUpload->images = $file;
                $modelUpload->randomName = time().'.'.$modelUpload->images->extension;
                $modelUpload->upload();
                $model->images = $modelUpload->randomName;
                $model->save();


            } else {
                $model->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelUpload' => $modelUpload,
            ]);
        }
    }

    /**
     * Updates an existing Course model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelUpload = new Upload();

            // check post form
        if ($model->load(Yii::$app->request->post())) {

            // check image from course to exits
            if (!empty($model->images)) {

            // check fileupload to exits
                if (!empty($file = UploadedFile::getInstance($modelUpload, 'images'))) {
                    //delete old image
                    unlink(Yii::getAlias('@pathUpload').'/'.$model->images);
                    //upload image
                    $modelUpload->images = $file;
                    $modelUpload->randomName = time().'.'.$modelUpload->images->extension;
                    $modelUpload->upload();
                    $model->images = $modelUpload->randomName;
                    $model->save();
                } else {
                     $model->save();
                }
            } else {
                    $file = UploadedFile::getInstance($modelUpload, 'images');
                    $modelUpload->images = $file;
                    $modelUpload->randomName = time().'.'.$modelUpload->images->extension;
                    $modelUpload->upload();
                    $model->images = $modelUpload->randomName;
                    $model->save();

            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelUpload' => $modelUpload,
            ]);
        }
    }

    /**
     * Deletes an existing Course model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $modelUpload = new Upload();

        if (!empty($file = UploadedFile::getInstance($modelUpload, 'images'))) {
            //delete old image
            unlink(Yii::getAlias('@pathUpload').'/'.$model->images);
            $model->delete();


        } else {
            $model->delete();
        }



        return $this->redirect(['index']);
    }

    /**
     * Finds the Course model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Course::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
