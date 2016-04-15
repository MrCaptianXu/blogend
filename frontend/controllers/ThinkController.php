<?php

namespace frontend\controllers;

use Yii;
use yii\web\Request;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Html;
//model
use common\models\Think;
use yii\data\Pagination;

/**
 * Site controller
 */
class ThinkController extends Controller {

    public function actionIndex() {

        $request = Yii::$app->request;
        $get = intval($request->get('id'));
        $model = Think::find()->where(['id' => $get])->one();
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
                $relate_models = Think::find()->where($condition)->limit(5)->all();
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
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout() {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

}
