
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
You need execute seo init migration by the following command:
```
php yii migrate/up --migrationPath=@kravchukdim/yii2seo/migrations
```

To use this extension, you have to configure the main config in your application:
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

You can use component seo in your layouts, views, controllers like following:

```
    use kravchukdim\yii2seo\components\Seo;

    Seo::setTitle($options);
    Seo::setPageContentTag($options);
    Seo::setMetaTags($options);
```
