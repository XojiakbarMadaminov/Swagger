<?php

namespace app\controllers;

use app\models\Posts;
use Yii;
use yii\db\ActiveRecord;
use yii\web\ForbiddenHttpException;
use yii\web\ServerErrorHttpException;

class PostApiController extends BaseController
{
    public $modelClass = Posts::class;

    //update va delete qilayotganda post shu userga tegishli ekanligini tekshiradi
    public function  checkAccess($action, $model = null, $params = [])
    {
        if ($action === 'update' || $action === 'delete') {
            if ($model->user_id != \Yii::$app->user->id) {
                throw new ForbiddenHttpException(sprintf('You can only %s articles that you have created', $action));
            }
        }
    }

//    public function actions()
//    {
//        $actions = parent::actions();
//        unset($actions['create']);
//        unset($actions['update']);
//        return $actions;
//    }


//
//
//    // post yaratish va post yaratilganda user_id ga o'zi user ning id saqlanadi
//    public function actionCreate(){
//        $model = new $this->modelClass();
//
//        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
//        $model->user_id = Yii::$app->user->id;
//        if ($model->save()){
//            return $model;
//        }else{
//            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
//        }
//    }
//
//    public function actionUpdate($id)
//    {
//        /* @var $model ActiveRecord */
//        $model = Posts::find()->where(['id' => $id])->one();
//
//
//        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
//        if ($model->save() === false && !$model->hasErrors()) {
//            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
//        }
//
//        return $model;
//    }

}