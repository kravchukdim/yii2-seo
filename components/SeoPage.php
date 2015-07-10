<?php

namespace kravchukdim\yii2seo\components;

use Yii;

use yii\base\Object;


/**
 * Class SeoPage
 * @author Kravchuk Dmitry
 * @package kravchukdim\yii2seo\components
 */
class SeoPage extends Object implements SeoPageInterface
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
     * use shortCode '{content}'
     * @var string
     */
    public $templatePageContent = '<div>{content}</div>';

    /**
     * Get current view
     * @author Kravchuk Dmitry
     *
     * @return mixed
     */
    protected function getView()
    {
        return Yii::$app->controller->view;
    }

    /**
     * Set title into current view
     * @author Kravchuk Dmitry
     *
     * @param array $options
     *
     * @return string
     */
    public function setTitle($options = [])
    {
        $view = $this->getView();
        $view->title = $this->getMetaTitle($options);
        return $view->title;
    }

    /**
     * Function for set header meta tags
     * @author Kravchuk Dmitry
     *
     * @param bool $isSetKeywords
     * @param bool $isSetDescription
     * @param array $options
     */
    public function setHeaderMetaTags($isSetKeywords = true, $isSetDescription = true, $options = [])
    {
        if (false !== $isSetKeywords) {
            $this->setKeywordsMeta($options);
        }
        if (false !== $isSetDescription) {
            $this->setDescriptionMeta($options);
        }
    }

    /**
     * Function for set Keywords  meta tag
     * @author Kravchuk Dmitry
     *
     * @param array $options
     */
    public function setKeywordsMeta($options = [])
    {
        $keywords = $this->getMetaKeyWords($options);
        if (!empty($keywords)) {
            $view = $this->getView();
            $view->registerMetaTag(['name' => 'keywords', 'content' => $keywords]);
        }
    }

    /**
     * Function for set Description  meta tag
     * @author Kravchuk Dmitry
     *
     * @param array $options
     */
    public function setDescriptionMeta($options = [])
    {
        $meteDescription = $this->getMetaDescription($options);
        if (!empty($meteDescription)) {
            $view = $this->getView();
            $view->registerMetaTag(['name' => 'description', 'content' => $meteDescription]);
        }
    }

    /**
     * Getter for PageContentTag
     * return "PageContent" in template
     * @author Kravchuk Dmitry
     *
     * @param array $options
     *
     * @return mixed
     */
    public function getPageContentTag($options = [])
    {
        return !empty($this->templatePageContent) ? str_replace('{content}', $this->getPageContent($options), $this->templatePageContent) : $this->getPageContent($options);
    }

    /**
     * Getter for PageContent string
     * @author Kravchuk Dmitry
     *
     * @param array $options
     *
     * @return string
     */
    public function getPageContent($options = [])
    {
        return $this->replaceShortTags($this->pageContent, $options, __FUNCTION__);
    }

    /**
     * Getter for MetaTitle string
     * @author Kravchuk Dmitry
     *
     * @param array $options
     *
     * @return string
     */
    public function getMetaTitle($options = [])
    {
        return $this->replaceShortTags($this->metaTitle, $options, __FUNCTION__);
    }

    /**
     * Getter for MetaKeywords string
     * @author Kravchuk Dmitry
     *
     * @param array$options
     *
     * @return string
     */
    public function getMetaKeywords($options = [])
    {
        return $this->replaceShortTags($this->metaKeyWords, $options, __FUNCTION__);
    }

    /**
     * Getter for MetaDescription string
     * @author Kravchuk Dmitry
     *
     * @param array$options
     *
     * @return string
     */
    public function getMetaDescription($options = [])
    {
        return $this->replaceShortTags($this->metaDescription, $options, __FUNCTION__);
    }


    /**
     * Function for replace shortCodes
     * @author Kravchuk Dmitry
     *
     * @param array $string
     *  "Test text {name1} and {name2}"
     * @param array $options
     *  [
     *  'shortCodes' => [
     *          '{name}' => 'App',
     *          '{name1}'=> 'View page'
     *      ]
     * ]
     *
     * @param string $functionName
     *
     * @return mixed
     */
    public function replaceShortTags($string, $options, $functionName = null)
    {
        $shortCodes = isset($options['shortCodes'])? $options['shortCodes'] : [];
        // set default '{appName}'
        if (!isset($shortCodes['{appName}'])) {
            $shortCodes['{appName}'] = Yii::$app->name;
        }

        $string = str_replace(array_keys($shortCodes), array_values($shortCodes), $string);
        return $string;
    }

}