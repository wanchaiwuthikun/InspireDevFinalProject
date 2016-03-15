<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model frontend\models\Article */

$this->title = $models->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'กระทู้ถาม-ตอบ'), 'url' => ['forum']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">
        <div class="" align="center">
            <h3>
                <?= Html::encode("$models->title") ?>

            </h3>
        </div>
  <div class="row" >
    <div class="col-lg-offset-1 col-lg-11">

        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="col-lg-push-8 " >
                    <?= Html::encode("โดย").' '.Html::encode("{$models->user->username}").'&nbsp;&nbsp;&nbsp;&nbsp;'.
                        '<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>'.'&nbsp;'.
                        Yii::$app->formatter->asDatetime($models->create_at , "php:d/m/Y").'&nbsp&nbsp&nbsp&nbsp'.
                        '<span class="glyphicon glyphicon-time" aria-hidden="true"></span>'.'&nbsp'.
                         Yii::$app->formatter->asDatetime($models->create_at , "php: H:i:s")
                    ; ?>
                </div>
            </div>

            <div class="panel-body">
                <div class="col-lg-offset-11">
                    <?php if ($models->user->id === Yii::$app->user->id) : ?>

                        <?= Html::a('<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
                            ['updatemember', 'id' => $models->id]
                            , [
//                    'class' => 'btn btn-primary'
                            ])
                        ?>
                        <?php if ($modelansC === 0): ?>
                         <?= Html::a('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>',
                            ['delete', 'id' => $models->id], [
//                    'class' => 'btn btn-forum btn-md btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                         <?php ; endif ?>

                        <?php ; endif ?>
                 </div>
                <div class="col-lg-12">
               <?= $models->content ?>
                </div>
            </div>
            <div class="panel-footer">

                    <?= Html::encode('Tag'. '  '); ?><span class="glyphicon glyphicon-tags" aria-hidden="true">

                    </span>
                    <?php foreach ($modeltag as $tag): ?>
                        <?=Html::encode($tag->tag->title.',')  ;?>
                    <?php endforeach; ?>
            </div>
        </div>

    </div>
  </div>
    <div class="row">

        <?PHP foreach ($models->forumAns as $ans ): ?>

            <div class="col-lg-offset-1 col-lg-11">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-lg-offset-11 ">
                            <?php if ($ans->user->id === Yii::$app->user->id) : ?>
                                <a href="<?= Url::to(['forum-ans/checkans', 'id'=>Html::encode($ans->id)]); ?>">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>

                            <?= Html::a('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>',
                                ['forum-ask/deleteans', 'id' => $ans->id], [
//                    'class' => 'btn btn-forum btn-md btn-danger',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this item?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            <?php ; endif ?>
                        </div>
                        <div class="col-lg-12">
                            <?= $ans->content; ?>
                        </div>

                    </div>
                    <div class="panel-footer">

                        <div class="col-lg-push-8 " >
                           ตอบโดย: <?= $ans->user->username.'&nbsp;&nbsp;&nbsp;'; ?>
                            <?=
                            '<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>'.'&nbsp;'.
                            Yii::$app->formatter->asDatetime($ans->create_at , "php:d/m/Y").'&nbsp&nbsp&nbsp&nbsp'.
                            '<span class="glyphicon glyphicon-time" aria-hidden="true"></span>'.'&nbsp'.
                            Yii::$app->formatter->asDatetime($ans->create_at , "php: H:i:s")
                            ; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php if (Yii::$app->user->id): ?>
        <div class="col-lg-offset-1 col-lg-11">

            <?php
                $form = ActiveForm::begin([
                    'method' => 'post',
                    'action' => ['forum-ask/createans'],
                ])
            ?>
            <?= $form->field($modelsans, 'content')->widget(\yii\redactor\widgets\Redactor::className(),
                [ 'clientOptions' => [ 'imageManagerJson' => ['/redactor/upload/image-json'],
                    'imageUpload' => ['/redactor/upload/image'],
                    'fileUpload' => ['/redactor/upload/file'],
                    'lang' => 'th', 'minHeight' => 300, 'plugins' => ['clips', 'fontcolor','imagemanager']
                ] ])?>
            <?= Html::hiddenInput('forumAsk_id', $models->id); ?>
            <div class="form-group">
                <div class="col-lg-offset-6">
                    <div class="col-lg-offset-9">
                        <?= Html::submitButton('ตอบกระทู้', ['class' => ' btn btn-forum btn-success']); ?>
                    </div>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
          </div>
        </div>
    <?php endif ; ?>
      </div>
   </div>


</div>
