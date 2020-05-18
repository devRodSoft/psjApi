<?php

namespace backend\models;

use common\models\Boleto;
use yii\base\Model;
use yii\data\ActiveDataProvider;

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
            [['id', 'face_user_id', 'horario_funcion_id', 'reclamado', 'user_id'], 'integer'],
            [['created_at', 'updated_at', 'hash', 'user_id'], 'safe'],
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


        //$query->joinWith(['user']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


       // Lets do the same with country now
       $dataProvider->sort->attributes['user'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC],
        ];
                
      
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'boleto.id' => $this->id,
            'face_user_id' => $this->face_user_id,
            'horario_funcion_id' => $this->horario_funcion_id,
            'reclamado' => $this->reclamado,
            'hash' => $this->hash,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
