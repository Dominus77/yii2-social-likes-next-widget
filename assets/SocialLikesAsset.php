<?php

namespace dominus77\sociallikesnext\assets;

use yii\web\AssetBundle;

/**
 * Class SocialLikesAsset
 * @package dominus77\sociallikesnext\assets
 */
class SocialLikesAsset extends AssetBundle
{
    public static $theme;

    public $sourcePath = '@dominus77/sociallikesnext/assets/src';

    public $css = [];

    public $js = [];

    public function init()
    {
        $min = YII_ENV_DEV ? '' : '.min';
        $this->css[] = 'dist/social-likes_' . self::$theme . '.css';
        $this->js[] = 'dist/social-likes' . $min . '.js';
    }
}