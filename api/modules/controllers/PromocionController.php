<?php
namespace api\modules\controllers;

use api\controllers\BaseController;
use common\models\Promocion;

class PromocionController extends BaseController
{
    public $modelClass = 'common\models\Promocion';

    public function actions()
    {
        return [
            'index',
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $data = Promocion::find()->where('NOW() BETWEEN start_date AND end_date')->all();

        return $data;
    }

    public function actionView($id)
    {
        $data = Promocion::find()->where(['id' => $id])->where('NOW() BETWEEN start_date AND end_date')->one();
        if (is_null($data)) {
            throw new \yii\web\HttpException(404, 'Promoción no encontrada');
        }
        return $data;
    }
}
