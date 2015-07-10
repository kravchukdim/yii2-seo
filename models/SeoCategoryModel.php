<?php

namespace kravchukdim\seo\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use kravchukdim\seo\models\query\SeoCategoryQuery;

/**
 * Class SeoCategoryModel
 * This is the model class for table "SeoCategory".
 * @author Kravchuk Dmitry
 *
 * @package kravchukdim\seo\models
 *
 * @property integer $id
 * @property string $name
 * @property string $pageContent
 * @property string $metaTitle
 * @property string $metaDescription
 * @property string $metaKeywords
 * @property string $comment
 * @property integer $status
 * @property integer $position
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 * @property Seo[] $seo
 */
class SeoCategoryModel extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'SeoCategory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment', 'pageContent', 'metaTitle', 'metaDescription', 'metaKeywords'], 'string'],
            [['status', 'name'], 'required'],
            [['status', 'position', 'createdAt', 'updatedAt'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'pageContent' => Yii::t('app', 'Page Content'),
            'metaTitle' => Yii::t('app', 'Meta Title'),
            'metaDescription' => Yii::t('app', 'Meta Description'),
            'metaKeywords' => Yii::t('app', 'Meta Keywords'),
            'comment' => Yii::t('app', 'Comment'),
            'status' => Yii::t('app', 'Status'),
            'position' => Yii::t('app', 'Position'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Returns a list of behaviors that this component should behave as.
     *
     * Child classes may override this method to specify the behaviors they want to behave as.
     *
     * @return mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['createdAt', 'updatedAt'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updatedAt'],
                ],
            ]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeo()
    {
        return $this->hasMany(SeoModel::className(), ['categoryId' => 'id']);
    }

    /**
     * @return RegionQuery
     */
    public static function find()
    {
        return new SeoCategoryQuery(get_called_class());
    }
}
