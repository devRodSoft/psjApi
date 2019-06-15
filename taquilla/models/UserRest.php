<?php

namespace api\models;

class UserRest extends \common\models\FaceUser
{
    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return [
            'username',
            'first_name',
            'last_name',
            'email',
            'avatar',
            'status',
        ];
    }

    public static function getUser()
    {
        $user      = \Yii::$app->User->identity;
        $frontUser = new static();

        $frontUser->username   = $user->username;
        $frontUser->first_name = $user->first_name;
        $frontUser->last_name  = $user->last_name;
        $frontUser->email      = $user->email;
        $frontUser->avatar     = $user->avatar;
        $frontUser->status     = $user->status;
        return $frontUser;

    }
}
