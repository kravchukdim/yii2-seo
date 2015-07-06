<?php

namespace kravchukdim\yii2seo\components;

use Yii;

use yii\base\Object;


/**
 * Class SeoPage
 * @author Kravchuk Dmitry
 * @package kravchukdim\yii2seo\components
 */
abstract class SeoPage extends Object implements SeoPageInterface
{
    /**
     * @var string
     */
    public $metaTitle = '';

    /**
     * @var string
     */
    public $metaKeyWords = '';

    /**
     * @var string
     */
    public $metaDescription = '';

    /**
     * @var string
     */
    public $pageContent = '';

    /**
     * @var string
     */
    public $templatePageContent = '<div>{content}</div>';

    /**
     * Get current view
     * @return mixed
     */
    protected function getView()
    {
        return Yii::$app->controller->view;
    }

    /**
     * @param array $options
     * @return string
     */
    public function setTitle($options = [])
    {
        $view = $this->getView();
        $view->title = $this->metaTitle;
        return $view->title;
    }

    /**
     * @param bool $keyWord
     * @param bool $description
     * @param array $options
     */
    public function setHeaderMetaTags($keyWord = true, $description = true, $options = [])
    {
        if (false !== $keyWord) {
            $this->setKeyWordsMeta($options);
        }
        if (false !== $description) {
            $this->setDescriptionMeta($options);
        }
    }

    /**
     * @param array $options
     */
    public function setKeyWordsMeta($options = [])
    {
        if (!empty($this->metaKeywords)) {
            $view = $this->getView();
            $view->registerMetaTag(['name' => 'keywords1', 'content' => $this->metaKeywords]);
        }
    }

    /**
     * @param array $options
     */
    public function setDescriptionMeta($options = [])
    {
        if (!empty($this->metaDescription)) {
            $view = $this->getView();
            $view->registerMetaTag(['name' => 'description', 'content' => $this->metaDescription]);
        }
    }

    /**
     * @param array $options
     * @return mixed|string
     */
    public function getPageContentTag($options = [])
    {
        return !empty($this->templatePageContent) ? str_replace('{content}', $this->pageContent, $this->templatePageContent) : $this->pageContent;
    }

    /**
     * @return string
     */
    public function getPageContent()
    {
        return $this->pageContent;
    }

    /**
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * @return string
     */
    public function getMetaKeyWords()
    {
        return $this->metaKeyWords;
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

}