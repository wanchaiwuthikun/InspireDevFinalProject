<?php
use backend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => '<img src= "http://www.inspiredev.com/uploads/image/brand.png" class="img-responsive" width="60px" >',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-default navbar-fixed-top',
                ],
            ]);

            // display Account and Users to admin+ roles
            if (Yii::$app->user->can('admin'))
            {
                $menuItems[] = ['label' => Yii::t('app', 'หน้าแรก'), 'url' => ['/site/index']];
                $menuItems[] = ['label' => Yii::t('app', 'จัดการผู้ใช้งาน'), 'url' => ['/user/index']];
                $menuItems[] = ['label' => Yii::t('app', 'จัดการคอร์ส'), 'url' => ['/course/index']];
                $menuItems[] = ['label' => Yii::t('app', 'แท็ก'), 'url' => ['/tag/index']];


            }
            
            // display Login page to guests of the site
            if (Yii::$app->user->isGuest) 
            {

                $menuItems[] = ['label' => Yii::t('app', 'เข้าสู่ระบบ'), 'url' => ['/site/login']];

            }
            // display Logout to all logged in users
            else 
            {
//                $menuItems[] = ['label' => Yii::t('app', 'หน้าแรก'), 'url' => ['/site/index']];
//                $menuItems[] = ['label' => Yii::t('app', 'จัดการผู้ใช้งาน'), 'url' => ['/user/index']];
//                $menuItems[] = ['label' => Yii::t('app', 'จัดการคอร์ส'), 'url' => ['/course/index']];
//                $menuItems[] = ['label' => Yii::t('app', 'แท็ก'), 'url' => ['/tag/index']];
                $menuItems[] = [
                    'label' => Yii::t('app', 'ออกจากระบบ'). ' (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; <?= Html::encode('inspiredev.com');?> <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
