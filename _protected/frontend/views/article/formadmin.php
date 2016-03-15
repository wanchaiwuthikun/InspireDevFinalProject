<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\selectize\SelectizeTextInput;



/* @var $this yii\web\View */
/* @var $model frontend\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'summary')->textInput() ?>

    <?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className(),
        [ 'clientOptions' => [ 'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'th', 'minHeight' => 300, 'plugins' => ['clips', 'fontcolor','imagemanager']
        ] ])?>



    <div class="row">
        <div class="col-lg-6">

            <?= $form->field($model, 'status')->dropDownList($model->statusList) ?>
            <?= $form->field($model, 'course_id')->dropDownList($model->getcourseList());?>
<!--            --><?//= $form->field($model3, 'title')->textInput(['readonly' => true]); ?>

        </div>
    </div>

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
    ])->hint('พิมพ์ tag ที่ต้องการ') ?>


    <div class="form-group">
     <div class="col-lg-push-10 col-lg-2">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'บันทึก')
            : Yii::t('app', 'แก้ไข'), ['class' => $model->isNewRecord
            ? 'btn btn-success' : 'btn btn-primary']) ?>

<!--        --><?//= Html::a(Yii::t('app', 'Cancel'), ['article/index'], ['class' => 'btn btn-default']) ?>
     </div>
   </div>


    <?php ActiveForm::end(); ?>

</div>