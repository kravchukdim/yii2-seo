<?php
/**
 * Created by PhpStorm.
 * User: kravchuk
 * Date: 12.02.15
 * Time: 13:08
 */

namespace kravchukdim\yii2seo\models\query;

use yii\db\ActiveQuery;

use kravchukdim\yii2seo\models\SeoModel;
use kravchukdim\yii2seo\models\enumerable\SeoStatus;

/**
 * Class SeoQuery
 * @author Kravchuk Dmitry
 * @package kravchukdim\yii2seo\models\query
 */
class SeoQuery extends ActiveQuery
{
    /**
     * Find by status active and order
     * @author Kravchuk Dmitry
     */
    public function active()
    {
        $this->byStatus([SeoStatus::ENABLED, SeoStatus::CHANGED, SeoStatus::NEW_SEO]);
        return $this;
    }

    /**
     * Find by status
     * @author Kravchuk Dmitry
     *
     * @param $status
     * @return $this
     */
    public function byStatus($status)
    {
        $tableColumn = SeoModel::tableName() . '.status';

        $this->andWhere(['in', $tableColumn, (array) $status]);

        return $this;
    }

    /**
     * Find bu name
     * @author Kravchuk Dmitry
     *
     * @param string $name
     *
     * @return $this
     */
    public function byName($name)
    {
        $tableColumn = SeoModel::tableName() . '.name';
        $aliasColumn = ':' . SeoModel::tableName() . 'Name';

        $this->andWhere($tableColumn . ' = ' . $aliasColumn, [$aliasColumn => $name]);

        return $this;
    }

    /**
     * Find by url
     * @author Kravchuk Dmitry
     *
     * @param string $url
     *
     * @return $this
     */
    public function byUrl($url)
    {
        $tableColumn = SeoModel::tableName() . '.url';
        $aliasColumn = ':' . SeoModel::tableName() . 'Url';

        $this->andWhere($tableColumn . ' = ' . $aliasColumn, [$aliasColumn => $url]);

        return $this;
    }

    /**
     * @author Kravchuk Dmitry
     *
     * @return $this
     */
    public function order()
    {
        $this->orderBy('name');

        return $this;
    }
} 