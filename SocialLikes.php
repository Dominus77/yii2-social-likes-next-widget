<?php

namespace dominus77\sociallikesnext;

use yii\web\JsExpression;
use yii\helpers\Json;
use yii\helpers\Html;
use dominus77\sociallikesnext\assets\SocialLikesAsset;

/**
 * Class SocialLikes
 * @package dominus77\sociallikesnext
 */
class SocialLikes extends \yii\base\Widget
{
    /**
     * Theme buttons
     * @var string flat, light, birman
     */
    public $theme = 'flat';

    /**
     * @var array
     */
    public $items = [];

    /**
     * @var array
     */
    public $containerOptions = [];

    /**
     * @var array
     */
    public $clientOptions = [];

    /**
     * @var string
     */
    public $id;

    /**
     * Initializes the widget
     */
    public function init()
    {
        parent::init();
        $this->id = $this->id ? $this->id : $this->getId();
        $this->registerAssets();
        $containerOptions = [
            'id' => $this->id,
        ];
        $this->containerOptions = array_merge($this->containerOptions, $containerOptions);
        $this->containerOptions['class'] = 'social-likes ' . $this->containerOptions['class'];
    }

    /**
     * Run widget
     */
    public function run()
    {
        echo Html::beginTag('div', $this->containerOptions);
        foreach ($this->items as $key => $options) {
            echo Html::tag('div', $key, $options);
        }
        echo Html::endTag('div');
    }

    /**
     * Register client assets
     */
    protected function registerAssets()
    {
        $view = $this->getView();
        SocialLikesAsset::$theme = $this->theme;
        SocialLikesAsset::register($view);
        if ($this->clientOptions) {
            $options = Json::encode($this->clientOptions);
            $script = new JsExpression("
                var container = document.getElementById('{$this->id}');
                var socialLikes = SocialLikesNext.default;
                socialLikes(container, {$options});
            ");
            $view->registerJs($script);
        }
    }
}