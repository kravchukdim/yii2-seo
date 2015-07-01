
SEO Extension
======================================

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist kravchukdim/yii2seo "*"
```

or add

```json
"kravchukdim/yii2seo": "*"
```

to the require section of your composer.json.


Usage
======================================
```php
'modules' => [
        'admin' => [
            'controllerMap' => [
                'seo-module' => 'kravchukdim\yii2seo\controllers\SeoController',
                'seo-category-module' => 'kravchukdim\yii2seo\controllers\SeoCategoryController'
            ],
        ],
    ],
```

```php
 'components' => [
        
    ],
```
