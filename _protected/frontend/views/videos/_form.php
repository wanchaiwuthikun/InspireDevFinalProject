<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\selectize\SelectizeTextInput;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;
use app\models\Tag;

/* @var $this yii\web\View */
/* @var $model app\models\Videos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="videos-form">
    <div class="col-md-6">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true])->hint('คัดลอก Url เช่น https://www.youtube.com/watch?v=RSZKgM_W85')?>

    <?= $form->field($model, 'course_id')->hiddenInput(['value'=>$model3->id])->label(false);?>

    <?= $form->field($model3, 'title')->textInput(['readonly' => true]); ?>

    <?= $form->field($model2, 'title')->widget(SelectizeTextInput::className(), [
        'loadUrl' => ['tag/list'],
        'options' => ['class' => 'form-control'],
        'clientOptions' => [
            'plugins' => ['remove_button'],
            'valueField' => 'title',
            'labelField' => 'title',
            'searchField' => ['title'],
            'create' => false,
        ],
    ])->hint('พิมพ์ Tag ที่ต้องการ') ?>

    <div class="form-group" align="right">
        <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'เสร็จสิ้น', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>
