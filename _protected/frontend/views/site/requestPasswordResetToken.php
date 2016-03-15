<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

$this->title = Yii::t('app', 'รีเซตรหัสผ่าน');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset">



    <div class="col-sm-8 col-sm-push-2  col-lg-5 col-lg-push-3 well bs-component">
        <h3 class="login"><?= Html::encode($this->title) ?></h3>

        <p><?= Yii::t('app', 'กรุณากรอกอีเมลเพื่อรีเซตรหัสผ่าน') ?></p>

        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

            <?= $form->field($model, 'email')->textInput(['placeholder' => Yii::t('app', 'อีเมล')]) ?>

            <div class="form-group" align="right">
                <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-success']) ?>
            </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
