<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'บทความ';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'บทความ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $models2->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?>
        <span class="small"> - <?= Html::encode($models2->title) ?></span>
    </h1>

    <hr class="top">
    <div class="col-lg-offset-9">
        <div class="col-lg-offset-6">
    <?php if (Yii::$app->user->id): ?>
<!--      <p>-->
<!--        --><?//= Html::a('เขียนบทความ', Url::to(['article/create', 'id'=> $models2->id]), ['class' => 'btn btn-success']) ?>
<!--      </p>-->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
            เขียนบทความ
        </button>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h2 class="modal-title" id="myModalLabel" align="center">ข้อตกลงการเขียนบทความ</h2>
                    </div>
                    <div class="modal-body">
                        <br>

                            <li>เนื้อหา รูปภาพ หรือข้อมูลต่าง ๆ ที่อยู่ในบทความ ต้องเป็นเนื้อหาที่ได้รับการอนุญาตจากเจ้าของข้อมูล
                                พร้อมทั้งให้เครดิตแก่เจ้าของข้อมูลด้วย หากไม่มีการให้เครดิต หรือมีการแจ้งกับทางผู้ดูแลระบบว่าเนื้อหาถูกคัดลอกมาโดยไม่ได้รับอนุญาต
                                ทางผู้ดูแลระบบจะทำการแจ้งเตือนและให้แก้ไขหรือลบเนื้อหานั้น
                            </li>

                    </div>
                    <div class="modal-footer">
                        <?= Html::a('ยอมรับ', Url::to(['article/create', 'id'=> $models2->id]), ['class' => 'btn btn-success',
                            'id' => 'main-content-modal']); ?>
                        <!--                            <button type="button" class="btn btn-danger" id="cancel">ไม่ยอมรับ</button>-->
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
        </div>
    </div>
    <div class="col-lg-12 ">
        <table class="table-hover">
<!--            <tr align="center">-->
<!--                <td><h4>บทความทั้งหมด</h4></td>-->
<!---->
<!--            </tr>-->
            <?php foreach ($models as $model): ?>

                <tr>
                    <td>
                        <a href="<?= Url::to(['article/showdetail', 'id'=>Html::encode($model->id)]); ?>">
                           <h4> <?= Html::encode("{$model -> title}") ?></h4>
                        </a>
                    </td>

                </tr>

            <?php endforeach; ?>
        </table>

    </div>
</div>
