<?php
namespace api\modules\controllers;

use api\controllers\BaseController;
use api\models\Promocion;

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
        $data = Promocion::find()->where('start_date > NOW()')->all();

        return $data;
    }

    public function actionView($id)
    {
        $data = Promocion::find()->where(['id' => $id])->where('start_date > NOW()')->one();
        if (is_null($data)) {
            throw new \yii\web\HttpException(404, 'Promoción no encontrada');
        }
        return $data;
    }
}
