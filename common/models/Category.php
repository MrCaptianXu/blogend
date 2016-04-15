<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "cp_category".
 *
 * @property string $cid
 * @property integer $fid
 * @property integer $sort
 * @property string $cateName
 * @property string $created_at
 * @property string $updated_at
 */
class Category extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'cp_category';
    }

    public function behaviors() {
        return [TimestampBehavior::className()];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['fid', 'sort'], 'integer', 'message' => '必须为整数'],
            [['sort', 'cateName'], 'required', 'message' => '此字段不可为空'],
            [['cateName'], 'string', 'max' => 255],
            [['created_at', 'updated_at'], 'string', 'max' => 11]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'cid' => '主键',
            'fid' => '父类id',
            'sort' => '排序',
            'cateName' => '分类名',
            'created_at' => '创建时间',
            'updated_at' => '编辑时间',
        ];
    }

    // 键值对数组
    static public function cateName() {
        $model = Category::find()->all();
        $data = array();
        foreach ($model as $key => $cate) {
            $data[$cate->cid] = $cate->cateName;
        }
        return $data;
    }

}
