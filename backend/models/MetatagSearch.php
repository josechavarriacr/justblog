<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Metatag;

class MetatagSearch extends Metatag
{

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'url', 'description', 'keywords', 'category', 'icon', 'image'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Metatag::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'icon', $this->icon])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
