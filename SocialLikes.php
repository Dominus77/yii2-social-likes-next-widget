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
        $this->id = $this->id ?: $this->getId();
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
        if (!empty($this->items)) {
            $this->registerAssets();
            echo Html::beginTag('div', $this->containerOptions) . PHP_EOL;
            $this->renderItems($this->items);
            echo Html::endTag('div') . PHP_EOL;
        }
    }

    /**
     * Render items
     * @param array $items
     */
    public function renderItems($items = [])
    {
        foreach ($items as $key => $options) {
            if (isset($options['serviceOptions']))
                echo Html::tag('div', $this->getContentTitle($options) ? $key : '', $options['serviceOptions']) . PHP_EOL;
        }
    }

    /**
     * @param array $options
     * @return bool|mixed
     */
    protected function getContentTitle($options = [])
    {
        return (isset($options['title'])) ? $options['title'] : $this->title;
    }

    /**
     * Register resources
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
     * @param \yii\web\View $view
     */
    protected function registerClientCss($view)
    {
        if (!empty($this->clientCss)) {
            $view->registerCss($this->clientCss);
        }
    }

    /**
     * @param \yii\web\View $view
     */
    protected function registerClientButton($view)
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
     * @param \yii\web\View $view
     */
    public function registerClientOptions($view)
    {
        if (!empty($this->clientOptions)) {
            $options = Json::encode($this->clientOptions);
            $id = $this->containerOptions['id'];
            $script = new JsExpression("
                var container = document.getElementById('{$id}');
                var socialLikes = SocialLikesNext.default;
                socialLikes(container, {$options});
            ");
            $view->registerJs($script);
        }
    }
}
