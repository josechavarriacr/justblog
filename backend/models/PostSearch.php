<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Post;

class PostSearch extends Post
{

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['titulo', 'url', 'descripcion', 'text','tags'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Post::find()->where(['type'=>'post'])->orderBy(['created_at'=>SORT_DESC])->orderBy(['status'=>SORT_DESC]);       

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

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
