
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\ForumAsk */
/* @var $form yii\widgets\ActiveForm */

//$this->title = 'Update Forum Ans: ' . ' ' . $models->id;
//$this->params['breadcrumbs'][] = ['label' => 'Forum Asks', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $models->title, 'url' => ['view', 'id' => $models->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>

<div class="forum-ask-form">

    <?php $form = ActiveForm::begin([

    ]); ?>


    <?= $form->field($models, 'content')->widget(\yii\redactor\widgets\Redactor::className(),
        [ 'clientOptions' => [ 'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'th', 'minHeight' => 300, 'plugins' => ['clips', 'fontcolor','imagemanager']
        ] ])?>

<!--    --><?//= Html::hiddenInput('forumAsk_id', $models->forumAsk_id); ?>
    <div class="form-group">
        <a href="<?= Url::to(['forum-ask/updateans', 'id'=>Html::encode($models->id)]); ?>">
            <?= Html::encode("ีupdate") ?>
        </a>
        <div>
            <?= Html::a(Url::to(['forum-ask/updateans', 'id'=>Html::encode($models->id)])) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>




</div>


