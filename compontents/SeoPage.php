<?php

namespace yii2mod\seo\components;

use Yii;

use yii\base\Object;


/**
 * Created by PhpStorm.
 * User: kravchuk
 * Date: 18.06.15
 * Time: 9:18
 */
class SeoPage extends Object implements SeoPageInterface
{

    public $metaTitle = '';
    public $metaKeyWords = '';
    public $metaDescription = '';
    public $pageContent = '';

    public $templatePageContent = '<div class="seo-description">{content}</div>';


    protected function getView()
    {
        return Yii::$app->controller->view;
    }

    public function setTitle($options = [])
    {
        $view = $this->getView();
        $view->title = $this->metaTitle;
        return $view->title;
    }

    public function setHeaderMetaTags($keyWord = true, $description = true, $options = [])
    {
        if (false !== $keyWord) {
            $this->setKeyWordsMeta($options);
        }
        if (false !== $description) {
            $this->setDescriptionMeta($options);
        }
    }

    public function setKeyWordsMeta($options = [])
    {
        if (!empty($this->metaKeywords)) {
            $view = $this->getView();
            $view->registerMetaTag(['name' => 'keywords1', 'content' => $this->metaKeywords]);
        }
    }

    public function setDescriptionMeta($options = [])
    {
        if (!empty($this->metaDescription)) {
            $view = $this->getView();
            $view->registerMetaTag(['name' => 'description', 'content' => $this->metaDescription]);
        }
    }

    public function getPageContentTag($options = [])
    {
        return !empty($this->templatePageContent) ? str_replace('{content}', $this->pageContent, $this->templatePageContent) : $this->pageContent;
    }

    public function getPageContent()
    {
        return $this->pageContent;
    }

    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    public function getMetaKeyWords()
    {
        return $this->metaKeyWords;
    }

    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

}