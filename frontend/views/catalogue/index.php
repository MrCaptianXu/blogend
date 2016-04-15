<?php
/* @var $this yii\web\View */
$this->title = Yii::$app->params['sitename'];
?>
<div class="cap-item-list">
    <h3 style="color: #F4645F;">博文列表：</h3>
    <?php foreach ($models as $model) { ?>
        <ul>
            <li>
                <h4  style="color: #F4645F;">
                    <?= $model['cateName']; ?>&nbsp;&nbsp;(<?= $model['count'];?>篇)
                </h4>
                <hr />
                <ul>
                    <?php foreach($model['list'] as $k => $vv){ ?>
                    <li class="article-title" >
                        <a href="<?php echo \Yii::$app->urlManager->createUrl(['article/index', 'id' => $vv['aid']]); ?>" title="<?php echo $vv['title']; ?>"><?php echo $vv['title']; ?></a>
                        <p class="text-right" style="color: #666;"><?php echo date('Y-m-d H:i',$vv['updated_at']); ?></p>
                    </li>
                    <hr />
                    <?php } ?>
                </ul>
            </li>
        </ul>
    <?php } ?>
</div>


