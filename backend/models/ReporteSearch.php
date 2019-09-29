<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Reporte;

/**
 * ReporteSearch represents the model behind the search form of `common\models\Reporte`.
 */
class ReporteSearch extends Reporte
{
    public $fechaInicio = null;
    public $fechaFin = null;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[], 'required'],
            [[
                'boleto_id',
                'horario_funcion_id',
                'sala_id',
                'cine_id',
                'precio_id',
                'pago_id',
                'empleado_id',
                'cliente_id',
                'pelicula_id',
                'distribuidora_id',
                'reclamado',
                'reimpreso',
            ], 'integer'],
            [[
                'boleto_creado',
                'boleto_actualizado',
                'qr_phat',
                'hash',
                'hora',
                'fecha',
                'publicar',
                'horario_creado',
                'horario_actualizado',
                'nombre',
                'codigo',
                'precio_creado',
                'precio_actualizado',
                'precio',
                'create_time',
                'id_pago_externo',
                'intent',
                'state',
                'pago_creado',
                'pago_actualizado',
                'tipo_pago',
                'username',
                'empleado_status',
                'empleado_creado',
                'empleado_actualizado',
                'cliente_status',
                'cliente_creado',
                'cliente_actualizado',
                'nombre_pelicula',
                'genero',
                'clasificacion',
                'idioma',
                'duracion',
                'nombre_distribuidor',
                'fechaInicio',
                'fechaFin',
            ], 'safe'],
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
     * {@inheritdoc}
     */
    public function noPagination()
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
        $query = Reporte::find()->select('SUM(precio) AS total, nombre_pelicula, idioma, nombre_distribuidor, fecha, sala_id, hora, precio, nombre, COUNT(boleto_id) AS conteo')->groupBy(['pelicula_id', 'nombre', 'fecha', 'hora']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(
            [
                'boleto_id' => $this->boleto_id,
                'reclamado' => $this->reclamado,
                'reimpreso' => $this->reimpreso,
                'boleto_creado' => $this->boleto_creado,
                'boleto_actualizado' => $this->boleto_actualizado,
                'qr_phat' => $this->qr_phat,
                'hash' => $this->hash,
                'horario_funcion_id' => $this->horario_funcion_id,
                'sala_id' => $this->sala_id,
                'cine_id' => $this->cine_id,
                'hora' => $this->hora,
                'fecha' => $this->fecha,
                'publicar' => $this->publicar,
                'horario_creado' => $this->horario_creado,
                'horario_actualizado' => $this->horario_actualizado,
                'precio_id' => $this->precio_id,
                'nombre' => $this->nombre,
                'codigo' => $this->codigo,
                'precio_creado' => $this->precio_creado,
                'precio_actualizado' => $this->precio_actualizado,
                'precio' => $this->precio,
                'pago_id' => $this->pago_id,
                'create_time' => $this->create_time,
                'id_pago_externo' => $this->id_pago_externo,
                'intent' => $this->intent,
                'state' => $this->state,
                'pago_creado' => $this->pago_creado,
                'pago_actualizado' => $this->pago_actualizado,
                'tipo_pago' => $this->tipo_pago,
                'empleado_id' => $this->empleado_id,
                'empleado_status' => $this->empleado_status,
                'empleado_creado' => $this->empleado_creado,
                'empleado_actualizado' => $this->empleado_actualizado,
                'cliente_id' => $this->cliente_id,
                'cliente_status' => $this->cliente_status,
                'cliente_creado' => $this->cliente_creado,
                'cliente_actualizado' => $this->cliente_actualizado,
                'pelicula_id' => $this->pelicula_id,
                'genero' => $this->genero,
                'clasificacion' => $this->clasificacion,
                'idioma' => $this->idioma,
                'duracion' => $this->duracion,
                'distribuidora_id' => $this->distribuidora_id,
            ]
        );

        $query->andFilterWhere(['>=', 'fecha', $this->fechaInicio])
            ->andFilterWhere(['<=', 'fecha', $this->fechaFin]);

        $query->andFilterWhere(
            ['like', 'username', $this->username]
        )
            ->andFilterWhere(['like', 'nombre_distribuidor', $this->nombre_distribuidor])
            ->andFilterWhere(['like', 'nombre_pelicula', $this->nombre_pelicula]);

        return $dataProvider;
    }

    public function searchuFuncion($params)
    {
        $query = Reporte::find()->select('nombre_pelicula, idioma, nombre_distribuidor, fecha, sala_id, hora, precio, nombre, COUNT(boleto_id) AS conteo')->groupBy(['pelicula_id', 'nombre', 'fecha', 'hora']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(
            [
                'boleto_id' => $this->boleto_id,
                'reclamado' => $this->reclamado,
                'reimpreso' => $this->reimpreso,
                'boleto_creado' => $this->boleto_creado,
                'boleto_actualizado' => $this->boleto_actualizado,
                'qr_phat' => $this->qr_phat,
                'hash' => $this->hash,
                'horario_funcion_id' => $this->horario_funcion_id,
                'sala_id' => $this->sala_id,
                'cine_id' => $this->cine_id,
                'hora' => $this->hora,
                'fecha' => $this->fecha,
                'publicar' => $this->publicar,
                'horario_creado' => $this->horario_creado,
                'horario_actualizado' => $this->horario_actualizado,
                'precio_id' => $this->precio_id,
                'nombre' => $this->nombre,
                'codigo' => $this->codigo,
                'precio_creado' => $this->precio_creado,
                'precio_actualizado' => $this->precio_actualizado,
                'precio' => $this->precio,
                'pago_id' => $this->pago_id,
                'create_time' => $this->create_time,
                'id_pago_externo' => $this->id_pago_externo,
                'intent' => $this->intent,
                'state' => $this->state,
                'pago_creado' => $this->pago_creado,
                'pago_actualizado' => $this->pago_actualizado,
                'tipo_pago' => $this->tipo_pago,
                'empleado_id' => $this->empleado_id,
                'empleado_status' => $this->empleado_status,
                'empleado_creado' => $this->empleado_creado,
                'empleado_actualizado' => $this->empleado_actualizado,
                'cliente_id' => $this->cliente_id,
                'cliente_status' => $this->cliente_status,
                'cliente_creado' => $this->cliente_creado,
                'cliente_actualizado' => $this->cliente_actualizado,
                'pelicula_id' => $this->pelicula_id,
                'genero' => $this->genero,
                'clasificacion' => $this->clasificacion,
                'idioma' => $this->idioma,
                'duracion' => $this->duracion,
                'distribuidora_id' => $this->distribuidora_id,
            ]
        );
        $query->andFilterWhere(['>=', 'fecha', $this->fechaInicio])
            ->andFilterWhere(['<=', 'fecha', $this->fechaFin]);

        $query->andFilterWhere(
            ['like', 'username', $this->username]
        )
            ->andFilterWhere(['like', 'nombre_distribuidor', $this->nombre_distribuidor])
            ->andFilterWhere(['like', 'nombre_pelicula', $this->nombre_pelicula]);

        return $dataProvider;
    }

    public function searchPelicula($params)
    {
        $query = Reporte::find()->select('SUM(precio) AS total, nombre_pelicula, idioma, nombre_distribuidor, fecha, hora, precio, nombre, COUNT(boleto_id) AS conteo')->groupBy(['pelicula_id', 'nombre', 'fecha', 'hora']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(
            [
                'boleto_id' => $this->boleto_id,
                'reclamado' => $this->reclamado,
                'reimpreso' => $this->reimpreso,
                'boleto_creado' => $this->boleto_creado,
                'boleto_actualizado' => $this->boleto_actualizado,
                'qr_phat' => $this->qr_phat,
                'hash' => $this->hash,
                'horario_funcion_id' => $this->horario_funcion_id,
                'sala_id' => $this->sala_id,
                'cine_id' => $this->cine_id,
                'hora' => $this->hora,
                'fecha' => $this->fecha,
                'publicar' => $this->publicar,
                'horario_creado' => $this->horario_creado,
                'horario_actualizado' => $this->horario_actualizado,
                'precio_id' => $this->precio_id,
                'nombre' => $this->nombre,
                'codigo' => $this->codigo,
                'precio_creado' => $this->precio_creado,
                'precio_actualizado' => $this->precio_actualizado,
                'precio' => $this->precio,
                'pago_id' => $this->pago_id,
                'create_time' => $this->create_time,
                'id_pago_externo' => $this->id_pago_externo,
                'intent' => $this->intent,
                'state' => $this->state,
                'pago_creado' => $this->pago_creado,
                'pago_actualizado' => $this->pago_actualizado,
                'tipo_pago' => $this->tipo_pago,
                'empleado_id' => $this->empleado_id,
                'empleado_status' => $this->empleado_status,
                'empleado_creado' => $this->empleado_creado,
                'empleado_actualizado' => $this->empleado_actualizado,
                'cliente_id' => $this->cliente_id,
                'cliente_status' => $this->cliente_status,
                'cliente_creado' => $this->cliente_creado,
                'cliente_actualizado' => $this->cliente_actualizado,
                'pelicula_id' => $this->pelicula_id,
                'genero' => $this->genero,
                'clasificacion' => $this->clasificacion,
                'idioma' => $this->idioma,
                'duracion' => $this->duracion,
                'distribuidora_id' => $this->distribuidora_id,
            ]
        );
        $query->andFilterWhere(['>=', 'fecha', $this->fechaInicio])
            ->andFilterWhere(['<=', 'fecha', $this->fechaFin]);

        $query->andFilterWhere(
            ['like', 'username', $this->username]
        )
            ->andFilterWhere(['like', 'nombre_distribuidor', $this->nombre_distribuidor])
            ->andFilterWhere(['like', 'nombre_pelicula', $this->nombre_pelicula]);
        return $dataProvider;
    }

    public function searchDistribuidor($params)
    {
        $query = Reporte::find()->select('SUM(precio) AS total, nombre_pelicula, idioma, nombre_distribuidor, fecha, sala_id, hora, precio, nombre, COUNT(boleto_id) AS conteo')->groupBy(['distribuidora_id']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(
            [
                'boleto_id' => $this->boleto_id,
                'reclamado' => $this->reclamado,
                'reimpreso' => $this->reimpreso,
                'boleto_creado' => $this->boleto_creado,
                'boleto_actualizado' => $this->boleto_actualizado,
                'qr_phat' => $this->qr_phat,
                'hash' => $this->hash,
                'horario_funcion_id' => $this->horario_funcion_id,
                'sala_id' => $this->sala_id,
                'cine_id' => $this->cine_id,
                'hora' => $this->hora,
                'fecha' => $this->fecha,
                'publicar' => $this->publicar,
                'horario_creado' => $this->horario_creado,
                'horario_actualizado' => $this->horario_actualizado,
                'precio_id' => $this->precio_id,
                'nombre' => $this->nombre,
                'codigo' => $this->codigo,
                'precio_creado' => $this->precio_creado,
                'precio_actualizado' => $this->precio_actualizado,
                'precio' => $this->precio,
                'pago_id' => $this->pago_id,
                'create_time' => $this->create_time,
                'id_pago_externo' => $this->id_pago_externo,
                'intent' => $this->intent,
                'state' => $this->state,
                'pago_creado' => $this->pago_creado,
                'pago_actualizado' => $this->pago_actualizado,
                'tipo_pago' => $this->tipo_pago,
                'empleado_id' => $this->empleado_id,
                'empleado_status' => $this->empleado_status,
                'empleado_creado' => $this->empleado_creado,
                'empleado_actualizado' => $this->empleado_actualizado,
                'cliente_id' => $this->cliente_id,
                'cliente_status' => $this->cliente_status,
                'cliente_creado' => $this->cliente_creado,
                'cliente_actualizado' => $this->cliente_actualizado,
                'pelicula_id' => $this->pelicula_id,
                'genero' => $this->genero,
                'clasificacion' => $this->clasificacion,
                'idioma' => $this->idioma,
                'duracion' => $this->duracion,
                'distribuidora_id' => $this->distribuidora_id,
            ]
        );
        $query->andFilterWhere(['>=', 'fecha', $this->fechaInicio])
            ->andFilterWhere(['<=', 'fecha', $this->fechaFin]);

        $query->andFilterWhere(
            ['like', 'username', $this->username]
        )
            ->andFilterWhere(['like', 'nombre_distribuidor', $this->nombre_distribuidor])
            ->andFilterWhere(['like', 'nombre_pelicula', $this->nombre_pelicula]);

        return $dataProvider;
    }
}
