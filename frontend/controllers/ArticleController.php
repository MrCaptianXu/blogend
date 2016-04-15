<?php

namespace frontend\controllers;

use common\models\Category;
use Yii;
use yii\web\Request;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Html;
//model
use common\models\Article;
use yii\data\Pagination;

/**
 * Site controller
 */
class ArticleController extends Controller {

    public function actionIndex() {
        $request = Yii::$app->request;
        $get = intval($request->get('id'));
        $model = Article::find()->where(['aid' => $get])->one();

        $relate_models = NULL;
        if ($model) {
            $tag = $model->tag;
            if ($tag != '') {
                $tagArr = explode('#', $tag);
                $condition = '';
                foreach ($tagArr as $key => $tag) {
                    $condition .= "or tag like '%{$tag}%' ";
                }
                $condition = ltrim($condition, 'or');
                $relate_models = Article::find()->where($condition)->limit(5)->all();
            }
        }
        return $this->render('index', [
                    'model' => $model,
                    'relateArticle' => $relate_models
        ]);
    }

    public function actionTag() {
        $request = Yii::$app->request;
        $get = Html::encode($request->get('tag'));
        $query = Article::find()->where(['like', 'tag', $get]);

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => '30']);
        $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        return $this->render('tag', [
                    'models' => $models,
                    'pages' => $pages,
        ]);
    }

    public function actionSearch() {
        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $keyword = $request->post('keyword');
            $query = Article::find()->where(['like', 'title', $keyword]);
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => '10']);
            $models = $query->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
            return $this->render('search', [
                        'models' => $models,
                        'pages' => $pages,
                        'keyword'=>$keyword
            ]);
        }else{
            return $this->goHome();
        }
    }

    /**
     * 根据分类名查询对应文章
     */
    public function actionCategory(){
        $request = Yii::$app->request;
        $cate = $request->get('cate','php');
        $query = Category::findOne(['cateName' => $cate]);
        $query = Article::find()->where(['=', 'cateId', $query->cid]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => '10']);
        $models = $query->orderBy(['updated_at' => SORT_DESC])
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('category', [
            'models' => $models,
            'pages' => $pages,
        ]);

    }

}
