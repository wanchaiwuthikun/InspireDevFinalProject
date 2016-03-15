<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Course */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="course-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true,]) ?>
    <div align="center">
    <?php if (!empty($model->images)) {

        echo Html::img(Url::to('@getImage/imgCourse/'.$model->images,true), [
            'style'=>'width:100px;','class'=>'img-rounded']);

        } else {

        echo Html::img(Url::to('@getImage/imgCourse/none.png',true), [
            'style'=>'width:100px;','class'=>'img-rounded']);
        }
    ?>
    </div>
    <?= $form->field($modelUpload, 'images')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->dropDownList($model->getDropdownCategory(), ['prompt' => 'กรุณาเลือกหมวดหมุ่']) ?>

    <div class="form-group" >
        <div class="col-lg-10"></div>
        <?= Html::submitButton($model->isNewRecord ? 'เพิ่ม' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
