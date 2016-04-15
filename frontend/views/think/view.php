<?php if (isset($relateArticle) && $relateArticle) { ?>
    <div class="col-lg-12" >
        <div class="panel panel-default" >
            <div class="panel-body" style="background: #DDD;">
                <ul>
                    <?php foreach ($relateArticle as $relateModel) { ?>
                        <li><a href="<?php echo \Yii::$app->urlManager->createUrl(['article/index', 'id' => $relateModel->aid]); ?>"><?php echo $relateModel->title; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
<?php } ?>

