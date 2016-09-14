<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Referout;

/**
 * ReferoutSearch represents the model behind the search form about `frontend\models\Referout`.
 */
class ReferoutSearch extends Referout {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['refer_no', 'status_id', 'refertype_id', 'refer_date', 'refer_time', 'station_id', 'location_id', 'cid', 'hn', 'pname', 'fname', 'lname', 'age', 'addrpart', 'moopart', 'tmbpart', 'amppart', 'chwpart', 'pttype_id', 'pttypeno', 'hospmain', 'hospsub', 'typept_id', 'strength_id', 'doctor_id', 'refer_hospcode', 'cause_referout_id', 'expire_date', 'loads_id', 'is_coordinate_doctor', 'is_coordinate_nurse', 'coordinate_id', 'image1', 'image2', 'image3', 'image4', 'image5', 'sex', 'is_coordinate_not', 'is_coordinate_no', 'is_dead_refer', 'is_dead_er', 'is_dead_ward', 'memo', 'memodiag', 'drugallergy', 'doctor_name', 'cc', 'refer_status','user_save', 'vn', 'conscious', 'e', 'v', 'm', 'evm_total', 'pupil_right', 'pupil_left', 't', 'p', 'r', 'bp', 'Send_spclty_id', 'load_time', 'spo2', 'clinicgroup', 'clinicsub', 'load_date', 'vst_date', 'station_name', 'father', 'mother', 'location_name', 'pttype_name', 'forward_flag', 'from_hospcode', 'save_date', 'save_time', 'warfarin_note', 'app_date', 'ett_no', 'ett_mark', 'sync_memo', 'refer_no_his', 'level_acute', 'cause_referout_etc', 'is_consult'], 'safe'],
            [['is_upload', 'is_download', 'is_receive'], 'integer'],
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
        //$query = Referout::find();
        $query = Referout::find()->orderBy(['refer_date' => SORT_DESC]);

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
            'refer_date' => $this->refer_date,
            'expire_date' => $this->expire_date,
            'is_upload' => $this->is_upload,
            'is_download' => $this->is_download,
            'is_receive' => $this->is_receive,
            'load_date' => $this->load_date,
            'vst_date' => $this->vst_date,
            'save_date' => $this->save_date,
            'app_date' => $this->app_date,
            'status_id' => $this->status_id,
            //'refer_status' => $this->refer_status,
        ]);

        $query->andFilterWhere(['like', 'refer_no', $this->refer_no])
                ->andFilterWhere(['like', 'refertype_id', $this->refertype_id])
                ->andFilterWhere(['like', 'refer_time', $this->refer_time])
                ->andFilterWhere(['like', 'station_id', $this->station_id])
                ->andFilterWhere(['like', 'location_id', $this->location_id])
                ->andFilterWhere(['like', 'cid', $this->cid])
                ->andFilterWhere(['like', 'hn', $this->hn])
                ->andFilterWhere(['like', 'pname', $this->pname])
                ->andFilterWhere(['like', 'fname', $this->fname])
                ->andFilterWhere(['like', 'lname', $this->lname])
                ->andFilterWhere(['like', 'age', $this->age])
                ->andFilterWhere(['like', 'addrpart', $this->addrpart])
                ->andFilterWhere(['like', 'moopart', $this->moopart])
                ->andFilterWhere(['like', 'tmbpart', $this->tmbpart])
                ->andFilterWhere(['like', 'amppart', $this->amppart])
                ->andFilterWhere(['like', 'chwpart', $this->chwpart])
                ->andFilterWhere(['like', 'pttype_id', $this->pttype_id])
                ->andFilterWhere(['like', 'pttypeno', $this->pttypeno])
                ->andFilterWhere(['like', 'hospmain', $this->hospmain])
                ->andFilterWhere(['like', 'hospsub', $this->hospsub])
                ->andFilterWhere(['like', 'typept_id', $this->typept_id])
                ->andFilterWhere(['like', 'strength_id', $this->strength_id])
                ->andFilterWhere(['like', 'doctor_id', $this->doctor_id])
                ->andFilterWhere(['like', 'refer_hospcode', $this->refer_hospcode])
                ->andFilterWhere(['like', 'cause_referout_id', $this->cause_referout_id])
                ->andFilterWhere(['like', 'loads_id', $this->loads_id])
                ->andFilterWhere(['like', 'is_coordinate_doctor', $this->is_coordinate_doctor])
                ->andFilterWhere(['like', 'is_coordinate_nurse', $this->is_coordinate_nurse])
                ->andFilterWhere(['like', 'coordinate_id', $this->coordinate_id])
                ->andFilterWhere(['like', 'image1', $this->image1])
                ->andFilterWhere(['like', 'image2', $this->image2])
                ->andFilterWhere(['like', 'image3', $this->image3])
                ->andFilterWhere(['like', 'image4', $this->image4])
                ->andFilterWhere(['like', 'image5', $this->image5])
                ->andFilterWhere(['like', 'sex', $this->sex])
                ->andFilterWhere(['like', 'is_coordinate_not', $this->is_coordinate_not])
                ->andFilterWhere(['like', 'is_coordinate_no', $this->is_coordinate_no])
                ->andFilterWhere(['like', 'is_dead_refer', $this->is_dead_refer])
                ->andFilterWhere(['like', 'is_dead_er', $this->is_dead_er])
                ->andFilterWhere(['like', 'is_dead_ward', $this->is_dead_ward])
                ->andFilterWhere(['like', 'memo', $this->memo])
                ->andFilterWhere(['like', 'memodiag', $this->memodiag])
                ->andFilterWhere(['like', 'drugallergy', $this->drugallergy])
                ->andFilterWhere(['like', 'doctor_name', $this->doctor_name])
                ->andFilterWhere(['like', 'cc', $this->cc])
                ->andFilterWhere(['like', 'user_save', $this->user_save])
                ->andFilterWhere(['like', 'vn', $this->vn])
                ->andFilterWhere(['like', 'conscious', $this->conscious])
                ->andFilterWhere(['like', 'e', $this->e])
                ->andFilterWhere(['like', 'v', $this->v])
                ->andFilterWhere(['like', 'm', $this->m])
                ->andFilterWhere(['like', 'evm_total', $this->evm_total])
                ->andFilterWhere(['like', 'pupil_right', $this->pupil_right])
                ->andFilterWhere(['like', 'pupil_left', $this->pupil_left])
                ->andFilterWhere(['like', 't', $this->t])
                ->andFilterWhere(['like', 'p', $this->p])
                ->andFilterWhere(['like', 'r', $this->r])
                ->andFilterWhere(['like', 'bp', $this->bp])
                ->andFilterWhere(['like', 'Send_spclty_id', $this->Send_spclty_id])
                ->andFilterWhere(['like', 'load_time', $this->load_time])
                ->andFilterWhere(['like', 'spo2', $this->spo2])
                ->andFilterWhere(['like', 'clinicgroup', $this->clinicgroup])
                ->andFilterWhere(['like', 'clinicsub', $this->clinicsub])
                ->andFilterWhere(['like', 'station_name', $this->station_name])
                ->andFilterWhere(['like', 'father', $this->father])
                ->andFilterWhere(['like', 'mother', $this->mother])
                ->andFilterWhere(['like', 'location_name', $this->location_name])
                ->andFilterWhere(['like', 'pttype_name', $this->pttype_name])
                ->andFilterWhere(['like', 'forward_flag', $this->forward_flag])
                ->andFilterWhere(['like', 'from_hospcode', $this->from_hospcode])
                ->andFilterWhere(['like', 'save_time', $this->save_time])
                ->andFilterWhere(['like', 'warfarin_note', $this->warfarin_note])
                ->andFilterWhere(['like', 'ett_no', $this->ett_no])
                ->andFilterWhere(['like', 'ett_mark', $this->ett_mark])
                ->andFilterWhere(['like', 'sync_memo', $this->sync_memo])
                ->andFilterWhere(['like', 'refer_no_his', $this->refer_no_his])
                ->andFilterWhere(['like', 'level_acute', $this->level_acute])
                ->andFilterWhere(['like', 'cause_referout_etc', $this->cause_referout_etc])
                ->andFilterWhere(['like', 'is_consult', $this->is_consult])
                ->andFilterWhere(['like', 'refer_status', $this->refer_status]);

        return $dataProvider;
    }

}
