<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;

class GeneralController extends Controller
{
public function behaviors()
{
    return [
        'access' => [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'controllers' => ['site'],
                    'actions' => ['index', 'login', 'register',"about","viewcampo",'search'],
                    'roles' => ['?'], // Guest (not logged in) can access these actions
                ],
                [
                    'allow' => true,
                    'controllers' => ['site','comments','replies','likes'],
                    'roles' => ['@'], // Authenticated user can access all actions of the 'site' controller
                ],
[
    'allow' => true,
    'controllers' => ['*'], // All controllers
    'matchCallback' => function ($rule, $action) {
        $user = Yii::$app->user->identity;
        return $user !== null && $user->isAdmin;
    },
],


            ],
        ],
        'verbs' => [
            'class' => VerbFilter::class,
            'actions' => [
                'logout' => ['post'],
            ],
        ],
    ];
}

}