<?php
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Dropdown;
use kartik\typeahead\TypeaheadBasic;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;



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
    <title><?= Html::encode('Inspiredev.com') ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => '<img src= "/brand.png" class="img-responsive"  width="70">',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar navbar-material-teal-300 navbar-fixed-top',
                ],

            ]);

            // everyone can see Home page
            $menuItems[] = ['label' => Yii::t('app', 'หน้าหลัก'), 'url' => ['/site/index']];





            // we do not need to display Article/index, About and Contact pages to editor+ roles
            if (!Yii::$app->user->can('editor')) 
            {
                // display dropdown menu category on navbar
                $menuItems[] = ['label' => Yii::t('app','หมวดหมู่' ), 'items' =>[
                    ['label' => Yii::t('app', 'บทเรียนออนไลน์'), 'url' => ['/videos/lesson']],
                    ['label' => Yii::t('app', 'บทความ'), 'url' => ['/article/index']],
                    ['label' => Yii::t('app', 'กระทู้ถาม-ตอบ'), 'url' => ['/forum-ask/forum']],
                ],'option' => ['class' => 'dropdownjs'],];
//                $menuItems[] = ['label' => Yii::t('app', 'บทเรียนออนไลน์'), 'url' => ['/videos/lesson']];
//                $menuItems[] = ['label' => Yii::t('app', 'บทความ'), 'url' => ['/article/index']];
//                $menuItems[] = ['label' => Yii::t('app', 'กระทู้ถาม-ตอบ'), 'url' => ['/forum-ask/forum']];
                $menuItems[] = ['label' => Yii::t('app', 'เกี่ยวกับเรา'), 'url' => ['/site/about']];
                $menuItems[] = ['label' => Yii::t('app', 'ติดต่อเรา'), 'url' => ['/site/contact']];

            }

            // display Article admin page to editor+ roles
            if (Yii::$app->user->can('editor'))
            {
                // display dropdown menu category on navbar for admin
                $menuItems[] = ['label' => Yii::t('app','หมวดหมู่' ), 'items' =>[
                    ['label' => Yii::t('app', 'บทเรียนออนไลน์'), 'url' => ['/videos/index']],
                    ['label' => Yii::t('app', 'บทความ'), 'url' => ['/article/admin']],
                    ['label' => Yii::t('app', 'กระทู้ถาม-ตอบ'), 'url' => ['/forum-ask/index']],
                ],'option' => ['class' => 'dropdownjs'],];
//                $menuItems[] = ['label' => Yii::t('app', 'บทความ'), 'url' => ['/article/admin']];
//                $menuItems[] = ['label' => Yii::t('app', 'กระทู้ถาม-ตอบ'), 'url' => ['/forum-ask/forum']];
//                $menuItems[] = ['label' => Yii::t('app', 'บทเรียนออนไลน'), 'url' => ['/videos/index']];
            }            
            
            // display Signup and Login pages to guests of the site
            if (Yii::$app->user->isGuest) 
            {
                $menuItems[] = ['label' => Yii::t('app', 'สมัครสมาชิก'), 'url' => ['/site/signup']];
                $menuItems[] = ['label' => Yii::t('app', 'เข้าสู่ระบบ'), 'url' => ['/site/login']];
            }
            // display Logout to all logged in users
            else 
            {
                $menuItems[] = [
                    'label' => Yii::t('app', 'ออกจากระบบ'). ' (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }


            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'encodeLabels' => false,
                'items' => $menuItems,
            ]);

        echo '<form class="navbar-form navbar-right" role="search" action="/search" method="get" autocomplete="on">
        <div class="form-group">
          <input type="text" name="search" class="form-control" placeholder="ค้นหา">
        </div>
        <span class="glyphicon glyphicon-search lg"></span>
      </form>';


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
        <p class="pull-left">&copy; <?= Html::encode('www.inspiredev.com') ?> <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
