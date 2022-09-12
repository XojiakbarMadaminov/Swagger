<?php

namespace app\controllers;

use app\models\LoginForm;
use yii\rest\Controller;

class LoginController extends Controller
{
    // Login qilish
    public function actionLogin(){

        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post(),'') && ($token = $model->loginApi())){
            return ['token' => $token];
        }else{
            return $model;
        }
    }
}