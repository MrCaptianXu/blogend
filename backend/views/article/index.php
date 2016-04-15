<?php

use yii\helpers\Html;
use yii\grid\GridView;
?>
<div class="site-index">

    <div class="panel panel-default">
        <div class="panel-body">
            <!-- Single button -->
            <div class="btn-group">
                <a href="<?php echo Yii::$app->urlManager->createUrl(['article/add']) ?>">
                    <button type="button" class="btn btn-info ">
                        添加博文
                    </button>
                </a>
            </div>
        </div>
    </div>
    <div class="body-content">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'title',
                'tag',
                [
                    'attribute' => 'updated_at',
                    'format' => ['date', 'php:Y-m-d h:i']
                ],
//                [
//                    'class' => 'yii\grid\ActionColumn', 'header' => '操作',
//                ],
                [
                    'class' => 'yii\grid\ActionColumn', 'header' => '操作',
                    'template' => '{update} {delete}',
                    'buttons' => [
                        // 下面代码来自于 yii\grid\ActionColumn 简单修改了下
                        'update' => function ($url, $model, $key) {
                            $options = [
                                'title' => Yii::t('yii', '编辑'),
                                'aria-label' => Yii::t('yii', 'Update'),
                                'data-pjax' => '0',
                            ];
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                        },
                                'delete' => function ($url, $model, $key) {
                            $options = [
                                'title' => Yii::t('yii', '删除'),
                                'aria-label' => Yii::t('yii', 'Delete'),
                                'data-confirm' => Yii::t('yii', '确定要删除这条信息吗?'),
                                'data-method' => 'post',
                                'data-pjax' => '0',
                            ];
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, $options);
                        },
                            ]]
//                [
//                    'label' => '更多操作',
//                    'format' => 'raw',
//                    'value' => function($data) {
//                        $url = "http://www.baidu.com";
//                        return Html::a('添加权限组', $url, ['title' => '审核']);
//                    }
//                        ]
                    ],
                ]);
                ?>
    </div>
</div>