<?php

namespace yii2mod\seo\components;

use Yii;
use yii\base\Oject;


/**
 * Class SeoBasicPage
 * @author Kravchuk Dmitry
 * @package yii2mod\seo\components
 */
class SeoBasicPage extends SeoPage
{

    /**
     * template for page content
     * @var string
     */
    public $templatePageContent = '<div class="seo-description">{content}</div>';


    /**
     * Function for set meta tags
     * @author Kravchuk Dmitry
     * @param boolean $keyWord
     * @param boolean $description
     * @param array $options
     */
    public function setHeaderMetaTags($keyWord = true, $description = true, $options = [])
    {
        parent::setHeaderMetaTags(true, true);
    }

}