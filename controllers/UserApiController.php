<?php

namespace app\controllers;

use app\models\Users;
use Yii;
use yii\web\ForbiddenHttpException;
use yii\web\ServerErrorHttpException;

class UserApiController extends BaseController
{
    public $modelClass = Users::class;

    public function checkAccess($action, $model = null, $params = [])
    {
        if ($action === 'update' || $action === 'delete') {
            if ($model->id != Yii::$app->user->id) {
                throw new ForbiddenHttpException(sprintf('You can only %s articles that you have created', $action));
            }
        }
    }

    public function actions()
    {
        $actions = parent::actions();
//        unset($actions['create']);
        unset($actions['update']);
        return $actions;
    }
//
//    public function actionCreate(){
//        $model = new $this->modelClass();
//
//        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
//        if ($model->save()){
//            return $model;
//        }else{
//            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
//        }
//    }
//
    public function actionUpdate($id){
        $model = Users::find()->where(['id'=> Yii::$app->user->id])->one();

        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->save()){
            return $model;
        }else{
            return $model->errors;
//            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }
    }
}