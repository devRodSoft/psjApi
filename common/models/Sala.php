<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sala".
 *
 * @property int $id
 * @property int $cine_id
 * @property string $nombre
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Cine $cine
 * @property SalaAsientos[] $salaAsientos
 */
class Sala extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sala';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cine_id', 'nombre'], 'required'],
            [['cine_id'], 'integer'],
            [['nombre'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['cine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cine::className(), 'targetAttribute' => ['cine_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cine_id' => 'Cine ID',
            'nombre' => 'Nombre Sala',
            'created_at' => 'Creado',
            'updated_at' => 'Actualizado',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return [
            'id',
            'cine_id',
            'nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCine()
    {
        return $this->hasOne(Cine::className(), ['id' => 'cine_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalaAsientos()
    {
        return $this->hasMany(SalaAsientos::className(), ['sala_id' => 'id']);
    }

    public function getAsientosAsMtx($horarioID = null)
    {
        $salafilas = $this->getSalaAsientos()->orderBy(['orden_fila' => SORT_DESC, 'orden_columna' => SORT_ASC])->groupBy('orden_fila')->asArray()->all();
        if (is_null($horarioID)) {
            $salaAsientos = $this->getSalaAsientos()->orderBy(['orden_fila' => SORT_DESC, 'orden_columna' => SORT_ASC])->all();
        } else {
            $salaAsientos = $this->getSalaAsientos()
                ->orderBy(['orden_fila' => SORT_DESC, 'orden_columna' => SORT_ASC])
                ->alias('t')
                ->select(['t.*', 'ocupadoAsiento' => 'MAX(IF(b.id IS NULL, 0, 1))'])
                ->join('inner join', ['hf' => 'horario_funcion'], 'hf.sala_id = t.sala_id')
                ->join('left join', ['ba' => 'boleto_asiento'], 't.id = ba.sala_asiento_id')
                ->join('left join', ['b' => 'boleto'], 'ba.boleto_id = b.id AND hf.id = b.horario_funcion_id')
                ->where(['hf.id' => $horarioID])
                ->groupBy('t.id')
                ->all();
        }

        $filas = [];
        foreach ($salafilas as $fila) {
            $filas[] = ['fila' => $fila['fila'], 'orden_fila' => $fila['orden_fila'], 'asientos' => []];
        }

        foreach ($filas as &$fila) {
            $fila['asientos'] = array_values(
                array_filter(
                    $salaAsientos,
                    function ($f) use ($fila) {
                        return $f->orden_fila == $fila['orden_fila'];
                    }
                )
            );
        }
        return $filas;
    }

    /**
     * {@inheritdoc}
     * @return SalaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SalaQuery(get_called_class());
    }
}
