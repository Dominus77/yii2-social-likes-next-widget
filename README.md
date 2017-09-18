README
======
Renders a [Social Likes Next](https://github.com/sapegin/social-likes-next) widget for Yii2.

Beautiful share buttons for social networks: Facebook, Twitter, Google+, Pinterest, Telegram, LinkedIn, Vkontakte and Odnoklassniki.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require dominus77/yii2-social-likes-next-widget "*"
```

or add

```
"dominus77/yii2-social-likes-next-widget": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \dominus77\sociallikesnext\SocialLikes::widget([
        'theme' => 'flat', // flat, light, birman
        /*'containerOptions' => [
            'class' => 'social-likes_vertical',        // All buttons in a column.
            'data-url' => 'http://landscapists.info/', // URL of a shareable page. Current page by default.
            'data-title' => 'Landscapists of Russia',  // Title for Twitter and Vkontakte. Current page’s title by default.
        ],*/
        /*'clientOptions' => [
            'url' => 'http://github.com/',
            'title' => 'GitHub',
            'data' => [
                'media' => 'http://birdwatcher.ru/i/userpic.jpg',
            ],
        ],*/
        'items' => [
            'Pinterest' => [
                'title' => 'Share link on Pinterest',
                'data' => [
                    'service' => 'pinterest',
                    'media' => 'image link, required',
                ],
            ],
            'Vkontakte' => [
                'title' => 'Share link on Vkontakte',
                'data-service' => 'vkontakte',
            ],
            'Odnoklassniki' => [
                'title' => 'Share link on Odnoklassniki',
                'data-service' => 'odnoklassniki',
            ],
            'Facebook' => [
                'title' => 'Share link on Facebook',
                'data-service' => 'facebook',
            ],
            'Twitter' => [
                'title' => 'Share link on Twitter',
                'data-service' => 'twitter',
            ],
            'Google+' => [
                'title' => 'Share link on Google+',
                'data-service' => 'plusone',
            ],
            'Telegram' => [
                'title' => 'Share link on Telegram',
                'data-service' => 'telegram',
            ],
            'LinkedIn' => [
                'title' => 'Share link on LinkedIn',
                'data-service' => 'linkedin',
            ],
        ],
    ]); ?>
```

More Information
-----
Please, check the [Social Likes Next](https://github.com/sapegin/social-likes-next/tree/v1.1.0)

License
-----
The BSD License (BSD). Please see [License File](https://github.com/Dominus77/yii2-social-likes-next-widget/blob/master/LICENSE.md) for more information.