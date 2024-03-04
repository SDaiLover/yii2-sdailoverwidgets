Installation
============

Installation consists of two parts: getting composer package and configuring an application. 

## Installing an extension

The preferred way to install this extension is through [composer](https://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist sdailover/yii2-sdailoverwidgets
```

or add

```json
"sdailover/yii2-sdailoverwidgets": "~1.0.0"
```

to the `require` section of your `composer.json`.

## Register asset packages

For register asset packages to use this extension, simply add the following code in your application configuration:

```php
return [
    //....
    'components' => [
        //....

        'assetManager' => [
            'bundles' => [
                'sdailover\yii\widgets\SDaiLoverAsset',
            ],
        ],

        //....
    ],

    //....
];
```

OR register asset using `layout` file:

```php
use sdailover\yii\widgets\SDaiLoverAsset;

//....

SDaiLoverAsset::register($this);

//....
```