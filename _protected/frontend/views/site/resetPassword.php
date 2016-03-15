<?php
use nenad\passwordStrength\PasswordInput;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

$this->title = Yii::t('app', 'รีเซตรหัสผ่าน');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="col-sm-8 col-sm-push-2 col-lg-5 col-lg-push-3 well bs-component">

        <p><?= Yii::t('app', 'กรุณากรอกรหัสผ่านใหม่') ?></p>

        <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

            <?= $form->field($model, 'password')->widget(PasswordInput::classname(), []) ?>

            <div class="form-group" align="right">
                <?= Html::submitButton(Yii::t('app', 'บันทึก'), ['class' => 'btn btn-success']) ?>
            </div>
            
        <?php ActiveForm::end(); ?>

    </div>

</div>
