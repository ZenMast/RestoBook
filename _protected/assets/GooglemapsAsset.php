<?php
/**
 * -----------------------------------------------------------------------------
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 * -----------------------------------------------------------------------------
 */

namespace app\assets;

use yii\web\AssetBundle;
use Yii;

// set @themes alias so we do not have to update baseUrl every time we change themes
 Yii::setAlias('@themes', Yii::$app->view->theme->baseUrl);

class GooglemapsAsset extends AssetBundle
{
    public $basePath = '@webroot';
     public $baseUrl = '@themes';

//     public $css = [
//         'css/site.css',
//     ];
// 	public $jsOptions= [ 'position' => \yii\web\VIEW::POS_BEGIN];
	
    public $js = [ 'js/googlemaps.js'
    ];

//     public $depends = [
//         'yii\web\YiiAsset',
//     ];
}