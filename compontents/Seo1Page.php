<?php

namespace yii2mod\seo\components;

use Yii;
use yii\base\Oject;


/**
 * Created by PhpStorm.
 * User: kravchuk
 * Date: 18.06.15
 * Time: 9:18
 */
class Seo1Page extends SeoPage
{

    public $templatePageContent = '<div class="seo-description11">{content}</div>';


    public function setHeaderMetaTags($keyWord = null, $description = null, $options = [])
    {
        parent::setHeaderMetaTags(true, true);
    }

}