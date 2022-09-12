<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\filters\RateLimiter;
use yii\rest\ActiveController;
use OpenApi\Attributes as OA;
use yii\web\Response;


class BaseController extends ActiveController
{
    public function behaviors()
    {
        return array_merge([
            [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            [
                'class' => RateLimiter::class,
                'enableRateLimitHeaders' => true
            ],
            [
                'class' => HttpBearerAuth::class,
            ],
            [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@', '?'],
                    ],
                ],
            ],
            [
                'class' => Cors::class,
                'cors' => YII_ENV_DEV ? [
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => ['GET'],
                    'Access-Control-Request-Headers' => ['*'],
                    'Access-Control-Allow-Credentials' => null,
                    'Access-Control-Max-Age' => 86400,
                    'Access-Control-Expose-Headers' => []
                ] : []
            ],
        ]);
    }

}