<?php
namespace app\controllers\relatearticle;
use yii;
use yii\base\Action;
use common\models\Article;
use yii\helpers\Html;
class RelateAction extends Action
{
    public function run($params)
    {
        $get = $params;
//        $request = Yii::$app->request;
//        $get  = Html::encode($request->get('keyword'));
//        echo $get;
//        $models = Article::find()->where(['like','tag',$get])->limit(5)->all();
        return $this->controller->renderPartial('relatearticle',[
            'models'=>$get
        ]);
    }
}