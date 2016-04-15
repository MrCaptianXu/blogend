<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%article}}".
 *
 * @property string $aid
 * @property integer $cateId
 * @property integer $authorId
 * @property string $title
 * @property string $keywords
 * @property string $summary
 * @property string $content
 * @property string $tag
 * @property integer $created_at
 * @property integer $updated_at
 */
class Article extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%article}}';
    }

    public function behaviors() {
        return [TimestampBehavior::className()];
    }

    /**
     * 数据表关联
     */
    public function getDemo() {
        /**
         * 第一个参数为要关联的子表模型类名称，
         * 第二个参数指定 通过子表的 customer_id 去关联主表的 id 字段
         */
        return $this->hasOne(District::className(), ['id' => 'district_id'])->select(['id', 'district', 'address', 'desc']);
    }



    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['cateId', 'authorId', 'created_at', 'updated_at'], 'integer', 'message' => '必填需是整数'],
            [['content'], 'string'],
            [['content', 'cateId', 'title', 'tag'], 'required', 'message' => '必填项'],
            [['title', 'keywords', 'summary'], 'string', 'max' => 255],
            [['tag'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'aid' => 'ID',
            'cateId' => '文章分类',
            'authorId' => '发布者',
            'title' => '标题',
            'keywords' => '关键字',
            'summary' => '摘要',
            'content' => '内容',
            'tag' => '标签',
            'created_at' => '创建时间',
            'updated_at' => '编辑时间',
        ];
    }

}
