<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\bootstrap\modal;
use prawee\widgets\ButtonAjax;
use yii\widgets\LinkPager;



/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'บทเรียนออนไลน์');
//$this->params['breadcrumbs'][] = Yii::t('app', 'บทเรียนออนไลน์');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'บทเรียนออนไลน์'), 'url' => ['lesson']];
$this->params['breadcrumbs'][] = $models2->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?>
        <span class="small"> - <?= Yii::t('app', $models2->title) ?></span>
    </h1>
    <hr class="top">
    <div class="row">
        <div class="col-lg-push-10 col-lg-2" >
        <?php if (Yii::$app->user->id): ?>
<!--          --><?//= Html::a('อัพโหลด', Url::to(['videos/create', 'id'=> $models2->id]), ['class' => 'btn btn-success']) ?>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                อัพโหลดวิดีโอ
            </button>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h2 class="modal-title" id="myModalLabel" align="center">ข้อตกลงในการอัพโหลดวิดีโอ</h2>
                        </div>
                        <div class="modal-body">
                            <br>
                            <p>
                            <li>เนื้อหา รูปภาพ หรือข้อมูลต่าง ๆ ที่อยู่ในวิดีโอ ต้องเป็นเนื้อหาที่ได้รับการอนุญาตจากเจ้าของข้อมูล พร้อมทั้งให้เครดิตแก่เจ้าของข้อมูลด้วย
                            หากไม่มีการให้เครดิต หรือมีการแจ้งกับทางผู้ดูแลระบบว่าเนื้อหาถูกคัดลอกมาโดยไม่ได้รับอนุญาต ทางผู้ดูแลระบบจะทำการแจ้งเตือนและให้แก้ไขหรือลบเนื้อหานั้น</li> <br>
                            <li>วิดีโอที่จะอัพโหลดมีความยาวได้สูงสุดไม่เกิน 30 นาที ภาพและเสียงของวิดีโอมีความคมชัด <br></li>
                            </p>
                        </div>
                        <div class="modal-footer">
                            <?= Html::a('ยอมรับ', Url::to(['videos/create', 'id'=> $models2->id]), ['class' => 'btn btn-success',
                            'id' => 'main-content-modal']); ?>
<!--                            <button type="button" class="btn btn-danger" id="cancel">ไม่ยอมรับ</button>-->
                        </div>
                    </div>
                </div>
            </div>

        <?php endif ;?>
            </div>
    </div>
    <ul>
        <?php foreach ($models as $model): ?>


            <div class="panel panel-info">

                    <div class="bs-callout bs-callout-primary">
                        <h4><?=  $model->title ?></h4>
                    </div>

                <div class="panel-body">
                    <div class="col-lg-push-1 col-lg-8">
                    <iframe class="embed-responsive-item" width="853" height="480"
                            src="//www.youtube.com/embed/<?= $model->url;?>?modestbranding=0&vq=720p&showinfo=0&autoplay=0&theme=light"
                            frameborder="0" allowfullscreen>
                    </iframe>
                    </div>
                </div>
                <div class="panel-footer">

                    <?= Html::encode('Tag :: '.' ') ?>
            <?php foreach ($models3 as $model2): ?>
                <?php if($model2->videos_id == $model->id): ?>

                    <span class="glyphicon glyphicon-tags" aria-hidden="true">
                        <?= $model2->tag->title.' ,' ?>
                    </span>
                <?php endif; ?>
            <?php endforeach; ?>

                </div>
            </div>


        <?php endforeach ; ?>

    </ul>

    <div class="col-lg-12" align="center ">
        <?php echo LinkPager::widget([
            'pagination' => $pagination,
        ]); ?>
    </div>

</div>

