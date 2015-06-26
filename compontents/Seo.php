<?php

namespace yii2mod\seo\components;

use Yii;
use yii\base\Exception;
use yii\helpers\Url;

/**
 * @author  Kravchuk Dmitry
 */
class Seo
{
    private static $_instance = null;

    private $seoPage = null;

    private function __construct()
    {
        // find seo model by url
        $url = Url::current();
        // $seoModel = SeoModel::find()->byUrl($url);
        // $class = $seoModel->class;
        // $metaTitle = $seoModel->metaTitle;
        // $metaKeyWords = $seoModel->metaKeyWords;
        // $metaDescription = $seoModel->metaDescription;
        // $pageContent = $seoModel->pageContent;

        $metaTitle = 'title';
        $metaKeyWords = 'key';
        $metaDescription = $url;
        $pageContent = $url;

        $config = [
            'class' => 'app\components\seo\Seo1Page',
            'metaTitle' => $metaTitle,
            'metaKeyWords' => $metaKeyWords,
            'metaDescription' => $metaDescription,
            'pageContent' => $pageContent
        ];

        $seoPage = Yii::createObject($config);

        if (empty($seoPage)) {
            throw new Exception('Error');
        }
        $this->seoPage = $seoPage;

    }

    protected function __clone() {

    }


    static public function getInstance()
    {
        if(is_null(self::$_instance))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    static public function setTitle($options = [])
    {
        return self::getInstance()->seoPage->setTitle($options);
    }

    static public function getTitle()
    {
        return self::getInstance()->seoPage->getMetaTitle();
    }

    static public function metaTags($keyWord = true, $description = true, $options = [])
    {
        return self::getInstance()->seoPage->setHeaderMetaTags($keyWord, $description, $options);
    }

    static public function setPageContentTag($options = [])
    {
        echo self::getInstance()->seoPage->getPageContentTag($options);
    }

    static public function getPageContentTag($options = [])
    {
        return self::getInstance()->seoPage->getPageContentTag($options);
    }





}
