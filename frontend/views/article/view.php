<?php if (isset($relateArticle) && $relateArticle) { ?>
    <div class="aside-nav">
        <ul >
            <?php foreach ($relateArticle as $relateModel) { ?>
                <li><a href="<?php echo \Yii::$app->urlManager->createUrl(['article/index', 'id' => $relateModel->aid]); ?>" title="<?php echo $relateModel->title; ?>"><?php echo $relateModel->title; ?></a></li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>


