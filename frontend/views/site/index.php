<?php
/* @var $this yii\web\View */
use yii\widgets\LinkPager;
$this->title = Yii::$app->params['sitename'];
?>
    <div class="middle-container">
        <div class="left-container">
            <?php  foreach($models as $k => $model){ ?>
                <div class="cap-item-list">
                    <div class="article-title">
                        <h1>
                            <a href="<?= \Yii::$app->urlManager->createUrl(['article/index', 'id' => $model->aid]); ?>" title="<?=$model['title'] ?>"><?= $model['title'] ?></a>
                        </h1>
                    </div>
                    <div class="cap-article-description">
                        <?php
                            //$_tmp = str_replace(' ', '',strip_tags($model['content']));
                            $_tmp = str_replace('&nbsp;', ' ' ,strip_tags($model['content']));
                            //$_tmp = strip_tags($model['content']);
                            if(strlen($_tmp) > 600){
                                echo mb_substr($_tmp,0 , 600, 'utf-8') . ' ...';
                            }else{
                                echo $_tmp;
                            }
                        ?>
                        <p class="cap-read-more"><a href="<?=\Yii::$app->urlManager->createUrl(['article/index', 'id' => $model->aid]);?>" title="<?=$model['title'] ?>">阅读全文>></a></p>
                    </div>
                </div>
            <?php } ?>
            <div class="cap-item-list">
                <?= LinkPager::widget([
                    'pagination' => $pages,
                    ]);
                ?>
            </div>
        </div>

        <div class="right-container">
            <?php echo Yii::$app->runAction('site/column'); ?>
            <div class="aside-nav" style="background: #fff">
                <iframe width="100%" height="550" class="share_self"  frameborder="0" scrolling="no" src="http://widget.weibo.com/weiboshow/index.php?language=&width=0&height=550&fansRow=2&ptype=1&speed=0&skin=1&isTitle=1&noborder=1&isWeibo=1&isFans=0&uid=1613414935&verifier=8685027d&dpc=1"></iframe>
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>



