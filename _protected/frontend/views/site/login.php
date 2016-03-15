<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = Yii::t('app', 'เข้าสู่ระบบ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class=" col-sm-8 col-sm-push-2  col-lg-4 col-lg-push-4 well bs-component">
<!--    <div class="col-lg-4 col-lg-push-4 col-sm-6 col-sm-push-3 well bs-component">-->
<!--        <div class="card-main">-->
<!--            <div class="card-header">-->
<!--                <div class="card-inner">-->
                    <h3 class="login"><?= Html::encode($this->title) ?></h3>
<!--                </div>-->
<!--            </div>-->

<!--        <p>--><?//= Yii::t('app', 'Please fill out the following fields to login:') ?><!--</p>-->
<!--        --><?//= Html::encode($this->title) ?>
<!--        <div class="card-inner">-->
        <?php $form = ActiveForm::begin(['id' => 'login-form', 'class' => 'horizontal']); ?>

        <?php //-- use email or username field depending on model scenario --// ?>
        <?php if ($model->scenario === 'lwe'): ?>
            <?= $form->field($model, 'email') ?>        
        <?php else: ?>
            <?= $form->field($model, 'username') ?>
        <?php endif ?>

        <?= $form->field($model, 'password')->passwordInput() ?>
<!--        --><?//= $form->field($model, 'rememberMe')->checkbox() ?>

        <div style="color:#999;margin:1em 0">
            <?= Yii::t('app', 'ลืมรหัสผ่าน?') ?>
            <?= Html::a(Yii::t('app', 'คลิกที่นี่'), ['site/request-password-reset']) ?>
        </div>

        <div class="form-group " align="right">

            <?= Html::submitButton(Yii::t('app', ' เข้าสู่ระบบ'), ['class' => 'btn btn-success ', 'name' => 'login-button']) ?>

        </div>

        <?php ActiveForm::end(); ?>
        </div>
    </div>

  
</div>
