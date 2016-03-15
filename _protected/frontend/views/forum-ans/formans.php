<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model frontend\models\Article */

$this->title = 'แก้ไขกระท'.Html::encode($model->forumAsk->title);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'กระทู้ถาม-ตอบ'), 'url' => ['forum-ask/forum']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">

    <h1>
        <?= Yii::t('app', 'แก้ไขคำตอบ').''.Html::encode($model->forumAsk->title) ?>

    </h1>

        <div class="forum-ans-form">
            <?php
            $form = ActiveForm::begin([
                'method' => 'post',
                'action' => ['forum-ans/updateans'],
            ])
            ?>
            <?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className(),
                [ 'clientOptions' => [ 'imageManagerJson' => ['/redactor/upload/image-json'],
                    'imageUpload' => ['/redactor/upload/image'],
                    'fileUpload' => ['/redactor/upload/file'],
                    'lang' => 'th', 'minHeight' => 300, 'plugins' => ['clips', 'fontcolor','imagemanager']
                ] ])?>
                        <?= Html::hiddenInput('ans_id', $model->id); ?>
            <div class="form-group">
                <div align="right">
                   <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']); ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>



</div>
