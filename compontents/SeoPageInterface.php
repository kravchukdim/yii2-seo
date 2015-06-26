<?php

namespace yii2mod\seo\components;

/**
 * Created by PhpStorm.
 * User: kravchuk
 * Date: 18.06.15
 * Time: 9:15
 */

interface SeoPageInterface
{
    public function setTitle($options = []);

    public function getMetaTitle();

    public function setHeaderMetaTags($keyWord = true, $description = true, $options = []);

    public function getPageContentTag($options = []);

}