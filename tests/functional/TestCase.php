<?php

namespace tests;

use yii\helpers\ArrayHelper;
use yii\web\View;

/**
 * Class TestCase
 * @package tests
 */
abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    public static $params;

    /**
     * Mock application prior running tests.
     */
    protected function setUp()
    {
        $this->mockWebApplication(
            [
                'components' => [
                    'request' => [
                        'class' => 'yii\web\Request',
                        'url' => '/test',
                        'enableCsrfValidation' => false,
                    ],
                    'response' => [
                        'class' => 'yii\web\Response',
                    ],
                ],
            ]
        );
    }

    /**
     * Clean up after test.
     * By default the application created with [[mockApplication]] will be destroyed.
     */
    protected function tearDown()
    {
        parent::tearDown();
        $this->destroyApplication();
    }

    /**
     * @param array $config
     * @param string $appClass
     */
    protected function mockApplication($config = [], $appClass = '\yii\console\Application')
    {
        new $appClass(
            ArrayHelper::merge(
                [
                    'id' => 'testapp',
                    'basePath' => __DIR__,
                    'vendorPath' => $this->getVendorPath(),
                ],
                $config
            )
        );
    }

    /**
     * @param array $config
     * @param string $appClass
     */
    protected function mockWebApplication($config = [], $appClass = '\yii\web\Application')
    {
        new $appClass(
            ArrayHelper::merge(
                [
                    'id' => 'testapp',
                    'basePath' => __DIR__,
                    'vendorPath' => $this->getVendorPath(),
                    'aliases' => [
                        '@bower' => '@vendor/bower-asset',
                        '@npm' => '@vendor/npm-asset',
                    ],
                    'components' => [
                        'request' => [
                            'cookieValidationKey' => 'wefJDF8sfdsfSDefwqdxj9oq',
                            'scriptFile' => __DIR__ . '/index.php',
                            'scriptUrl' => '/index.php',
                        ],
                        'assetManager' => [
                            'class' => 'tests\AssetManager',
                            'basePath' => '@tests/assets',
                            'baseUrl' => '/',
                        ]
                    ]
                ],
                $config
            )
        );
    }

    /**
     * @return string
     */
    protected function getVendorPath()
    {
        //return dirname(dirname(dirname(dirname(__DIR__)))) . '/yii2-developer.loc/vendor';
        return dirname(dirname(__DIR__)) . '/vendor';
    }

    /**
     * Destroys application in Yii::$app by setting it to null.
     */
    protected function destroyApplication()
    {
        \Yii::$app = null;
    }

    /**
     * Creates a view for testing purposes
     *
     * @return View
     */
    protected function getView()
    {
        $view = new View();
        $view->setAssetManager(
            new AssetManager(
                [
                    'basePath' => '@tests/assets',
                    'baseUrl' => '/',
                ]
            )
        );
        return $view;
    }

    /**
     * Asserting two strings equality ignoring line endings
     *
     * @param string $expected
     * @param string $actual
     */
    public function assertEqualsWithoutLE($expected, $actual)
    {
        $expected = str_replace("\r\n", "\n", $expected);
        $actual = str_replace("\r\n", "\n", $actual);
        $this->assertEquals($expected, $actual);
    }
}
