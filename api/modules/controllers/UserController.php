<?php
namespace api\modules\controllers;

use api\controllers\BaseAuthController;
use api\models\BoletoRest;
use api\models\UserRest;
use common\models\Boleto;
use Yii;

class UserController extends BaseAuthController
{
    public $modelClass = 'common\models\FaceUser';

    public function actions()
    {
        return [
            // 'view' => [
            //     'class' => 'yii\rest\ViewAction',
            //     'modelClass' => $this->modelClass,
            //     'checkAccess' => [$this, 'checkAccess'],
            // ],
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        // check if the user can access $action and $model
        // throw ForbiddenHttpException if access should be denied

        if ($action === 'update' || $action === 'delete') {
            if ($model->face_user_id !== Yii::$app->user->id) {
                throw new \yii\web\ForbiddenHttpException(sprintf('Esta información es privada. %s', $action));
            }
        }
    }

    public function actionBoletos()
    {
        $boletos = BoletoRest::find()
            ->with(['horarioFuncion', 'salaAsientos'])
            ->joinWith(['horarioFuncion AS hf', 'salaAsientos AS sa'], true, 'INNER JOIN')
            ->where(['boleto.face_user_id' => Yii::$app->user->id])
            ->orderBy(['boleto.reclamado' => SORT_ASC, 'hf.fecha' => SORT_DESC, 'hf.hora' => SORT_DESC])
            ->all();
        return $boletos;
    }

    public function actionView()
    {

        return UserRest::getUser();
    }

    public function actionBoleto($id)
    {
        $boleto = BoletoRest::find()->where(['id' => $id, 'face_user_id' => Yii::$app->user->id])->one();
        if (is_null($boleto)) {
            throw new \yii\web\NotFoundHttpException('boleto no existente o ya usado');
        }

        return $boleto;
    }

    public function actionQr($id)
    {
        $boleto = Boleto::find()->where(['id' => $id, 'face_user_id' => Yii::$app->user->id])->one();
        if (is_null($boleto)) {
            throw new \yii\web\NotFoundHttpException('boleto no existente o ya usado');
        }
        $storagePath = Yii::getAlias('@QRs/' . $boleto->face_user_id);

        // check filename for allowed chars (do not allow ../ to avoid security issue: downloading arbitrary files)
        if (!is_file($storagePath . $boleto->qr_phat)) {
            throw new \yii\web\NotFoundHttpException('La imagen no existe.');
        }
        return Yii::$app->response->sendFile($storagePath . $boleto->qr_phat);
    }
}
