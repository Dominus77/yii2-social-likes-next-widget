<?php

namespace tests;

use yii\helpers\Json;
use dominus77\sociallikesnext\SocialLikes;

/**
 * Class SocialLikesTest
 * @package tests
 */
class SocialLikesTest extends TestCase
{
    /**
     * check getOptions()
     */
    public function testGetClientOptions()
    {
        $widget = new SocialLikes([
            'theme' => \dominus77\sociallikesnext\SocialLikes::THEME_FLAT,
            'title' => true,
            'containerOptions' => [
                'class' => 'social-likes_vertical',
                'data-url' => 'http://landscapists.info/',
                'data-title' => 'Landscapists of Russia',
            ],
        ]);

        $clientOptions = [
            'theme' => 'flat',
            'title' => true,
            'containerOptions' => [
                'class' => 'social-likes_vertical',
                'data-url' => 'http://landscapists.info/',
                'data-title' => 'Landscapists of Russia',
            ],
        ];
        $this->assertJson(Json::encode($clientOptions), $widget->clientOptions);
    }

    public function testRun()
    {
        $widget = new SocialLikes([
            'theme' => 'flat',
            'title' => true,
            'items' => [
                'Pinterest' => [
                    'title' => false, // Display name of social network, default global params
                    'serviceOptions' => [
                        'title' => 'Share link on Pinterest',
                        'data' => [
                            'service' => 'pinterest',
                            'media' => 'image link, required',
                        ],
                    ],
                ],
                'My World' => [
                    'serviceOptions' => [
                        'title' => 'Share link on My World',
                        'data-service' => 'mailru',
                    ],
                ],
            ],
            'clientButtons' => [
                'mailru' => [
                    'popupUrl' => 'http://connect.mail.ru/share?url={url}',
                    'popupWidth' => 550,
                    'popupHeight' => 360,
                ],
            ],
            'clientCss' => '.social-likes__button_mailru,',
        ]);
        $this->assertEquals($widget->run(), null);
    }

    public function testRegisterClientOptions()
    {
        $view = \Yii::$app->getView();
        $widget = new SocialLikes();
        $widget->clientOptions = [
            'title' => 'GitHub'
        ];
        $this->assertEquals($widget->registerClientOptions($view), null);
    }
}
