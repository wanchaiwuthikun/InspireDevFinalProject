<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = Yii::t('app', 'สร้างบทความ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'บทความ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <h1><?= Html::encode($this->title) ?></h1>


    <hr>
        <?= $this->render('_form', ['model' => $model, 'model2' => $model2,'model3' => $model3]) ?>



</div>
