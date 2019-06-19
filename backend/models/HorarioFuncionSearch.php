<?php

namespace backend\models;

use common\models\HorarioFuncion;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * HorarioFuncionSearch represents the model behind the search form of `common\models\HorarioFuncion`.
 */
class HorarioFuncionSearch extends HorarioFuncion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sala_id', 'cine_id', 'pelicula_id', 'publicar'], 'integer'],
            [['hora', 'fecha', 'created_at', 'updated_at'], 'safe'],
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
        $query = HorarioFuncion::find()->andWhere('fecha >= cast(NOW() AS DATE)');

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
            'sala_id' => $this->sala_id,
            'cine_id' => $this->cine_id,
            'pelicula_id' => $this->pelicula_id,
            'hora' => $this->hora,
            'fecha' => $this->fecha,
            'publicar' => $this->publicar,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
