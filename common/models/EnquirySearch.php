<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Enquiry;

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
            [['id', 'date_of_enquiry', 'country_id', 'program_id', 'invoice_raised_l1', 'l1_batch', 'l1_status', 'invoice_raised_l2', 'l2_batch', 'l2_status', 'invoice_raised_l3', 'l3_batch', 'l3_status', 'amount', 'currency_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['full_name', 'contact_no', 'email', 'address', 'owner', 'city', 'source', 'subject', 'referred_by', 'final_status_l1', 'final_status_l2', 'final_status_l3'], 'safe'],
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
    public function search($params)
    {
        $query = Enquiry::find();

        // add conditions that should always apply here

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
            'date_of_enquiry' => $this->date_of_enquiry,
            'country_id' => $this->country_id,
            'program_id' => $this->program_id,
            'invoice_raised_l1' => $this->invoice_raised_l1,
            'l1_batch' => $this->l1_batch,
            'l1_status' => $this->l1_status,
            'invoice_raised_l2' => $this->invoice_raised_l2,
            'l2_batch' => $this->l2_batch,
            'l2_status' => $this->l2_status,
            'invoice_raised_l3' => $this->invoice_raised_l3,
            'l3_batch' => $this->l3_batch,
            'l3_status' => $this->l3_status,
            'amount' => $this->amount,
            'currency_id' => $this->currency_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'contact_no', $this->contact_no])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'owner', $this->owner])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'referred_by', $this->referred_by])
            ->andFilterWhere(['like', 'final_status_l1', $this->final_status_l1])
            ->andFilterWhere(['like', 'final_status_l2', $this->final_status_l2])
            ->andFilterWhere(['like', 'final_status_l3', $this->final_status_l3]);

        return $dataProvider;
    }
}
