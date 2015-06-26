<?php

namespace yii2mod\seo\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii2mod\seo\models\SeoCategoryModel;

/**
 * Class SeoCategorySearch
 * SeoCategorySearch represents the model behind the search form about `app\components\seo\models\SeoCategoryModel`.
 * @author Kravchuk Dmitry
 * @package yii2mod\seo\models\search
 */
class SeoCategorySearch extends SeoCategoryModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'position', 'createdAt', 'updatedAt'], 'integer'],
            [['name', 'comment'], 'safe'],
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
        $query = SeoCategoryModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'position' => $this->position,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
