<?php
/* @var $this yii\web\View */

$this->title = isset($model) ? $model->title . '-MrCaptain\'Share(忆燃科技)' : '忆燃科技';
?>
<div class="site-index">
    <div class="body-content" style="max-width: 60%;min-width: 60%;margin: 0 auto;">
        <div class="row" style="border:5px #fff solid;padding: 5px;border-radius: 10px;">
            <?php if ($model) { ?>
                <div class="col-lg-12">
                    <ol class="breadcrumb" style="background: rgba(255 ,255, 255 ,0)">
                        <li><a href="<?php echo Yii::$app->homeUrl; ?>">Home</a></li>
                        <li class="active"><a href="<?php echo \Yii::$app->urlManager->createUrl(['article/index', 'id' => $model->aid]); ?>"><?php echo $model->title ?></a></li>
                    </ol>
                    <div class="panel panel-default" >
                        <div class="page-header text-center">
                            <h3><a href="<?php echo \Yii::$app->urlManager->createUrl(['article/index', 'id' => $model->aid]); ?>"><?php echo $model->title ?></a></h3>
                            <div class=" text-right">
                                <?php
                                if ($model->tag != '') {
                                    $tagArr = explode('#', $model->tag);
                                    foreach ($tagArr as $tag) {
                                        ?>   
                                        <a href="<?php echo \Yii::$app->urlManager->createUrl(['article/tag', 'tag' => strtolower($tag)]); ?>"><span class="label small label-success"><?php echo $tag; ?></span></a>
                                        <?php
                                    }
                                }
                                ?>
                                <span class="label label-info"><?php echo date('Y-m-d h:i:s', $model->updated_at) ?></span>
                            </div>
                        </div>
                        <div class="panel-body">
                            <?php
                            echo $model->content;
                            ?>
                            <p style="clear: both;">&nbsp;</p>
                        </div>
                    </div>
                </div>
                <?php
                if (isset($relateArticle) && $relateArticle) {
                    echo $this->render('view', ['relateArticle'=>$relateArticle]);
                }
            } else {
                ?>
                <div class="alert alert-info" role="alert">
                    <a href="#" class="alert-link">
                        -- 此模块正在努力构想中...
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>


