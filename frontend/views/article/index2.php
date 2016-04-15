<?php
/* @var $this yii\web\View */

$this->title = isset($model) ? $model->title . '-MrCaptain\'Share(忆燃科技)' : '忆燃科技';
?>
<div class="site-index cap-main-content">

    <div class="body-content">
        <div class="row" style="border:5px #20B2AA solid;padding: 5px;border-radius: 10px;">
            <?php if ($model) { ?>
                <div class="col-lg-12">
                    <ol class="breadcrumb" style="background: rgba(255 ,255, 255 ,0.3);">
                        <li><a href="<?php echo Yii::$app->homeUrl; ?>" title="<?php echo "首页" ?>">Home</a></li>
                        <li class="active"><a href="<?php echo \Yii::$app->urlManager->createUrl(['article/index', 'id' => $model->aid]); ?>" title="<?php echo $model->title ?>"><?php echo $model->title ?></a></li>
                    </ol>
                    <div class="panel panel-default cap-content-inner">
                        <div class="page-header text-center">
                            <h3><a href="<?php echo \Yii::$app->urlManager->createUrl(['article/index', 'id' => $model->aid]); ?>" title="<?php echo $model->title ?>"><?php echo $model->title ?></a></h3>
                            <div class=" text-right">
                                <?php
                                if ($model->tag != '') {
                                    $tagArr = explode('#', $model->tag);
                                    foreach ($tagArr as $tag) {
                                        ?>   
                                        <a href="<?php echo \Yii::$app->urlManager->createUrl(['article/tag', 'tag' => strtolower($tag)]); ?>"><span class="label small label-success" title="<?php echo $tag; ?>"><?php echo $tag; ?></span></a>
                                        <?php
                                    }
                                }
                                ?>
                                <span class="label label-info"><?php echo date('Y-m-d H:i', $model->updated_at) ?></span>
                            </div>
                        </div>
                        <div class="panel-body"style="color: #000;">
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
                        SORRY -- 没有查询到信息
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>


