<?php

namespace kravchukdim\seo\components;

use Yii;
use yii\base\Exception;
use yii\helpers\Url;

use kravchukdim\seo\models\SeoModel;

/**
 * Class Seo
 * Set / show seo data
 * @author  Kravchuk Dmitry
 * @package kravchukdim\seo\components
 */
class Seo
{
    private static $_instance = null;

    /**
     * object kravchukdim\seo\components\SeoPageInterface
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
        $actionId = Yii::$app->controller->action->uniqueId;

        $i = 1;
        $seoModelQuery = SeoModel::find()->select('*')->byUrl($url)->active();
        $seoModelQuery->union(SeoModel::find()->byUrlRuleWithTableAlias('/' . trim($actionId, '/'), 'rule' . $i), true);
        $actionIdArray = explode('/', $actionId);
        if (is_array($actionIdArray)) {
            do {
                ++$i;
                array_pop($actionIdArray);
                $urlRule = empty($actionIdArray)? '/*' : '/' . implode('/', $actionIdArray) . '/*';
                $unionQuery = SeoModel::find()->byUrlRuleWithTableAlias($urlRule, 'rule' . $i);
                $seoModelQuery->union($unionQuery, true);
            } while(!empty($actionIdArray));
        }
        $seoModel = $seoModelQuery->one();
        if (!empty($seoModel)) {
            $category = $seoModel->category;
            $config = [
                'class' => $seoModel->seoPageClass,
                'metaTitle'       => (!empty($category) && empty($seoModel->metaTitle))?       $category->metaTitle       : $seoModel->metaTitle,
                'metaKeyWords'    => (!empty($category) && empty($seoModel->metaKeywords))?    $category->metaKeywords    : $seoModel->metaKeywords,
                'metaDescription' => (!empty($category) && empty($seoModel->metaDescription))? $category->metaDescription : $seoModel->metaDescription,
                'pageContent'     => (!empty($category) && empty($seoModel->pageContent))?     $category->pageContent     : $seoModel->pageContent
            ];

            $seoPage = Yii::createObject($config);

            if (!empty($seoPage)) {
                if(!is_subclass_of($seoPage, 'kravchukdim\seo\components\SeoPageInterface')) {
                    throw new Exception('Error, invalid seo page class');
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
    static public function getTitle($options = [])
    {
        return false !== self::getSeoPage()? self::getInstance()->seoPage->getMetaTitle($options) : false;
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
    static public function setMetaTags($keyWord = true, $description = true, $options = [])
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
