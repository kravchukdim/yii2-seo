<?php

namespace kravchukdim\yii2seo\models;

use Yii;

use kravchukdim\yii2seo\models\query\SeoQuery;

/**
 * Class SeoModel
 * This is the model class for table "Seo".
 * @author Kravchuk Dmitry
 * @package kravchukdim\yii2seo\models
 *
 * @property integer $id
 * @property string $url
 * @property string $name
 * @property string $comment
 * @property string $pageContent
 * @property string $metaTitle
 * @property string $metaDescription
 * @property string $metaKeywords
 * @property integer $status
 * @property integer $categoryId
 * @property string $seoPageClass
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 * @property SeoCategory $category
 */
class SeoModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Seo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment', 'pageContent', 'metaTitle', 'metaDescription', 'metaKeywords'], 'string'],
            ['seoPageClass', 'default', 'value' => 'app\components\seo\Seo1Page'],
            [['status', 'categoryId', 'createdAt', 'updatedAt'], 'integer'],
            [['url', 'name','seoPageClass', 'categoryId', 'status'], 'required'],
            [['url', 'name', 'seoPageClass'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
            'name' => Yii::t('app', 'Name'),
            'comment' => Yii::t('app', 'Comment'),
            'pageContent' => Yii::t('app', 'Page Content'),
            'metaTitle' => Yii::t('app', 'Meta Title'),
            'metaDescription' => Yii::t('app', 'Meta Description'),
            'metaKeywords' => Yii::t('app', 'Meta Keywords'),
            'status' => Yii::t('app', 'Status'),
            'categoryId' => Yii::t('app', 'Category ID'),
            'seoPageClass' => Yii::t('app', 'Seo Page Class'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return RegionQuery
     */
    public static function find()
    {
        return new SeoQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(SeoCategoryModel::className(), ['id' => 'categoryId']);
    }
}
