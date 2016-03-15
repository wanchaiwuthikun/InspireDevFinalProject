<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\selectize\SelectizeTextInput;

/* @var $this yii\web\View */
/* @var $model app\models\Videos */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'แก้ไขวิดีโอ: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'บทเรียนออนไลน์', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไขวิดีโอ';
?>

<div class="videos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'course_id')->dropDownList([$model->getcourseList()]);?>
<!--    --><?//= $form->field($model3, 'title')->textInput(['readonly' => true]); ?>
    <div class="tag">
        <?php
            echo Html::encode(' '.' Tag เดิม :'.' ') ;
                foreach ($model3 as $tag) {
                 echo $tag->tag->title.' '.',';
                 echo '<br>';
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
    ])->hint('พิมพ์ Tag ที่ต้องการ') ?>

<!--    --><?//= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'videos_status_id')->dropDownList([$model->getstatusList()]) ?>


    <div class="form-group" align="right">
        <?= Html::submitButton($model->isNewRecord ? 'อัพโหลดวิดีโอ' : 'เสร็จสิ้น', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
