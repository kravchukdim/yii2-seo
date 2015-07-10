<?php

namespace kravchukdim\seo\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use kravchukdim\seo\models\SeoModel;


/**
 * Class SeoSearch
 * SeoSearch represents the model behind the search form about `app\components\seo\models\SeoModel`.
 * @author Kravchuk Dmitry
 *
 * @package kravchukdim\seo\models\search
 */
class SeoSearch extends SeoModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'categoryId', 'createdAt', 'updatedAt'], 'integer'],
            [['url', 'name', 'comment', 'pageContent', 'metaTitle', 'metaDescription', 'metaKeywords', 'seoPageClass', 'urlRule'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = SeoModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'categoryId' => $this->categoryId,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'urlRule', $this->urlRule])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'pageContent', $this->pageContent])
            ->andFilterWhere(['like', 'metaTitle', $this->metaTitle])
            ->andFilterWhere(['like', 'metaDescription', $this->metaDescription])
            ->andFilterWhere(['like', 'metaKeywords', $this->metaKeywords])
            ->andFilterWhere(['like', 'seoPageClass', $this->seoPageClass]);


        return $dataProvider;
    }
}
