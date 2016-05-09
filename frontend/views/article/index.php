<?php $this->title = isset($model['title']) ? $model['title'] . '_' . 'MrCaptain\'Share_忆燃科技':'MrCaptain\'Share_忆燃科技';?>
<div class="middle-container">
        <div class="left-container">
            <?php if ($model) { ?>
                <div class="cap-item-list">
                    <div class="article-title">
                        <h1>
                            &nbsp;
                            <a href="<?= \Yii::$app->urlManager->createUrl(['article/index', 'id' => $model->aid]); ?>" title="<?= $model['title']; ?>">
                                <?= $model['title']; ?>
                            </a>
                        </h1>
                        <span class="tag">
                            <?php
                            if ($model->tag != '') {
                                $tagArr = explode('#', $model->tag);
                                foreach ($tagArr as $tag) {
                                    ?>
                                    <a href="<?= \Yii::$app->urlManager->createUrl(['article/tag', 'tag' => strtolower($tag)]); ?>" title="<?= $tag; ?>"><?= $tag ?></a>
                                    <?php
                                }
                            }
                            ?>
                            <a><?= date('Y-m-d H:i', $model->updated_at) ?></a>
                        </span>
                        <div style="clear: both;"></div>
                    </div>
                    <div class="cap-article-content">
                        <?= $model['content']; ?>
                    </div>

                    <div class="copyright">
                        <p>转载请注明出处:</p>
                        <p>
                            标题: <?= $model['title']; ?>
                        </p>
                        <p>
                            地址: <a href="<?= \Yii::$app->urlManager->createUrl(['article/index', 'id' => $model->aid]); ?>" title="<?= $model['title'] ?>">
                                <?= $_SERVER['REDIRECT_URL'] ?>
                            </a>
                        </p>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="right-container">
            <?php
            if (isset($relateArticle) && $relateArticle) {
                echo $this->render('view', ['relateArticle'=>$relateArticle]);
            }
            ?>
        </div>
        <div style="clear: both;"></div>
    </div>
