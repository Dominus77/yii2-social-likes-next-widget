<?php

namespace dominus77\sociallikesnext;

use yii\web\View;
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
    const THEME_FLAT = 'flat';
    const THEME_LIGHT = 'light';
    const THEME_BIRMAN = 'birman';

    /**
     * Theme buttons
     * @var string flat, light, birman
     */
    public $theme = 'flat';

    /**
     * Display name of social networks, default true
     * @var bool
     */
    public $title = true;

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
     * @var array
     */
    public $clientButtons = [];

    /**
     * @var string
     */
    public $clientCss = '';

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
        $this->containerOptions['class'] = (isset($this->containerOptions['class']) && !empty($this->containerOptions['class'])) ?
            $this->theme . ' social-likes ' . $this->containerOptions['class'] :
            $this->theme . ' social-likes';
    }

    /**
     * Run widget
     * @return string|void
     */
    public function run()
    {
        echo Html::beginTag('div', $this->containerOptions) . PHP_EOL;
        $this->renderItems();
        echo Html::endTag('div') . PHP_EOL;
    }

    /**
     * Render items
     */
    protected function renderItems()
    {
        foreach ($this->items as $key => $options) {
            $title = $this->title;
            if (isset($options['title']))
                $this->title = $options['title'];
            if (isset($options['serviceOptions']))
                echo Html::tag('div', $this->title ? $key : '', $options['serviceOptions']) . PHP_EOL;
            $this->title = $title;
        }
    }

    /**
     * Register client assets
     */
    protected function registerAssets()
    {
        $view = $this->getView();
        SocialLikesAsset::register($view);
        $this->registerClientCss($view);
        $this->registerClientButton($view);
        $this->registerClientOptions($view);
    }

    /**
     * @param null|\yii\web\View $view
     */
    protected function registerClientCss($view = null)
    {
        if (!empty($this->clientCss)) {
            $view->registerCss($this->clientCss);
        }
    }

    /**
     * @param null|\yii\web\View $view
     */
    protected function registerClientButton($view = null)
    {
        if (!empty($this->clientButtons)) {
            $clientButtons = Json::encode($this->clientButtons);
            $script = new JsExpression("
                var socialLikesButtons = {$clientButtons}
            ");
            $view->registerJs($script, View::POS_BEGIN);
        }
    }

    /**
     * @param null|\yii\web\View $view
     */
    protected function registerClientOptions($view = null)
    {
        if (!empty($this->clientOptions)) {
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
