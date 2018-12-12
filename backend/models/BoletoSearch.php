<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Boleto;

/**
 * BoletoSearch represents the model behind the search form of `common\models\Boleto`.
 */
class BoletoSearch extends Boleto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'face_user_id', 'horario_funcion_id', 'sala_asientos_id', 'reclamado'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
        $query = Boleto::find();

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
            'face_user_id' => $this->face_user_id,
            'horario_funcion_id' => $this->horario_funcion_id,
            'sala_asientos_id' => $this->sala_asientos_id,
            'reclamado' => $this->reclamado,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
