<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\RiskMed;
use yii\data\SqlDataProvider;

/**
 * RiskMedSearch represents the model behind the search form about `frontend\models\RiskMed`.
 */
class RiskMedSearch extends RiskMed
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'person_id', 'location_riks_id', 'location_report_id', 'location_connection_id', 'type_med_id', 'sub_med_type_id', 'level_id', 'clear_id', 'system_id', 'status_id', 'type_clinic_id'], 'integer'],
            [['hn', 'pname', 'fname', 'lname', 'risk_date', 'risk_report', 'risk_summary', 'risk_review', 'join_status', 'docs', 'ref'], 'safe'],
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
        $query = RiskMed::find()->orderBy(['id' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,],
                /* 'sort' => [
                  'defaultOrder' => [
                  'risk_summary' => SORT_DESC,
                  'risk_summary' => SORT_ASC,
                  ]
                  ], */
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'person_id' => $this->person_id,
            'location_riks_id' => $this->location_riks_id,
            'location_report_id' => $this->location_report_id,
            'location_connection_id' => $this->location_connection_id,
            'risk_date' => $this->risk_date,
            'risk_report' => $this->risk_report,
            'type_med_id' => $this->type_med_id,
            'sub_med_type_id' => $this->sub_med_type_id,
            'level_id' => $this->level_id,
            'clear_id' => $this->clear_id,
            'system_id' => $this->system_id,
            'status_id' => $this->status_id,
            'type_clinic_id' => $this->type_clinic_id,
        ]);

        $query->andFilterWhere(['like', 'hn', $this->hn])
            ->andFilterWhere(['like', 'pname', $this->pname])
            ->andFilterWhere(['like', 'fname', $this->fname])
            ->andFilterWhere(['like', 'lname', $this->lname])
            ->andFilterWhere(['like', 'risk_summary', $this->risk_summary])
            ->andFilterWhere(['like', 'risk_review', $this->risk_review])
            ->andFilterWhere(['like', 'join_status', $this->join_status])
            ->andFilterWhere(['like', 'docs', $this->docs])
            ->andFilterWhere(['like', 'ref', $this->ref]);

        return $dataProvider;
    }
}
