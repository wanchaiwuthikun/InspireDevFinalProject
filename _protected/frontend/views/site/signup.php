<?php
use nenad\passwordStrength\PasswordInput;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = Yii::t('app', 'สมัครสมาชิก');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">

    <div class="col-sm-8 col-sm-push-2  col-lg-5 col-lg-push-3  well bs-component">

        <h3 class="login"><?= Html::encode($this->title)?></h3>

        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->widget(PasswordInput::classname(), []) ?>

            <div class="form-group" align="right">
                <?= Html::submitButton(Yii::t('app', 'สมัครสมาชิก'), ['class' => 'btn btn-info', 'name' => 'signup-button'
                ]) ?>
            </div>

        <?php ActiveForm::end(); ?>

        <?php if ($model->scenario === 'rna'): ?>
            <div style="color:#666;margin:1em 0">
                <i>*<?= Yii::t('app', 'We will send you an email with account activation link.') ?></i>
            </div>
        <?php endif ?>

    </div>
</div>