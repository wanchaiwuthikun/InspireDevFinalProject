<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Html::encode('บทความทั้งหมด');
$this->params['breadcrumbs'][] = Yii::t('app', 'บทความ');
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?> 
<!--        <span class="small"> - --><?//= Yii::t('app', '') ?><!--</span>-->
    </h1>

    <hr class="top">


<div class="col-lg-offset-1">
    <?php foreach ($models as $model): ?>

        <div class="col-xs-12 col-sm-4 col-md-6 col-lg-3 ">
                <div class="thumnail">
                    <a href="<?= Url::to(['article/show', 'id' => Html::encode($model->id)]);?>", class="thumbnail">
                        <?= Html::img(Url::to('@web/uploads/imgCourse/'.$model->images,true), [
                            'style'=>'width:171px; height:180px;']); ?>
                    </a>

                </div>

        </div>

    <?php endforeach; ?>
    </div>
    <div class="col-lg-12" align="center ">
        <?php echo LinkPager::widget([
            'pagination' => $pagination,
        ]); ?>
    </div>
</div>
