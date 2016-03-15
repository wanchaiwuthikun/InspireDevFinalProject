<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\selectize\SelectizeTextInput;

/* @var $this yii\web\View */
/* @var $model app\models\ForumAsk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="forum-ask-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className(),
        [ 'clientOptions' => [ 'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'th', 'minHeight' => 300, 'plugins' => ['clips', 'fontcolor','imagemanager']
        ] ])?>

<!--    --><?//= $form->field($model, 'create_at')->textInput() ?>

<!--    --><?//= $form->field($model, 'update_at')->textInput() ?>

    <?= $form->field($model, 'course_id')->dropDownList($model->getcourseList())?>
<!--    --><?//= $form->field($model3, 'title')->textInput(['readonly' => true]); ?>
    <div class="tag">
        <?php
        echo Html::encode(' '.' Tag เดิม :'.' ') ;
        foreach ($model3 as $tag) {
            echo $tag->tag->title.' '.',';

        }
        ?>
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
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'บันทึก', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
