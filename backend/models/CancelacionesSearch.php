<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cancelaciones;

/**
 * CancelacionesSearch represents the model behind the search form of `app\models\Cancelaciones`.
 */
class CancelacionesSearch extends Cancelaciones
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['fechaCancelacion', 'nombreUsuario', 'pelicula', 'funcionFecha', 'funcionHora', 'sala', 'asiento', 'codigoBoleto', 'motivo'], 'safe'],
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
        $query = Cancelaciones::find();

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
            'fechaCancelacion' => $this->fechaCancelacion,
        ]);

        $query->andFilterWhere(['like', 'nombreUsuario', $this->nombreUsuario])
            ->andFilterWhere(['like', 'pelicula', $this->pelicula])
            ->andFilterWhere(['like', 'funcionFecha', $this->funcionFecha])
            ->andFilterWhere(['like', 'funcionHora', $this->funcionHora])
            ->andFilterWhere(['like', 'sala', $this->sala])
            ->andFilterWhere(['like', 'asiento', $this->asiento])
            ->andFilterWhere(['like', 'codigoBoleto', $this->codigoBoleto])
            ->andFilterWhere(['like', 'motivo', $this->motivo]);

        return $dataProvider;
    }
}