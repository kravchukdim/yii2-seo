<?php

namespace kravchukdim\yii2seo\components;

/**
 * Interface SeoPageInterface
 * @author Kravchuk Dmitry
 * @package kravchukdim\yii2seo\components
 */
interface SeoPageInterface
{
    /**
     * Setter page title
     * @param array $options
     * @return mixed
     */
    public function setTitle($options = []);

    /**
     * Getter page title
     * @return mixed
     */
    public function getMetaTitle();

    /**
     * Setter meta tags
     * @param bool $keyWord
     * @param bool $description
     * @param array $options
     */
    public function setHeaderMetaTags($keyWord = true, $description = true, $options = []);

    /**
     * Getter page content
     * @param array $options
     * @return mixed
     */
    public function getPageContentTag($options = []);

}