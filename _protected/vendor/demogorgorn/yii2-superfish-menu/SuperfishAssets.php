<?php
/**
 * Assets class file
 *
 * @author Oleg Martemjanov
 */
namespace demogorgorn\superfish;

use yii\web\AssetBundle;
use Yii;

class SuperfishAssets extends AssetBundle
{
	public $sourcePath = '@sf/superfish';
	public $basePath = '@webroot/assets';
	public $css = [
         'css/superfish.css'
	 ];
	public $js = [
		'js/hoverIntent.js',
		'js/superfish.js',
	];
	public $depends = [
		'yii\web\JqueryAsset',
	];

	public function init() {
		Yii::setAlias('@sf', __DIR__);
		return parent::init();
	}
}
