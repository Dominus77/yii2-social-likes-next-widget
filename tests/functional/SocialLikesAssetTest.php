<?php

namespace tests;

use dominus77\sociallikesnext\assets\SocialLikesAsset;
use yii\web\AssetBundle;

/**
 * Class SocialLikesAssetTest
 * @package tests
 */
class SocialLikesAssetTest extends TestCase
{
    /**
     * @inheritdoc
     */
    public function testRegister()
    {
        $min = YII_ENV_DEV ? '' : '.min';
        $view = $this->getView();
        $this->assertEmpty($view->assetBundles);
        SocialLikesAsset::register($view);
        $this->assertEquals(1, count($view->assetBundles));
        $this->assertTrue($view->assetBundles['dominus77\\sociallikesnext\\assets\\SocialLikesAsset'] instanceof AssetBundle);
        $content = $view->renderFile('@tests/views/layouts/rawlayout.php');
        $this->assertContains('social-likes.css', $content);
        $this->assertContains('social-likes' . $min . '.js', $content);
    }
}
