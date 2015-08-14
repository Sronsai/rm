<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\StatusDescription;

/**
 * StatusDescriptionSearch represents the model behind the search form about `backend\models\StatusDescription`.
 */
class StatusDescriptionSearch extends StatusDescription
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status_active_id'], 'integer'],
            [['status', 'status_date', 'status_description', 'status_name'], 'safe'],
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
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = StatusDescription::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status_date' => $this->status_date,
            'status_active_id' => $this->status_active_id,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'status_description', $this->status_description])
            ->andFilterWhere(['like', 'status_name', $this->status_name]);

        return $dataProvider;
    }
}
