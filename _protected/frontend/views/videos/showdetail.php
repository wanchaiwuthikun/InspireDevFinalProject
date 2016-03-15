<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'บทเรียนออนไลน์');
$this->params['breadcrumbs'][] = Yii::t('app', 'บทเรียนออนไลน์');
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?>

    </h1>
    <hr class="top">

    <div class="panel panel-info">

        <div class="bs-callout bs-callout-primary">
            <h4><?=  $models->title ?></h4>
        </div>

        <div class="panel-body">
            <div class="col-lg-push-1 col-lg-8">
                <iframe class="embed-responsive-item" width="853" height="480"
                        src="//www.youtube.com/embed/<?= $models->url;?>?modestbranding=0&vq=720p&showinfo=0&autoplay=0&theme=light"
                        frameborder="0" allowfullscreen>
                </iframe>
            </div>
        </div>
        <div class="panel-footer">

            <?= Html::encode('Tag :: '.' ') ?>
            <?php foreach ($models2 as $model2): ?>
                <?php if($model2->videos_id == $models->id): ?>

                    <span class="glyphicon glyphicon-tags" aria-hidden="true">
                        <?= $model2->tag->title.' ,' ?>
                    </span>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div>
            <?= Html::encode( $models->content) ?>
        </div>
    </div>


</div>
