<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pelicula;

/**
 * PeliculaSearch represents the model behind the search form of `common\models\Pelicula`.
 */
class PeliculaSearch extends Pelicula
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'director_id'], 'integer'],
            [['nombre', 'genero', 'clasificacion', 'idioma', 'duracion', 'sinopsis', 'cartelUrl', 'trailerUrl', 'trailerImg', 'created_at', 'updated_at'], 'safe'],
            [['calificacion'], 'number'],
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
        $query = Pelicula::find();

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
            'director_id' => $this->director_id,
            'calificacion' => $this->calificacion,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'genero', $this->genero])
            ->andFilterWhere(['like', 'clasificacion', $this->clasificacion])
            ->andFilterWhere(['like', 'idioma', $this->idioma])
            ->andFilterWhere(['like', 'duracion', $this->duracion])
            ->andFilterWhere(['like', 'sinopsis', $this->sinopsis])
            ->andFilterWhere(['like', 'cartelUrl', $this->cartelUrl])
            ->andFilterWhere(['like', 'trailerUrl', $this->trailerUrl])
            ->andFilterWhere(['like', 'trailerImg', $this->trailerImg]);

        return $dataProvider;
    }
}
