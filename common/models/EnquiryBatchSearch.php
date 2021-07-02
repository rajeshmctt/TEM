<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\EnquiryBatch;

/**
 * EnquiryBatchSearch represents the model behind the search form of `common\models\EnquiryBatch`.
 */
class EnquiryBatchSearch extends EnquiryBatch
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'enquiry_id', 'program_id', 'batch_id', 'start_date', 'created_at', 'updated_at', 'currency', 'amount', 'invoicing', 'status'], 'integer'],
            [['name', 'final_status', 'installment_plan'], 'safe'],
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
    public function search($params,$en_id)
    {
        $query = EnquiryBatch::find()->where(['enquiry_id'=>$en_id]);

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
            'enquiry_id' => $this->enquiry_id,
            'program_id' => $this->program_id,
            'batch_id' => $this->batch_id,
            'start_date' => $this->start_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'currency' => $this->currency,
            'amount' => $this->amount,
            'invoicing' => $this->invoicing,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'final_status', $this->final_status])
            ->andFilterWhere(['like', 'installment_plan', $this->installment_plan]);

        return $dataProvider;
    }
}
