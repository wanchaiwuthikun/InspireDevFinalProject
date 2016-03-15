<?php
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'inspiredev.com';
?>
<div class="site-index">
    <div class="body-content">
          <div class="col-lg-4">
                <div class="panel panel-default">
                      <div class="panel-heading">
                           <h4>  จัดการผู้ใช้งาน </h4>
                      </div>
                      <div class="panel-body" align="center">
                         <?= Html::a(Html::img('@getImage/image/multiple25.png',
                             [ 'class' => 'img-round',
                                'width' => '140 px']), ['user/index']);
                         ?>
                      </div>
                </div>
          </div>
      <div class="col-lg-4">
         <div class="panel panel-default">
            <div class="panel-heading">
                    <h4>  จัดการTags </h4>
            </div>
            <div class="panel-body" align="center">
               <?= Html::a(Html::img('@getImage/image/tags11.png',
                    [ 'class' => 'img-round',
                      'width' => '140 px']),['tag/index']) ;
               ?>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="panel panel-default">
           <div class="panel-heading">
              <h4>  จัดการคอร์ส</h4>
           </div>
           <div class="panel-body" align="center">
               <?= Html::a( Html::img('@getImage/image/books8.png',
                  [ 'class' => 'img-round',
                    'width' => '140 px']), ['course/index']);
               ?>
           </div>
         </div>
      </div>
    </div>
</div>

