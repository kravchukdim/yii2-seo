<?php
namespace yii2mod\seo\models\enumerable;


use yii2mod\enum\helpers\BaseEnum;


/**
 * @author  Kravchuk Dmitry
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