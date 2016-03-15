<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;


/* @var $this yii\web\View */
/* @var $model frontend\models\Article */

$this->title = $models->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'บทความ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">

    <h1>
        <p><?= Html::encode("{$models->title}") ?></p>

    </h1>
    <div class="col-lg-push-8 " >
        <?= Html::encode("โดย").' '.Html::encode("{$models->user->username}").'&nbsp;&nbsp;&nbsp;&nbsp;'.
        '<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>'.'&nbsp;'.
        Yii::$app->formatter->asDatetime($models->created_at , "php:d/m/Y").'&nbsp&nbsp&nbsp&nbsp'.
        '<span class="glyphicon glyphicon-time" aria-hidden="true"></span>'.'&nbsp'.
        Yii::$app->formatter->asDatetime($models->created_at , "php: H:i:s")
        ; ?>
    </div>
    <div class="col-md-12">
        <?php if ($models->user->id === Yii::$app->user->id) : ?>
        <div class="col-lg-offset-11">
            <p>
                <?= Html::a('<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>', ['update', 'id' => $models->id]
                    , [
//                    'class' => 'btn btn-primary'
                    ])
                ?>
                <?= Html::a('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', ['deletemember', 'id' => $models->id], [
//                    'class' => 'btn btn-forum btn-md btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
         </div>
         <?php ; endif ?>
        <div class="col-lg-12">
            <!--            content-->
            <?= '<hr>' ?>
            <p><?= $models->content ?></p>

        </div>
        <div class="col-lg-12">
            <?= '<hr>' ?>
            <?= Html::encode('Tag'. '  '); ?><span class="glyphicon glyphicon-tags" aria-hidden="true">

                    </span>
            <?php foreach ($models2 as $tag): ?>
                <?=Html::encode($tag->tag->title.',')  ;?>

            <?php endforeach; ?>
        </div>




    </div>
 </div>

