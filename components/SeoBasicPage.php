<?php

namespace kravchukdim\seo\components;

use Yii;
use yii\base\Oject;


/**
 * Class SeoBasicPage
 * @author Kravchuk Dmitry
 *
 * @package kravchukdim\seo\components
 */
class SeoBasicPage extends SeoPage
{

    /**
     * template for page content
     * @var string
     */
    public $templatePageContent = '<div class="seo-description">{content}</div>';

}