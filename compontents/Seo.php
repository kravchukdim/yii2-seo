<?php

namespace yii2mod\seo\components;

use Yii;
use yii\base\Exception;
use yii\helpers\Url;

use yii2mod\models\SeoModel;

/**
 * Class Seo
 * Set / show seo data
 * @author  Kravchuk Dmitry
 * @package yii2mod\seo\components
 */
class Seo
{
    private static $_instance = null;

    /**
     * object yii2mod\seo\components\SeoPageInterface
     * @var null
     */
    private $seoPage = null;


    /**
     * Create $this->seoPage by current url
     * @author Kravchuk Dmitry
     * @throws Exception
     */
    private function __construct()
    {
        // find seo model by url
        $url = Url::current();
         $seoModel = SeoModel::find()->byUrl($url)->active()->one();
        if (!empty($seoModel)) {

            $config = [
                'class' => $seoModel->class,
                'metaTitle' => $seoModel->metaTitle,
                'metaKeyWords' => $seoModel->metaKeyWords,
                'metaDescription' => $seoModel->metaDescription,
                'pageContent' => $seoModel->pageContent
            ];

            $seoPage = Yii::createObject($config);

            if (!empty($seoPage)) {
                if(!is_subclass_of($seoPage, 'yii2mod\seo\components\SeoPageInterface')) {
                    throw new Exception('Error');
                }
                $this->seoPage = $seoPage;
            }
        }

    }

    static public function getInstance()
    {
        if(is_null(self::$_instance))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    protected function __clone() {}

    /**
     * @author Kravchuk Dmitry
     *
     * @return mixed
     */
    static public function getSeoPage()
    {
        $seoPage = self::getInstance()->seoPage;
        return empty($seoPage)? false : $seoPage;
    }

    /**
     * Set title in current view
     * @author Kravchuk Dmitry
     *
     * @param array $options
     *
     * @return mixed
     */
    static public function setTitle($options = [])
    {
        return false !== self::getSeoPage()? self::getInstance()->seoPage->setTitle($options) : false;
    }

    /**
     * @author Kravchuk Dmitry
     *
     * @return mixed
     */
    static public function getTitle()
    {
        return false !== self::getSeoPage()? self::getInstance()->seoPage->getMetaTitle() : false;
    }

    /**
     * Set meta tags into current view
     * @author Kravchuk Dmitry
     *
     * @param bool $keyWord is show meta keywords
     * @param bool $description is show meta description
     * @param array $options
     *
     * @return mixed
     */
    static public function metaTags($keyWord = true, $description = true, $options = [])
    {
        return false !== self::getSeoPage()? self::getInstance()->seoPage->setHeaderMetaTags($keyWord, $description, $options) : false;
    }

    /**
     * echo page content
     * @author Kravchuk Dmitry
     *
     * @param array $options
     */
    static public function setPageContentTag($options = [])
    {
        echo false !== self::getSeoPage()? self::getInstance()->seoPage->getPageContentTag($options) : false;
    }

    /**
     * @author Kravchuk Dmitry
     *
     * @param array $options
     *
     * @return mixed
     */
    static public function getPageContentTag($options = [])
    {
        return false !== self::getSeoPage()? self::getInstance()->seoPage->getPageContentTag($options) : false;
    }





}
