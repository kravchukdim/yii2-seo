
CMS Extension
======================================

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist kravchukdim/yii2-seo "*"
```

or add

```json
"kravchukdim/yii2-seo": "*"
```

to the require section of your composer.json.


Usage
======================================
```php
'modules' => [
        'admin' => [
            'controllerMap' => [
                'seo-module' => 'yii2mod\seo\controllers\SeoController',
                'seo-category-module' => 'yii2mod\seo\controllers\SeoCategoryController'
            ],
        ],
    ],
```

```php
 'components' => [
        
    ],
```

```php
    /**
     * @return array
     */
    public function actions()
    {
        return [
            'page' => [
                'class' => 'yii2mod\cms\actions\PageAction',
            ],
        ];
    }
```
