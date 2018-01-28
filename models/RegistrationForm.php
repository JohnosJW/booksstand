<?php

namespace app\models;

use Yii;
use dektrium\user\models\RegistrationForm as BaseRegistrationForm;
use dektrium\user\models\User as BaseUser;

class RegistrationForm extends BaseRegistrationForm
{
    /**
     * Overriding models ( method : register() )
     *
     * @return bool
     */
    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        /** @var BaseUser $user */
        $user = Yii::createObject(BaseUser::className());
        $user->setScenario('register');
        $this->loadAttributes($user);

        if (!$user->register()) {
            return false;
        }

        $auth = Yii::$app->authManager;
        $authorRole = $auth->getRole('user');
        $auth->assign($authorRole, $user->id);

        Yii::$app->session->setFlash(
            'info',
            Yii::t(
                'user',
                'Your account has been created and a message with further instructions has been sent to your email'
            )
        );

        return true;
    }
}