<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\SubMedType;

/**
 * SubMedTypeSearch represents the model behind the search form about `frontend\models\SubMedType`.
 */
class SubMedTypeSearch extends SubMedType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type_med_id'], 'integer'],
            [['sub_med_type_name'], 'safe'],
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
        $query = SubMedType::find();

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
            'type_med_id' => $this->type_med_id,
        ]);

        $query->andFilterWhere(['like', 'sub_med_type_name', $this->sub_med_type_name]);

        return $dataProvider;
    }
}
