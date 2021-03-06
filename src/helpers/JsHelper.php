<?php

namespace ethercap\ledap\helpers;

use Yii;

class JsHelper
{
    public static function register($view, $option = [], $key = null)
    {
        $url = $option['url'] ?? Yii::$app->controller->getRoute();
        $base = $option['base'] ?? '/js';
        $path = $base.'/'.$url.'.js';
        unset($option['url']);
        unset($option['base']);
        empty($option['depends']) && $option['depends'] = [\ethercap\ledap\assets\LedapAsset::className()];
        //判断js是否存在
        $basePath = Yii::getAlias('@webroot');
        $baseUrl = Yii::getAlias('@web');
        $filePath = $basePath.$path;
        if (is_file($filePath)) {
            $timestamp = @filemtime("$filePath");
            $view->registerJsFile($baseUrl.$path.'?v='.$timestamp, $option, $key);
        }
    }
}
