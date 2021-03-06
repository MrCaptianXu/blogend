<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use components\bdeditor\Ueditor;

$this->title = '编辑博文';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">

    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'article-form']); ?>
            <?= $form->field($model, 'aid')->hiddenInput()->label(false) ?>
            <div  class="row">
                <div class="col-lg-6">
                    <?= $form->field($model, 'title')->input('text') ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model, 'cateId')->dropDownList(ArrayHelper::map(common\models\Category::find()->select(['cid', 'cateName'])->all(), 'cid', 'cateName')) ?>
                </div>
            </div>

            <div  class="row">
                <div class="col-lg-6">
                    <?= $form->field($model, 'tag') ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model, 'keywords') ?>
                </div>
            </div>
            <div>
                <?=
                $form->field($model, 'content')->widget(Ueditor::className(), [
                    'options' => [
                        'focus' => true,
//                            'toolbars' => [
//                                ['fullscreen', 'source', 'undo', 'redo', 'bold']
//                            ],
                    ],
                    'attributes' => [
                        'style' => 'height:300px'
                    ]
                ]);
                ?>
                <div class="form-group">
                    <?= Html::submitButton('确认修改', ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            <?php ?>
        </div>
    </div>
</div>
