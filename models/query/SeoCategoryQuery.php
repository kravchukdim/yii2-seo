<?php
/**
 * Created by PhpStorm.
 * User: kravchuk
 * Date: 12.02.15
 * Time: 13:08
 */

namespace kravchukdim\seo\models\query;

use yii\db\ActiveQuery;

use kravchukdim\seo\models\SeoCategoryModel;
use kravchukdim\seo\models\enumerable\SeoCategoryStatus;

/**
 * Class SeoCategoryQuery
 * @author Kravchuk Dmitry
 * @package kravchukdim\seo\models\query
 */
class SeoCategoryQuery extends ActiveQuery
{
    /**
     * Find by status active and order
     * @author Kravchuk Dmitry
     */
    public function active()
    {
        $this->byStatus(SeoCategoryStatus::ENABLED);
        $this->order();
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
        $tableColumn = SeoCategoryModel::tableName() . '.status';

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
        $tableColumn = SeoCategoryModel::tableName() . '.name';
        $aliasColumn = ':' . SeoCategoryModel::tableName() . 'Name';

        $this->andWhere($tableColumn . ' = ' . $aliasColumn, [$aliasColumn => $name]);

        return $this;
    }

    /**
     * @author Kravchuk Dmitry
     *
     * @return $this
     */
    public function order()
    {
        $this->orderBy('position, name');

        return $this;
    }
} 