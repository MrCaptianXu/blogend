<?php if (isset($models) && $models) { ?>
<div class="aside-nav">
    <ul>
        <?php foreach ($models as $item) { ?>
            <li>
                <a href="<?= \Yii::$app->urlManager->createUrl(['article/category','cate' =>strtolower($item['cateName'])]) ?>" title="<?= ucwords(strtolower($item['cateName'])); ?>"><?= ucwords(strtolower($item['cateName'])); ?></a>
            </li>
        <?php } ?>
    </ul>
</div>
<?php } ?>
