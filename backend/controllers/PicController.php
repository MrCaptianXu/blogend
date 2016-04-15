<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
// models
use common\models\Pic;

/**
 * Site controller
 */
class PicController extends Controller {

    public $enableCsrfValidation = false;
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
        $query = Pic::find()->joinWith('district')->joinWith('house')->joinWith('room');
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
    /**
     * 上传小区图片
     */
    public function actionDistrict() {
        $request = Yii::$app->request;
        $model = new Pic;
        if ($request->isPost) {
            if (!isset($_POST['Pic']['image_url']) || count($_POST['Pic']['image_url']) == 0) {
                Yii::$app->session->setFlash('error', '没有上传新图片..');
                return $this->refresh();
            }
            // 计数上传保存失败数量
            $saveflag = 0;
            $count = count($_POST['Pic']['image_url']);
            foreach ($_POST['Pic']['image_url'] as $key => $value) {
                $model = new Pic;
                $model->district_id = $request->post('Pic')['district_id'];
                $model->image_url = $value;
                if (!$model->save()) {
                    $saveflag++;
                }
            }
            if ($saveflag == 0) {
                Yii::$app->session->setFlash('success', '成功保存 '.$count.' 张图片');
            }else{
                Yii::$app->session->setFlash('success', $saveflag . ' 张图片保存失败');
            }
            return $this->refresh();
        } else {
            return $this->render('district', [
                        'model' => $model,
            ]);
        }
    }
    /**
     * 上传房子图片
     */
    public function actionHouse() {
        $request = Yii::$app->request;
        $model = new Pic;
        if ($request->isPost) {
            if (!isset($_POST['Pic']['image_url']) || count($_POST['Pic']['image_url']) == 0) {
                Yii::$app->session->setFlash('error', '没有上传新图片..');
                return $this->refresh();
            }
            // 计数上传保存失败数量
            $saveflag = 0;
            $count = count($_POST['Pic']['image_url']);
            foreach ($_POST['Pic']['image_url'] as $key => $value) {
                $model = new Pic;
                $model->district_id = $request->post('Pic')['district_id'];
                $model->house_id = $request->post('Pic')['house_id'];
                $model->image_url = $value;
                if (!$model->save()) {
                    $saveflag++;
                }
            }
            if ($saveflag == 0) {
                Yii::$app->session->setFlash('success', '成功保存 '.$count.' 张图片');
            }else{
                Yii::$app->session->setFlash('success', $saveflag . ' 张图片保存失败');
            }
            return $this->refresh();
        } else {
            return $this->render('house', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * 上传房间图片
     */
    public function actionRoom() {
        $request = Yii::$app->request;
        $model = new Pic;
        if ($request->isPost) {
            if (!isset($_POST['Pic']['image_url']) || count($_POST['Pic']['image_url']) == 0) {
                Yii::$app->session->setFlash('error', '没有上传新图片..');
                return $this->refresh();
            }
            // 计数上传保存失败数量
            $saveflag = 0;
            $count = count($_POST['Pic']['image_url']);
            foreach ($_POST['Pic']['image_url'] as $key => $value) {
                $model = new Pic;
                $model->district_id = $request->post('Pic')['district_id'];
                $model->house_id = $request->post('Pic')['house_id'];
                $model->room_id = $request->post('Pic')['room_id'];
                $model->image_url = $value;
                if (!$model->save()) {
                    $saveflag++;
                }
            }
            if ($saveflag == 0) {
                Yii::$app->session->setFlash('success', '成功保存 '.$count.' 张图片');
            }else{
                Yii::$app->session->setFlash('success', $saveflag . ' 张图片保存失败');
            }
            return $this->refresh();
        } else {
            return $this->render('room', [
                        'model' => $model,
            ]);
        }
    }

    // 根据小区 id 获取 房子列表
    public function actionHouselist() {
        $request = Yii::$app->request;
        $id = $request->post('id', -1);
        $model = \common\models\House::find()->asArray()->select(['id', 'district_id', 'house_number', 'floor'])->where(['district_id' => $id])->all();
        $option = '';
        if (count($model) > 0) {
            foreach ($model as $key => $val) {
                $option .= "<option value= '{$val['id']}'>{$val['floor']}栋 {$val['house_number']}</option>";
            }
        }
        echo $option;
        exit;
    }

    // 根据房子 id 获取房间列表
    public function actionRoomlist() {
        $request = Yii::$app->request;
        $id = $request->post('id', -1);
        $model = \common\models\Room::find()->asArray()->select(['id', 'district_id', 'house_id', 'name'])->where(['house_id' => $id])->all();
        if (count($model) > 0) {
            $option = '';
            foreach ($model as $key => $val) {
                $option .= "<option value= '{$val['id']}'>{$val['name']}</option>";
            }
        }
        echo $option;
        exit;
    }

    public function actionUpload() {
        $publicFolder = 'public/image';

        $targetFolder = dirname(Yii::$app->basePath) . '/' . $publicFolder;
        if (!is_dir($targetFolder)) {
            mkdir($targetFolder, 0777, true);
        }
        $verifyToken = md5('unique_salt' . $_POST['timestamp']);
        if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $targetFolder;
            $ext = pathinfo($_FILES['Filedata']['name'], PATHINFO_EXTENSION);
            $fileName = Yii::$app->controller->action->id . '_' . md5(uniqid()) . '.' . $ext;
            $targetFile = rtrim($targetFolder, '/') . '/' . $fileName;

            // Validate the file type
            $fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);
            if (in_array($fileParts['extension'], $fileTypes)) {
                move_uploaded_file($tempFile, $targetFile);
                $result = array();
                $result['path'] = rtrim($publicFolder, '/') . '/' . $fileName;
                $result['name'] = $fileName;
                exit(json_encode($result));
            } else {
                echo 'Invalid file type.';
            }
        }
    }

    public function save() {
        $model = new Pic;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', '保存成功');
                return $this->refresh();
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


    public function actionDelete() {
        $request = Yii::$app->request;
        $id = intval($request->get('id'));
        $result = Pic::deleteAll("id = $id");
        if ($result) {
            Yii::$app->session->setFlash('success', '删除成功');
        } else {
            Yii::$app->session->setFlash('error', '删除失败');
        }
        return $this->redirect(['pic/index']);
    }

}
