<?php
namespace kravchukdim\yii2seo\models\enumerable;


use yii2mod\enum\helpers\BaseEnum;

/**
 * Class SeoCategoryStatus
 * @author Kravchuk Dmitry
 * @package kravchukdim\yii2seo\models\enumerable
 */
class SeoCategoryStatus extends BaseEnum
{
    const ENABLED = 1;
    const DISABLED = 0;


    public static $list = [
        self::ENABLED => 'Active',
        self::DISABLED => 'Inactive',
    ];
}