<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title =Yii::t('app', 'กระทู้ถาม-ตอบ');
$this->params['breadcrumbs'][] = Yii::t('app', 'กระทู้ถาม-ตอบ');
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?>
<!--        <span class="small"> - --><?//= Yii::t('app', 'The best news available') ?><!--</span>-->
    </h1>

    <hr class="top">

    <div class="col-lg-10 col-lg-push-1">
        <table class="table table-bordered table-striped">
            <tr class="info">
                <td><h4><b> &nbsp;&nbsp;&nbsp; หมวดหมู่</h4></td>
                <td><h4><b>กระทู้</h4></td>
<!--                <td><h4>ตอบ</h4></td>-->

            </tr>
            <?php foreach ($models as $model): ?>

                <tr>
                    <td><h4><img src="/chat.png" width="30">&nbsp;&nbsp;&nbsp;
                          <a href="<?= Url::to(['forum-ask/show', 'id'=>Html::encode($model->id)]); ?>">
                            <?= Html::encode("{$model -> title}") ?>
                           </a>
                    </h4></td>
                    <td><h4>


                        <?php foreach ($askmodel as $ask): ?>
                            <?php if ($ask->course_id == $model->id): ?>

                             <?= $ask->asktotal; ?>

                            <?php endif; ?>
                        <?php endforeach ; ?>
                        </h4></td>
<!--                    <td>-->
<!---->
<!--                    </td>-->
                    </tr>

            <?php endforeach; ?>
        </table>
        
    </div>


    <div class="col-lg-12" align="center ">
        <?php echo LinkPager::widget([
            'pagination' => $pagination,
        ]); ?>
    </div>


</div>
