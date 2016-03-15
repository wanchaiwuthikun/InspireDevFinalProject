<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchAll */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ผลการค้นหา';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="search-index">

    <h1><?= Html::encode($this->title) ?>
        <span class="small"> - <?= Yii::t('app', $modelssearch) ?></span>
    </h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <ul class="nav navs-tabs">
        <li role="presentation"><a href="<?= Url::to(['search/index', 'search'=>Html::encode($modelssearch)]); ?>">
                <?= Html::encode("บทความ") ?>
            </a>
        </li>
        <li role="presentation"><a href="<?= Url::to(['search/videos', 'search'=>Html::encode($modelssearch)]); ?>">
                <?= Html::encode("บทเรียนออนไลน์") ?>
            </a>
        </li>
        <li role="presentation" class="active"><a href="<?= Url::to(['search/forum', 'search'=>Html::encode($modelssearch)]); ?>">
                <?= Html::encode("กระทู้ถาม-ตอบ") ?>
            </a>
        </li>
    </ul>
    <div class="col-lg-12 search">
        <?php if ($models4 < 1):?>
            <h3><?= Html::encode("ไม่พบผลลัพธ์เกี่ยวกับ") ?>
                <span class="small"> - <?= Yii::t('app', $modelssearch) ?></span>
            </h3>
        <?php endif;  ?>
        <?php if (!empty($models4)): ?>
            <table class="table table-hover">
                <tr class="info">

                    <td align="center">กระทู้ถาม-ตอบ</td>
                </tr>
                <?php foreach ($models as $model): ?>
                    <?php foreach ($models2 as $model2): ?>
                        <?php if ($model2->id === $model->forumAsk_id): ?>
                            <tr>
                                <td>
                                    <a href="<?= Url::to(['forum-ask/showdetail', 'id'=>Html::encode($model->forumAsk_id)]); ?>">
                                        <?= Html::encode($model2->title) ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </table>
        <?php endif ; ?>
     </div>
</div>
