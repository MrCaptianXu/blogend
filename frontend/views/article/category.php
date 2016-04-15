<?php
/* @var $this yii\web\View */
use yii\widgets\LinkPager;
$this->title = Yii::$app->params['sitename'];
?>
    <div class="middle-container">
        <div class="left-container">
            <?php if($models) : ?>
            <?php  foreach($models as $k => $model){ ?>
                <div class="cap-item-list">
                    <div class="article-title">
                        <h1>
                            <a href="<?= \Yii::$app->urlManager->createUrl(['article/index', 'id' => $model->aid]); ?>" title="<?=$model['title'] ?>"><?= $model['title'] ?></a>
                        </h1>
                    </div>
                    <div class="cap-article-description">
                        <?php
                        $_tmp = str_replace(' ', '',strip_tags($model['content']));
                        $_tmp = str_replace('&nbsp;', '' ,$_tmp);
                        if(strlen($_tmp) > 500){
                            echo mb_substr($_tmp,0 , 500, 'utf-8') . ' ……';
                        }else{
                            echo $_tmp;
                        }
                        ?>
                        <p class="cap-read-more"><a href="<?=\Yii::$app->urlManager->createUrl(['article/index', 'id' => $model->aid]);?>" title="<?=$model['title'] ?>">阅读全文>></a></p>
                    </div>
                </div>
            <?php } else : ?>
            <div class="cap-item-list">
                <div class="cap-item-list">
                    <div class="article-title">
                        <h1>
                            <a href="">文章列表</a>
                        </h1>
                    </div>
                    <div class="cap-article-description" style="overflow: hidden;z-index: -1;">
                        <p style="color: #008b57;">该分类下暂无文章，欣赏下面文章休息下吧！</p>
                        <p><small style="color: red">如涉侵权,请在右上角通过"联系我"立即删除 </small></p>
                        <div id="url-content">
                            <?php
                            $url ='http://mp.weixin.qq.com/s?__biz=MzA4MzE0NjE3Mg==&mid=406223775&idx=1&sn=b0b8d822dc5c2bceb9f252d48ce9d023&scene=4#wechat_redirect';
                            echo file_get_contents($url)
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="cap-item-list">
                <?= LinkPager::widget([
                    'pagination' => $pages,
                ]);
                ?>
            </div>
        </div>

        <div class="right-container">
            <?php echo Yii::$app->runAction('site/column'); ?>
            <div class="aside-nav" style="border: none;background: #fff;">
                <iframe width="100%" height="550" class="share_self"  frameborder="0" scrolling="no" src="http://widget.weibo.com/weiboshow/index.php?language=&width=0&height=550&fansRow=2&ptype=1&speed=0&skin=1&isTitle=1&noborder=1&isWeibo=1&isFans=0&uid=1613414935&verifier=8685027d&dpc=1"></iframe>
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>
<script type="text/javascript">
    $(document).ready(function(){
        var c = $('#js_content').html();
        $('#url-content').html(c);
    });
</script>