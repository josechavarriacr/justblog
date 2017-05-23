<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Logs;

class LogsSearch extends Logs
{
    public function rules()
    {
        return [
        [['id', 'time'], 'integer'],
        [['ip', 'module', 'referrer', 'language', 'method', 'browser', 'os', 'device', 'type', 'csrfToken', 'port', 'user_agent'], 'safe'],
        [['new'], 'boolean'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Logs::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'new' => $this->new,
            'time' => $this->time,
            ]);

        $query->andFilterWhere(['like', 'ip', $this->ip])
        ->andFilterWhere(['like', 'module', $this->module])
        ->andFilterWhere(['like', 'referrer', $this->referrer])
        ->andFilterWhere(['like', 'language', $this->language])
        ->andFilterWhere(['like', 'method', $this->method])
        ->andFilterWhere(['like', 'browser', $this->browser])
        ->andFilterWhere(['like', 'os', $this->os])
        ->andFilterWhere(['like', 'device', $this->device])
        ->andFilterWhere(['like', 'type', $this->type])
        ->andFilterWhere(['like', 'csrfToken', $this->csrfToken])
        ->andFilterWhere(['like', 'port', $this->port])
        ->andFilterWhere(['like', 'user_agent', $this->user_agent]);

        return $dataProvider;
    }
}
