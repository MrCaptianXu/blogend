<?php
/* @var $this yii\web\View */

use yii\widgets\LinkPager;

$this->title = Yii::$app->params['sitename'];
?>


<div class="site-index cap-main-content row" >
    <div class="body-content " style=" min-width: 600px;">
        <div class="col-md-9 cap-content-line">
            <?php foreach ($models as $model) { ?>
            <div class="col-lg-12 ">
                    <div class="panel panel-default" style="min-height: 200px;background: rgba(255 ,255, 255 ,0);" >
                        <div class="panel-body" style="color:#000;font-size:13px;background: rgba(255 ,255, 255 ,0.5);">
                            <a href="<?php echo \Yii::$app->urlManager->createUrl(['article/index', 'id' => $model->aid]); ?>" class="cap-pencil"></a>
                            <div class="cap-triangle"></div>
                            <h3><a href="<?php echo \Yii::$app->urlManager->createUrl(['article/index', 'id' => $model->aid]); ?>"><?php echo $model->title ?></a></h3>
                            <?php echo mb_substr($model->content, 0, 500, 'utf-8');?>
                            <p style="clear: both;">&nbsp;</p>
                            <p class="text-right" ><a class="btn btn-success" href="<?php echo \Yii::$app->urlManager->createUrl(['article/index', 'id' => $model->aid]); ?>">阅读全文 &raquo;</a></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-lg-12" style="text-align: center;">
                <div class="panel panel-default" style="text-align: center;background: rgba(255 ,255, 255 ,0.6)">
                        <?php
                        // 显示分页
                        echo LinkPager::widget([
                            'pagination' => $pages,
                        ]);
                        ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class=""><?php echo Yii::$app->runAction('site/column'); ?></div>

    </div>


    <!-- search bar -->
    <div  class="searchBar" style="height:50px; top:8%;right:0;position: absolute;background: rgba(255 ,255, 255 ,0.2)">
        <form class="navbar-form navbar-left" role="search" method="post" action="<?php echo \Yii::$app->urlManager->createUrl(['article/search']); ?>">
            <div class="form-group" style="background: rgba(255 ,255, 255 ,0.5)">
                <input type="text" class="form-control searchBar" name="keyword" value="php" style="width: 120px;background: rgba(255 ,255, 255 ,0.2)"/>
                <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
            </div>
            <button type="submit" class="btn btn-default" style="background: rgba(255 ,255, 255 ,0.5)">Search</button>
        </form>
    </div>
</div>


