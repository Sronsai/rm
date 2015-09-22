<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Risk;

/**
 * RiskSearch represents the model behind the search form about `frontend\models\Risk`.
 */
class RiskSearch extends Risk {

    /**
     * @inheritdoc
     */
    public $globalSearch;

    public function rules() {
        return [
            [['id', 'person_id', 'clear_id', 'system_id',], 'integer'],
            [['hn', 'globalSearch', 'location_riks_id', 'location_connection_id', 'location_report_id', 'type_id', 'sub_type_id', 'level_id', 'status_id', 'pname', 'fname', 'lname', 'risk_date', 'risk_report', 'risk_summary', 'risk_review', 'type_clinic_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {

        $query = Risk::find()
                ->orderBy([
            'id' => SORT_DESC,
        ]);

        if (Yii::$app->user->identity->location_id) {
            $query->byLocationId();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // เงื่อนไขช่อง filter การทบทวน (status_id)
        $query->andFilterWhere([
            'id' => $this->id,
            'status_id' => $this->status_id,
        ]);


        //$query->andWhere('status_name' . $this->status);

        $query->joinWith('locationRiks');
        $query->joinWith('locationConnection');
        $query->joinWith('locationReport');
        $query->joinWith('type');
        $query->joinWith('typeClinic');
        $query->joinWith('subType');
        $query->joinWith('level');
        $query->joinWith('status');

        $query->andFilterWhere([
            'id' => $this->id,
            'person_id' => $this->person_id,
            'location_riks_id' => $this->location_riks_id,
            'location_report_id' => $this->location_report_id,
            'location_connection_id' => $this->location_connection_id,
            'risk_date' => $this->risk_date,
            'risk_report' => $this->risk_report,
            'type_id' => $this->type_id,
            'sub_type_id' => $this->sub_type_id,
            'level_id' => $this->level_id,
            'clear_id' => $this->clear_id,
            'system_id' => $this->system_id,
            'status_id' => $this->status_id,
        ]);

        $query->orFilterWhere(['like', 'hn', $this->globalSearch])
                ->orFilterWhere(['like', 'pname', $this->globalSearch])
                ->orFilterWhere(['like', 'fname', $this->globalSearch])
                ->orFilterWhere(['like', 'lname', $this->globalSearch])
                ->orFilterWhere(['like', 'risk_summary', $this->globalSearch])
                ->orFilterWhere(['like', 'risk_review', $this->globalSearch])
                ->orFilterWhere(['like', 'location_riks.location_name', $this->globalSearch])
                ->orFilterWhere(['like', 'location_connection.location_name', $this->globalSearch])
                ->orFilterWhere(['like', 'location_report.location_name', $this->globalSearch])
                ->orFilterWhere(['like', 'type.type_name', $this->globalSearch])
                ->orFilterWhere(['like', 'typeClinic.clinic_name', $this->globalSearch])
                ->orFilterWhere(['like', 'sub_type.sub_type_name', $this->globalSearch])
                ->orFilterWhere(['like', 'level.level_name', $this->globalSearch])
                ->orFilterWhere(['like', 'status.status_name', $this->globalSearch]);

        
        // search แบบกรอกข้อมความในช่อง
        /*$query->andFilterWhere(['like', 'hn', $this->hn])
                ->andFilterWhere(['like', 'pname', $this->pname])
                ->andFilterWhere(['like', 'fname', $this->fname])
                ->andFilterWhere(['like', 'lname', $this->lname])
                ->andFilterWhere(['like', 'risk_summary', $this->risk_summary])
                ->andFilterWhere(['like', 'location_riks.location_name', $this->location_riks_id])
                ->andFilterWhere(['like', 'location_connection.location_name', $this->location_connection_id])
                ->andFilterWhere(['like', 'location_report.location_name', $this->location_report_id])
                ->andFilterWhere(['like', 'type.type_name', $this->type_id])
                ->andFilterWhere(['like', 'typeClinic.clinic_name', $this->type_clinic_id])
                ->andFilterWhere(['like', 'sub_type.sub_type_name', $this->sub_type_id])
                ->andFilterWhere(['like', 'level.level_name', $this->level_id])
                ->andFilterWhere(['like', 'status.status_name', $this->status_id])
        ;*/


        return $dataProvider;
    }

}
