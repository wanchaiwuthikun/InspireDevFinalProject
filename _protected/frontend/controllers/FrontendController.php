<?php
namespace frontend\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;

/**
 * FrontendController extends Controller and implements the behaviors() method
 * where you can specify the access control ( AC filter + RBAC) for
 * your controllers and their actions.
 */
class FrontendController extends Controller
{
    /**
     * Returns a list of behaviors that this component should behave as.
     * Here we use RBAC in combination with AccessControl filter.
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'controllers' => ['article'],
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'admin', 'updateadmin', 'createadmin'],
                        'allow' => true,
                        'roles' => ['admin','editor']
                    ],
                    [
                        'controllers' => ['article'],
                        'actions' => ['create', 'update', 'deletemember','index'],
                        'allow' => true,
                        'roles' => ['member'],
                    ],
                    [
                        'controllers' => ['article'],
                        'actions' => ['index', 'view', 'update'],
                        'allow' => true
                    ],
                    [
                        'controllers' => ['article'],
                        'actions' => ['index', 'view', 'show', 'showdetail', 'update',],
                        'allow' => true
                    ],

                    [
                        'controllers' => ['forum-ask'],
                        'actions' => ['forum', 'view', 'create', 'update', 'delete', 'admin','index','view', 'showdetail', 'createans',
                        'createadmin', 'updateadmin'],
                        'allow' => true,
                        'roles' => ['admin','editor'],
                    ],
                    [
                        'controllers' => ['forum-ask'],
                        'actions' => ['create', 'update', 'admin', 'forum', 'show', 'showdetail', 'createans', 'editans', 'updatemember', 'delete', 'deleteans'],
                        'allow' => true,
                        'roles' => ['member'],
                    ],
                    [
                        'controllers' => ['forum-ask'],
                        'actions' => ['view', 'forum', 'show', 'showdetail'],
                        'allow' => true
                    ],
                    [
                        'controllers' => ['forum-ask'],
                        'actions' => ['view', 'show', 'showdetail'],
                        'allow' => true
                    ],
                    // ans
                    [
                        'controllers' => ['forum-ans'],
                        'actions' => ['checkans', 'updateans'],
                        'allow' => true,
                        'roles' => ['member'],
                    ],

                    [
                        'controllers' => ['forum-ans'],
                        'actions' => [],
                        'allow' => true
                    ],
                    [
                        'controllers' => ['search'],
                        'actions' => ['index',],
                        'allow' => true
                    ],
                    [
                        'controllers' => ['videos'],
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'admin', 'updateadmin', 'createadmin'],
                        'allow' => true,
                        'roles' => ['admin','editor']
                    ],
                    [
                        'controllers' => ['videos'],
                        'actions' => ['lesson', 'show', 'status', 'deletemember', 'create', 'update', ],
                        'allow' => true,
                        'roles' => ['member'],
                    ],
                    [
                        'controllers' => ['videos'],
                        'actions' => ['lesson', 'show'],
                        'allow' => true
                    ],
                    [
                        // other rules
                    ],

                ], // rules

            ], // access

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ], // verbs

        ]; // return

    } // behaviors

} // AppController
