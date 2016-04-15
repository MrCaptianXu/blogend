<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use common\models\Category;

/**
 * Site controller
 */
class CategoryController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'add', 'delete', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex() {
        $query = Category::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 8,
            ],
        ]);
        return $this->render('index', [
                    'dataProvider' => $dataProvider
        ]);
    }

    public function actionAdd() {
        $request = Yii::$app->request;
        $model = new Category;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', '保存成功');
            } else {
                Yii::$app->session->setFlash('error', '保存异常');
            }

            return $this->refresh();
        } else {
            return $this->render('add', [
                        'model' => $model,
            ]);
        }
    }
    
    public function actionUpdate() {
        $request = Yii::$app->request;
        $id = intval($request->get('id'));
        $model = Category::find()->where('cid = :id', ['id'=>$id])->one();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', '更新成功');
                    return $this->redirect(['category/index']);
                } else {
                    Yii::$app->session->setFlash('error', '更新异常');
                }

                return $this->refresh();
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    public function actionDelete() {
        $request = Yii::$app->request;
        $id = intval($request->get('id'));
        $result = Category::deleteAll("cid = $id");
        if ($result) {
            Yii::$app->session->setFlash('success', '删除成功');
        } else {
            Yii::$app->session->setFlash('error', '删除失败');
        }
        return $this->redirect(['category/index']);
    }

}
