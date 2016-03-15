Yii2 Superfish jQuery menu widget
=====================================

This is the Yii2 Superfish jQuery menu widget that renders a nice looking menu. 

Example of usage of the widget.

```php
 echo \demogorgorn\superfish\Superfish::widget([
    'options' => [
        'class' => 'uk-float-right',
    ],
    'items' => [
        ['label' => 'First level menu item', 'url' => ['/site/index']],
        ['label' => 'First level menu item', 'url' => ['/site/preimushestva']],
        ['label' => 'First level menu item', 'url' => ['/site/juridicheskie-uslugi']],
        ['label' => 'First level menu item', 'url' => ['/site/tarify']],
        ['label' => 'First level menu item', 'url' => ['/site/publikacii']],
        [
            'label' => 'First level menu item', 
            'url' => ['/site/kontakty'],
            'items' => [
                [
                    'label' => 'Second level menu item', 
                    'url' => ['/site/index'],
                    'items' => [
                        ['label' => 'Third level menu item', 'url' => ['/site/index']],
                        ['label' => 'Third level menu item', 'url' => ['/site/preimushestva']],
                        ['label' => 'Third level menu item', 'url' => ['/site/juridicheskie-uslugi']],
                        ['label' => 'Third level menu item', 'url' => ['/site/tarify']],
                        ['label' => 'Third level menu item', 'url' => ['/site/publikacii']],
                    ],
                ],
                ['label' => 'Second level menu item', 'url' => ['/site/preimushestva']],
                [
                   'label' => 'Second level menu item', 
                   'url' => ['/site/juridicheskie-uslugi'],
                   'options' => ['class' => 'li tag options'],
                   'linkOptions' => ['class' => 'link optionts'],   
                ],
                ['label' => 'Second level menu item', 'url' => ['/site/tarify']],
                ['label' => 'Second level menu item', 'url' => ['/site/publikacii']],
            ],
        ],
    ],
  ]);
```

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require demogorgorn/yii2-superfish-menu "*"
```

or add

```
"demogorgorn/yii2-superfish-menu": "*"
```

to the require section of your `composer.json` file and run `composer update`.

