<?php
namespace yii2mod\seo\models\enumerable;


use yii2mod\enum\helpers\BaseEnum;


/**
 * Class SeoStatus
 * @author  Kravchuk Dmitry
 * @package yii2mod\seo\models\enumerable
 */
class SeoStatus extends BaseEnum
{
    const DISABLED = 0;
    const ENABLED = 1;
    const CHANGED = 2;
    const NEW_SEO = 3;


    public static $list = [
        self::ENABLED => 'Active',
        self::DISABLED => 'Inactive',
        self::CHANGED => 'Changed',
        self::NEW_SEO => 'New',
    ];

    public static  $editList = [
        self::ENABLED => 'Active',
        self::DISABLED => 'Inactive',
    ];
}