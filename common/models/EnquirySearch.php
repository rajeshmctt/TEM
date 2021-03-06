<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Enquiry;
// use backend\models\enums\EnquiryStatusTypes;

/**
 * EnquirySearch represents the model behind the search form of `common\models\Enquiry`.
 */
class EnquirySearch extends Enquiry
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'owner_id', 'info_email_sent_on', 'country_id', 'countries_id', 'program_id',  'amount', 'currency_id','close_reason', 'enq_status', 'status', 'created_at', 'updated_at'], 'integer'],
            [['full_name', 'date_of_enquiry', 'contact_no', 'email', 'address', 'owner', 'city', 'source', 'subject', 'referred_by', 'remarks','programs'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
    public function search($status, $params)
    {
        $query = Enquiry::find()->where(['enquiry.status'=>$status])->orderBy(['id' => SORT_DESC]);

        // add conditions that should always apply here
        $query->joinWith(['enquiryBatches']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            // 'date_of_enquiry' => date("Y-m-d", strtotime($this->date_of_enquiry)),
            'owner_id' => $this->owner_id, 
            'info_email_sent_on' => $this->info_email_sent_on, 
            'country_id' => $this->country_id,
            'countries_id' => $this->countries_id,
            'enquiry.program_id' => $this->program_id,
            'amount' => $this->amount,
            'currency_id' => $this->currency_id,
            'close_reason' => $this->close_reason,
            'enq_status' => $this->enq_status,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        if($this->date_of_enquiry!=''){
            $query->andFilterWhere(['like', 'date_of_enquiry', date("Y-m-d", strtotime($this->date_of_enquiry))]);
        }
        /*if($this->date_of_enquiry!=''){
            // echo 2; //exit;
            $mdt = floor(strtotime(urldecode($this->date_of_enquiry))/100000);
            // $query->andFilterWhere(['like', 'date_of_enquiry', strtotime(urldecode($this->date_of_enquiry))/100000]);
                // ->andFilterWhere(['<', 'date_of_enquiry', strtotime(urldecode($this->date_of_enquiry))-86400]);
        }else{
            // echo 1; 
        }*/
        // echo $this->date_of_enquiry; exit;
        $query->andFilterWhere(['like', 'full_name', $this->full_name])
            // ->andFilterWhere(['>=', 'date_of_enquiry', strtotime($this->date_of_enquiry)])
            // ->andFilterWhere(['<', 'date_of_enquiry', strtotime($this->date_of_enquiry)-86400])
            // ->andFilterWhere(['like', 'date_of_enquiry', floor(strtotime(urldecode($this->date_of_enquiry))/100000)])  // date(strtotime
            // ->andFilterWhere(['like', 'date_of_enquiry', date("Y-m-d", strtotime($this->date_of_enquiry))])
            ->andFilterWhere(['like', 'contact_no', $this->contact_no])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'owner', $this->owner])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'referred_by', $this->referred_by])
            ->andFilterWhere(['like', 'enquiry_batch.program_id', $this->programs]);

        return $dataProvider;
    }
}
