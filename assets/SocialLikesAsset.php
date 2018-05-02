<?php

namespace dominus77\sociallikesnext\assets;

use yii\web\AssetBundle;

/**
 * Class SocialLikesAsset
 * @package dominus77\sociallikesnext\assets
 */
class SocialLikesAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '';

    /**
     * @var array
     */
    public $css = [];

    /**
     * @var array
     */
    public $js = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $min = YII_ENV_DEV ? '' : '.min';
        $this->sourcePath = __DIR__ . '/src/dist';
        $this->css[] = 'social-likes.css';
        $this->js[] = 'social-likes' . $min . '.js';
    }
}
