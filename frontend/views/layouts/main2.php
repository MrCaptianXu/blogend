<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <title><?= Html::encode($this->title) ?></title>
        <meta name="keywords" content="忆燃,忆燃科技网,YIRAN,yiran,MRCAPTAIN,mrcaptain.cn,忆燃科技首页,博客,技术分享" />
	<meta name="description" content="忆燃科技网（mrcaptain.cn）为MRCAPTAIN精心设计维护的技术网站，记录并分享学习、生活、思想上的技术文章，涉及PHP技术、MYSQL数据库技术、YII技术、LARAVEL技术、QEEPHP技术等自由互动交流空间。" />
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        
        <link rel="shortcut icon" href="../image/favicon.png">
        <?php $this->head() ?>
    </head>
    <body style="">
        <?php $this->beginBody() ?>
            
        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => '分享是快乐的 ...',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-default navbar-fixed-top title-bar',
                    'style' => 'font-color:#222E2A;background-color:#20B2AA;',
                    'id' => 'top-menu'
                ],
            ]);
            $menuItems = [
                ['label' => '首页', 'url' => ['/']],
                ['label' => '博文目录', 'url' => ['catalogue/index']],
                ['label' => 'Think', 'url' => ['think/index']],
                ['label' => '微博', 'url' => 'http://weibo.com/u/1613414935'],
                ['label' => 'Contact', 'url' => 'tencent://message/?uin=179985550&Menu=yes'],
            ];
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>

            <div class="container" style="width: 100%;margin: 0;padding: 0">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>
                <div class="jumbotron" >
                    <h1 style="color: #222E2A;text-shadow: 2px 2px 2px #008b57;">MrCaptain'Share</h1>
                    <p class="lead" style="color: #222E2A;text-shadow: 1px 1px 0px #008b57;">认真 坚韧 博爱 担当</p>
                </div>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer" style="margin-top: 40px;background: #20B2AA">
            <div class="container">
                <p class="pull-left" title="MrCaptain'Share">&copy; MrCaptain'Share <a href="http://www.mrcaptain.cn" title="MrCaptain'Share"><?= 'www.mrcaptan.cn' ?></a></p>
                <p class="pull-right"><a href="http://www.mrcaptain.cn" title="认真 坚韧 博爱 担当"><?= '认真 坚韧 博爱 担当' ?></a></p>
            </div>
        </footer>
        <a href="#" id="back-top">回到顶部</a>
        <script>
            var initTop = 0;
            $(window).scroll(function () {
                var scrollTop = $(document).scrollTop();
                //console.log(scrollTop);
                if (scrollTop > 1500) {
                    $('#back-top').show();
                }else{
                    $('#back-top').hide();
                }
                if (scrollTop > initTop) {
                    $('#top-menu').fadeOut(1000);
                } else {
                    $('#top-menu').fadeIn(1000);
                }
                initTop = scrollTop;
            });
            $(document).ready(function () {
                // 小屏宽度 重置主内容区宽度
                if($(window).width() <700){
                    $(".cap-main-content").css({"max-width":"85%"});
                    $(".searchBar").hide();
                }

                $('#back-top').click(function () {
                    $('html,body').animate({scrollTop: '0px'}, 1000);
                    return false;
                });
                //randomQuotes();
                menuScroll(function (direction) {
                    if (direction == 'down') {
                        $('#top-menu').fadeOut(1000);
                    } else {
                        $('#top-menu').fadeIn(1000);
                    }
                });
            });

            // 监听重置窗口大小
            $(window).bind("resize", resizeWindow);
            function resizeWindow(e) {
                var windowWidth = $(window).width();
                if(windowWidth < 700){ $(".cap-main-content").css({"max-width":"85%"}); }
                if(windowWidth < 700){ $(".searchBar").hide();}else{$(".searchBar").show();}


                //var windowHeight = $(window).height();
//                $('img').each(function () {       // 遍历图片 重置大小
//                    $(this).css({'width': windowWidth});
//                });
            }
        </script>
<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"5","bdPos":"right","bdTop":"100"},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>