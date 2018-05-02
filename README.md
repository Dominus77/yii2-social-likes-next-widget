# yii2-social-likes-next-widget

[![Latest Stable Version](https://poser.pugx.org/dominus77/yii2-social-likes-next-widget/v/stable)](https://packagist.org/packages/dominus77/yii2-social-likes-next-widget)
[![License](https://poser.pugx.org/dominus77/yii2-social-likes-next-widget/license)](https://github.com/Dominus77/yii2-social-likes-next-widget/blob/master/LICENSE.md)
[![Build Status](https://travis-ci.com/Dominus77/yii2-social-likes-next-widget.svg?branch=master)](https://travis-ci.com/Dominus77/yii2-social-likes-next-widget)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Dominus77/yii2-social-likes-next-widget/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Dominus77/yii2-social-likes-next-widget/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Dominus77/yii2-social-likes-next-widget/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Dominus77/yii2-social-likes-next-widget/?branch=master)
[![Total Downloads](https://poser.pugx.org/dominus77/yii2-social-likes-next-widget/downloads)](https://packagist.org/packages/dominus77/yii2-social-likes-next-widget)
[![PayPal donate button](https://img.shields.io/badge/paypal-donate-yellow.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=WYHQTDY4YWTHQ "Donate once-off to this project using Paypal")
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/50402619-dbb3-4e68-b6b2-fe0cad215bb9/mini.png)](https://insight.sensiolabs.com/projects/50402619-dbb3-4e68-b6b2-fe0cad215bb9)

Renders a [Social Likes Next](http://social-likes-next.js.org/) widget for Yii2.

Beautiful share buttons for social networks: Facebook, Twitter, Google+, Pinterest, Telegram, LinkedIn, Vkontakte and Odnoklassniki.

## Installation

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


## Usage

Once the extension is installed, simply use it in your code by  :

```php
<?= \dominus77\sociallikesnext\SocialLikes::widget([
        'theme' => \dominus77\sociallikesnext\SocialLikes::THEME_FLAT, // THEME_FLAT, THEME_LIGHT, THEME_BIRMAN, default(THEME_FLAT)
        'title' => true,    // Display name of social networks, set default true
        /*'containerOptions' => [
            //'class' => 'social-likes_vertical',       // All buttons in a column.
            'data-url' => 'http://landscapists.info/',  // URL of a shareable page. Current page by default.
            'data-title' => 'Landscapists of Russia',   // Title for Twitter and Vkontakte. Current page’s title by default.
        ],*/
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
            'Vkontakte' => [
                'serviceOptions' => [
                    'title' => 'Share link on Vkontakte',
                    'data-service' => 'vkontakte',
                ],
            ],
            'Odnoklassniki' => [
                'serviceOptions' => [
                    'title' => 'Share link on Odnoklassniki',
                    'data-service' => 'odnoklassniki',
                ],
            ],
            'Facebook' => [
                'serviceOptions' => [
                    'title' => 'Share link on Facebook',
                    'data-service' => 'facebook',
                ],
            ],
            'Twitter' => [
                'serviceOptions' => [
                    'title' => 'Share link on Twitter',
                    'data-service' => 'twitter',
                ],
            ],
            'Google+' => [
                'serviceOptions' => [
                    'title' => 'Share link on Google+',
                    'data-service' => 'plusone',
                ],
            ],
            'Telegram' => [
                'serviceOptions' => [
                    'title' => 'Share link on Telegram',
                    'data-service' => 'telegram',
                ],
            ],
            'LinkedIn' => [
                'serviceOptions' => [
                    'title' => 'Share link on LinkedIn',
                    'data-service' => 'linkedin',
                ],
            ],
            // Add new button
            'My World' => [
                'serviceOptions' => [
                    'title' => 'Share link on My World',
                    'data-service' => 'mailru',
                ],
            ],
        ],
        // Register new buttons
        'clientButtons' => [
            'mailru' => [
                'popupUrl' => 'http://connect.mail.ru/share?url={url}',
                'popupWidth' => 550,
                'popupHeight' => 360,
            ],
        ],
        // Css new buttons
        'clientCss' => '
            /* begin style My World link */
            .social-likes__button_mailru,
            .social-likes__button_mailru:link,
            .social-likes__button_mailru:visited {
                padding-left: 22px;
                background: #168DE2;
                background: linear-gradient(top, #168DE2, #168DE2);
                color: #fff;
                border-color: #d4d4d4;
                border-bottom-color: #bcbcbc;
                text-decoration: none;
            }
            .social-likes__button_mailru:hover {
                background: #168DE2;
                background: linear-gradient(top, #168DE2, #168DE2);
                color: #fff;
                border-color: #d4d4d4;
                border-bottom-color: #bcbcbc;
            }
            .social-likes__icon_mailru {
                background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEwAACxMBAJqcGAAAAl9JREFUOI2dkktIlFEcxX/3zjfjvLQZZ0aNFlo+w40a4lLDqCQLFSIIapGMbTJoFbSyZYi7iLDHopBaRERIZQsJgyAqC6w0K5PpMeq8REdnnG/m+1pMM5OGUJ3NvXDvOf97zrnC0/+1Syd1WUrp4R+goQWlLr3C3T+7sBlZ/Fr1zUQ0LaBsJDvMkp6GfNorLZQ7jQgBMxGVh59iDI5HCaymsnellB5RNODLDmjalsf1gy6EENydXOF9UEUIqCs20VljJaWBdzjEmC+eE8lsKguN3O7y8GZepeman/vTMYptBiyK4MKzJRqv+nnxY42bHW6qXcaczcwLhjo9VBYqtNyYo6/ZwdFaG6/mEjjNkq12A9+WUlx5vcyJOjv+aIpj94IAKABOs6R1u5lzoxHaKiwc3mljz9A8U0EVAZzclc/5Zgd2k+TSy2UutrmwmwTRhJ62UOUyIoDn39foqLby4FOMqaCabWBwfJlIXAPgbUDFIKDCacxlkKkrqUGeQRBNaOvq0nVIpNJZKzLTwG8hfgynp9WXmHg8E2N/uQWHOZsvh6qsFNsMQLoRgC+RZC6DUEzjqS9OT0M+B27Ns7vMwpPjJYx8jlFkM9BaZiYc0/BYJUdqbYz54llLBtu+M30A7wIqpxsLqHGb6H0UxreUpHSLgj+a4uzoIgI41ViAWRF0D4cIxbT1NQK0lJoZbHehpnTuTK4ysZBAkYL6EhNDEyvYTYKZxSRz0dxvXCcA4LYa6K6zs7fcwg6HghDwIajSOxJmOqSyEcI9MBuQSPcfJ38BDX1BSl16NU0L/BdZx/sTN5bhRMzqNqQAAAAASUVORK5CYII=");
                background-repeat: no-repeat;
                background-position: -2px 2px;
            }
            .social-likes__widget_mailru {
                background: #168DE2;
                background: linear-gradient(top, #168DE2, #168DE2);
            }
            .social-likes__widget_notext .social-likes__icon_mailru {
                background-position: 0px 0px;
            }
            /* end style My World link */
        ',
    ]); ?>
```

## More Information
Please, check the [Social Likes Next](https://github.com/sapegin/social-likes-next/tree/v1.1.0)

## License
The MIT License (MIT). Please see [License File](https://github.com/Dominus77/yii2-social-likes-next-widget/blob/master/LICENSE.md) for more information.

## Sensio Labs
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/50402619-dbb3-4e68-b6b2-fe0cad215bb9/big.png)](https://insight.sensiolabs.com/projects/50402619-dbb3-4e68-b6b2-fe0cad215bb9)
