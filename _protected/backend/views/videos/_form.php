<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\selectize\SelectizeTextInput;

/* @var $this yii\web\View */
/* @var $model app\models\Videos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="videos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'course')->dropDownList([$model->getcourseList()]) ?>
<!--    --><?//= $form->field($model2, 'title')->widget(SelectizeTextInput::className(), [
//        'loadUrl' => ['tag/list'],
//        'options' => ['class' => 'form-control'],
//        'clientOptions' => [
//            'plugins' => ['remove_button'],
//            'valueField' => 'title',
//            'labelField' => 'title',
//            'searchField' => ['title'],
//            'create' => false,
//        ],
//    ])->hint('พิมพ์ tag ที่ต้องการ') ?>
    <?= $form->field($model, 'videos_status_id')->dropDownList([$model->getstatusList()]) ?>


    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <div class="col-lg-11" align="right"></div>
        <?= Html::submitButton($model->isNewRecord ? 'อัพโหลด' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
