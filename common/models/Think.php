<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%think}}".
 *
 * @property integer $id
 * @property integer $cateId
 * @property string $title
 * @property string $tag
 * @property string $seo_keywords
 * @property string $seo_desc
 * @property string $content
 * @property integer $created_at
 * @property integer $updated_at
 */
class Think extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%think}}';
    }

    public function behaviors() {
        return [TimestampBehavior::className()];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'cateId', 'created_at', 'updated_at'], 'integer'],
            [['title', 'tag', 'content'], 'required', 'message' => '必填项'],
            [['title', 'tag', 'seo_keywords', 'seo_desc'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cateId' => '分类',
            'title' => '标题',
            'tag' => '标签',
            'seo_keywords' => 'SEO关键字',
            'seo_desc' => 'SEO描述',
            'content' => '内容',
            'created_at' => '添加时间',
            'updated_at' => '编辑时间',
        ];
    }
}
