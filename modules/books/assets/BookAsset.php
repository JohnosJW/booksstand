<?php

namespace app\modules\books\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class BookAsset extends AssetBundle
{
    public $basePath = '@app/modules/books/assets';
    public $baseUrl = '@web';
    public $css = [
        'lightbox/css/lightbox.css'
    ];
    public $js = [
        'js/books.js',
        'lightbox/js/lightbox.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
