<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Funcion;

/**
 * FuncionSearch represents the model behind the search form of `common\models\Funcion`.
 */
class FuncionSearch extends Funcion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cine_id', 'pelicula_id', 'sala_id'], 'integer'],
            [['precio'], 'number'],
            [['recomendada', 'created_at', 'updated_at'], 'safe'],
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
        $query = Funcion::find();

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
            'cine_id' => $this->cine_id,
            'pelicula_id' => $this->pelicula_id,
            'sala_id' => $this->sala_id,
            'precio' => $this->precio,
            'recomendada' => $this->recomendada,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
