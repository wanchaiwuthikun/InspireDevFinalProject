<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = Yii::t('app', 'ติดต่อเรา');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <div class="col-sm-8 col-sm-push-2 col-lg-6 col-lg-push-3 well bs-component">

        <h3 class="login"><?= Html::encode('ติดต่อเรา') ?></h3>

        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'subject') ?>
            <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row">
                                    <div class="col-lg-4">{image}</div>
                               </div>
                               <div class="row">
                                    <div class="col-lg-6">{input}</div>
                               </div>',
            ]) ?>

            <div class="form-group " align="right">
                <?= Html::submitButton(Yii::t('app', 'ยืนยัน'), ['class' => 'btn btn-success', 'name' => 'contact-button']) ?>
            </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
