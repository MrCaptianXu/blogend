<?php
/* @var $this yii\web\View */

use yii\widgets\LinkPager;

$this->title = "MrCaptain'Share";
?>
<div class="site-index">

    <div class="jumbotron" >
        <h1 style="color: #222E2A;text-shadow: 2px 2px 2px #008b57;">MrCaptain'Share</h1>
        <p id="random-qoute" class="lead" style="color: #222E2A;">志不强者智不达。 —— 墨翟</p>
    </div>

    <div class="body-content" style="max-width: 60%;min-width: 60%;margin: 0 auto;">
        <div class="row" style="border:5px #fff solid;padding: 5px;border-radius: 10px;">
            <?php foreach ($models as $model) { ?>
                <div class="col-lg-12">
                    <div class="panel panel-default" style="border: 1px solid; box-shadow: 2px 5px 10px #063 inset;min-height: 200px">
                        <div class="panel-body" >
                            <a href="<?php echo \Yii::$app->urlManager->createUrl(['article/index', 'id' => $model->aid]); ?>" class="cap-pencil"></a>
                            <div class="cap-triangle"></div>
                            <h2><a target="_blank" href="<?php echo \Yii::$app->urlManager->createUrl(['article/index', 'id' => $model->aid]); ?>"><?php echo $model->title ?></a></h2>
                            <?php
                            echo mb_substr($model->content, 0, 500, 'utf-8');
                            ?>
                            <p style="clear: both;">&nbsp;</p>
                            <p class="text-right" ><a class="btn btn-success" href="<?php echo \Yii::$app->urlManager->createUrl(['article/index', 'id' => $model->aid]); ?>" target="_blank">阅读全文 &raquo;</a></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-lg-12" style="text-align: center">
                <div class="panel panel-default" >
                    <div class="panel-body" >
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
    </div>
</div>


