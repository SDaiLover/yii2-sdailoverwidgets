<p align="center">
    <a href="https://www.sdailover.com/" target="_blank">
        <img src="https://sdailover.github.io/images/logo.png" width="128px">
    </a>
    <h1 align="center">The SDaiLover Widget packages for Yii 2</h1>
    <br>
</p>

# yii2-sdailoverwidgets

A package of UI Elements to display and use in View files. The package in it is integrated with Bootstrap & jQuery for [Yii framework 2.0](https://www.yiiframework.com).

For license information check the [LICENSE](LICENSE.md)-file.

[![PHP Language](https://img.shields.io/badge/%20Lang%20-%20PHP%208.1%20-gray.svg?colorA=2C5364&colorB=0F2027&style=flat&logo=php&logoColor=white)](https://github.com/sdailover/yii2-sdailoverwidgets)
[![Code Editor](https://img.shields.io/badge/%20IDE%20-%20Visual%20Code%20-gray.svg?colorA=2C5364&colorB=0F2027&style=flat&logo=visualstudio&logoColor=white)](https://github.com/sdailover/yii2-sdailoverwidgets)
[![PHP Framework](https://img.shields.io/badge/%20Framework%20-%20Yii%202.0%20-gray.svg?colorA=2C5364&colorB=0F2027&style=flat&logo=framework&logoColor=white)](https://github.com/sdailover/yii2-sdailoverwidgets)
[![CSS Bootstrap](https://img.shields.io/badge/%20CSS%20-%20Bootstrap%205.3%20-gray.svg?colorA=2C5364&colorB=0F2027&style=flat&logo=bootstrap&logoColor=white)](https://github.com/sdailover/yii2-sdailoverwidgets)
[![JS jQuery](https://img.shields.io/badge/%20JS%20-%20jQuery%203.2%20-gray.svg?colorA=2C5364&colorB=0F2027&style=flat&logo=jquery&logoColor=white)](https://github.com/sdailover/yii2-sdailoverwidgets)


[![Latest Stable Version](https://poser.pugx.org/sdailover/yii2-sdailoverwidgets/v/stable.png)](https://packagist.org/packages/sdailover/yii2-sdailoverwidgets)
[![Total Downloads](https://poser.pugx.org/sdailover/yii2-sdailoverwidgets/downloads.png)](https://packagist.org/packages/sdailover/yii2-sdailoverwidgets)
[![GitHub watchers](https://img.shields.io/github/watchers/sdailover/yii2-sdailoverwidgets)](https://github.com/sdailover/yii2-sdailoverwidgets)
[![GitHub Repo stars](https://img.shields.io/github/stars/sdailover/yii2-sdailoverwidgets)](https://github.com/sdailover/yii2-sdailoverwidgets)
[![GitHub issues](https://img.shields.io/github/forks/sdailover/yii2-sdailoverwidgets)](https://github.com/sdailover/yii2-sdailoverwidgets)

[![GitHub contributors](https://img.shields.io/github/contributors/sdailover/yii2-sdailoverwidgets)](https://github.com/sdailover/yii2-sdailoverwidgets)
[![GitHub pull requests](https://img.shields.io/github/issues-pr/sdailover/yii2-sdailoverwidgets)](https://github.com/sdailover/yii2-sdailoverwidgets/pulls)
[![GitHub issues](https://img.shields.io/github/issues/sdailover/yii2-sdailoverwidgets)](https://github.com/sdailover/yii2-sdailoverwidgets/issues)
[![GitHub Discussions](https://img.shields.io/github/discussions/sdailover/yii2-sdailoverwidgets)](https://github.com/sdailover/yii2-sdailoverwidgets/discussions)
[![GitHub last commit (by committer)](https://img.shields.io/github/last-commit/sdailover/yii2-sdailoverwidgets)](https://github.com/sdailover/yii2-sdailoverwidgets)


[Report Bug](https://github.com/sdailover/yii2-sdailoverwidgets/issues/new?assignees=&labels=bug&projects=&template=bug_report.yml)
·
[Request Feature](https://github.com/sdailover/yii2-sdailoverwidgets/issues/new?assignees=&labels=enhancement&projects=&template=feature_request.yml)
·
[Provide Feedback](https://github.com/sdailover/yii2-sdailoverwidgets/discussions/new?category=ideas&title=Suggest%20for%20Yii2%20SDaiLover%20Widgets)
·
[Ask Question](https://github.com/sdailover/yii2-sdailoverwidgets/discussions/new?category=q-a&title=Ask%20Question%20for%20Yii2%20SDaiLover%20Widgets)

Love the project? Please consider [donating](https://opencollective.com/sdailover) or give :star: to help it improve!

Copyright &copy; ID 2024 SDaiLover &#40;[www.sdailover.com](https://sdailover.com)&#41;

All rights reserved.

***

Installation
------------

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


App Configuration
-----

To use this extension, simply add the following code in your application configuration:

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

OR register asset in `layout` template file:

```php
use sdailover\yii\widgets\SDaiLoverAsset;

//....

SDaiLoverAsset::register($this);

//....
```


Usage
-----

To learn more about Usage and Documentation, please visit [docs/guide/README.md](docs/guide/README.md).


# Support the project

We open-source almost everything We can and try to reply to everyone needing help using these projects. Obviously, this takes time. You can use this service for free.

If you are using this project and are happy with it or just want to encourage us to continue creating stuff, there are a few ways you can do it:

- Giving proper credit on the GitHub Sponsors page. [![Static Badge](https://img.shields.io/badge/%20Sponsor%20-gray.svg?colorA=EAEAEA&colorB=EAEAEA&style=fat&logo=githubsponsors&logoColor=EA4AAA)](https://github.com/sponsors/sdailover)
- Starring and sharing the project :star:
- You can make one-time donations via PayPal. I'll probably buy a coffee :coffee: or tea :tea: or cake :cake: <br>
  [![paypal.me/sdailover](https://img.shields.io/badge/%20Donate%20Now%20-gray.svg?colorA=2C5364&colorB=0F2027&style=for-the-badge&logo=paypal&logoColor=white)](https://www.paypal.me/sdailover)
- It’s also possible to support mine financially by becoming a backer or sponsor through<br>
  [![opencollective.com/sdailover](https://img.shields.io/badge/%20Donate%20Now%20-gray.svg?colorA=355C7D&colorB=2980B9&style=for-the-badge&logo=opencollective&logoColor=white)](https://www.opencollective.com/sdailover)
  
However, we also provide software development services. You can also invite us to collaborate to help your business in developing the software you need. Please contact us at:<br>
[![team@sdailover.com](https://img.shields.io/badge/%20Send%20Mail%20-gray.svg?colorA=EA4335&colorB=93291E&style=for-the-badge&logo=gmail&logoColor=white)](mailto:team@sdailover.com)

## :pray: Thanks for your contribute and support! :heart_eyes: :heart:

> Any Questions & Other Supports? see [Support](https://github.com/sdailover/.github/blob/master/SUPPORT.md) please.

***

[Visit Website](https://www.sdailover.com)
·
[Global Issues](https://github.com/sdailover/.github/issues/new/choose)
·
[Global Discussions](https://github.com/sdailover/.github/discussions)
·
[Global Wiki](https://github.com/sdailover/.github/wiki)


Copyright &copy; ID 2024 by SDaiLover &#40;[www.sdailover.com](https://sdailover.com)&#41;

[![SDaiLover License](https://upload.wikimedia.org/wikipedia/commons/thumb/1/18/Bsd-license-icon-120x42.svg/120px-Bsd-license-icon-120x42.svg.png)](https://github.com/sdailover/.github/blob/master/LICENSE.md)

All rights reserved.