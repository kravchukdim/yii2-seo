<?php
/**
 * Created by PhpStorm.
 * User: kravchuk
 * Date: 12.02.15
 * Time: 13:08
 */

namespace kravchukdim\seo\models\query;

use yii\db\ActiveQuery;

use kravchukdim\seo\models\SeoModel;
use kravchukdim\seo\models\enumerable\SeoStatus;

/**
 * Class SeoQuery
 * @author Kravchuk Dmitry
 * @package kravchukdim\seo\models\query
 */
class SeoQuery extends ActiveQuery
{
    /**
     * Find by status active and order
     * @author Kravchuk Dmitry
     */
    public function active($tableAlias = null)
    {
        $this->byStatus([SeoStatus::ENABLED, SeoStatus::CHANGED, SeoStatus::NEW_SEO], $tableAlias);
        return $this;
    }

    /**
     * Find by status
     * @author Kravchuk Dmitry
     *
     * @param $status
     * @return $this
     */
    public function byStatus($status, $tableAlias = null)
    {
        if (empty($tableAlias)) {
            $tableAlias = SeoModel::tableName();
        }
        $tableColumn = $tableAlias . '.status';

        $this->andWhere(['in', $tableColumn, (array)$status]);

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
     * Find by UrlRule use table alias
     * @author Kravchuk Dmitry
     *
     * @param string $urlRule
     * @param string $tableAlias
     *
     * @return $this
     */
    public function byUrlRuleWithTableAlias($urlRule, $tableAlias)
    {
        $tableColumn = $tableAlias . '.urlRule';
        $aliasColumn = ':' . $tableAlias . 'UrlRule';

        $this->from(SeoModel::tableName() . ' ' . $tableAlias)
        ->andWhere($tableColumn . ' = ' . $aliasColumn, [$aliasColumn => $urlRule])
        ->active($tableAlias);

        return $this;
    }

    /**
     * Find by urlRule
     * @author Kravchuk Dmitry
     *
     * @param string $urlRule
     *
     * @return $this
     */
    public function byUrlRule($urlRule)
    {
        $tableColumn = SeoModel::tableName() . '.urlRule';
        $aliasColumn = ':' . SeoModel::tableName() . 'UrlRule';

        $this->andWhere($tableColumn . ' = ' . $aliasColumn, [$aliasColumn => $urlRule]);

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