<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = '添加分类';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">


    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'category-form']); ?>

                <?= $form->field($model, 'cateName') ?>

                <?= $form->field($model, 'sort') ?>
                <div class="form-group">
                    <?= Html::submitButton('确认保存', ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
