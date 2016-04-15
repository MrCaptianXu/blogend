<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
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

        <div id="top-menu" class="top-menu">
            <div class="share" style=""><a href="<?= \Yii::$app->urlManager->createUrl(['/']); ?>">分享是快乐的...</a></div>
            <div class="menu">
                <ul>
                    <li><a href="<?= \Yii::$app->urlManager->createUrl(['/']); ?>">首页</a></li>
                    <li><a href="<?= \Yii::$app->urlManager->createUrl(['catalogue']); ?>">目录索引</a></li>
                    <li><a href="http://weibo.com/u/1613414935" target="_blank">微博</a></li>
                    <li><a href="tencent://message/?uin=179985550&Menu=yes" target="_blank">联系我</a></li>
                </ul>
            </div>
            <div style="clear: both;"></div>
        </div>

        <div class = 'main-container'><!--主内容区-->
            <div class="top-container">
                <div class="captain">
                    <h1>MrCaptain'Share</h1>
                    <p class="motto">认真 坚韧 博爱 担当</p>
                </div>
            </div>
            <?= $content ?>
        </div>

        <div class="bottom-container" style="text-align: center">
            <p class="motto">认真 坚韧 博爱 担当</p>
            <p class="copyright" title="MrCaptain'Share">
                <a href="http://www.mrcaptain.cn" title="MrCaptain'Share"><?= 'www.mrcaptan.cn' ?></a>
                |<a href="http://www.miitbeian.gov.cn/">苏ICP备16012426号-1</a>
                <span><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1258202980'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/z_stat.php%3Fid%3D1258202980%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script></span>
            </p>
        </div>
        <a href="#" id="back-top">回到顶部</a>

<script type="text/javascript">
    var initTop = 0;
    $(window).scroll(function () {
        var scrollTop = $(document).scrollTop();
        if (scrollTop > 1500) {
            $('#back-top').show();
        }else{
            $('#back-top').hide();
        }

        if (scrollTop > initTop) {
            $('#top-menu').fadeOut(500);
        } else {
            $('#top-menu').fadeIn(500);
        }
        initTop = scrollTop;
    });


    $(document).ready(function () {
        /* 小屏宽度 重置主内容区宽度 */
        if($(window).width() <700){
            $('.left-container').css('width', '100%');
            $('.right-container').css('width', '100%');
            $('.middle-container').css('width', '90%');

            // 重置大标题大小
            $('.captain').css('font-size', '15px');
        }
        /* 回到顶部 */
        $('#back-top').click(function () {
            $('html,body').animate({scrollTop: '0px'}, 1000);
            return false;
        });
        /* 设置主内容区不被顶部菜单覆盖 */
        $('.main-container').css('margin-top',$('.top-menu').height());
        //randomQuotes();

    });

    // 监听重置窗口大小
//            $(window).bind("resize", resizeWindow);
//            function resizeWindow(e) {
//                var windowWidth = $(window).width();
//                if(windowWidth < 700){ $(".cap-main-content").css({"max-width":"85%"}); }
//                if(windowWidth < 700){ $(".searchBar").hide();}else{$(".searchBar").show();}

        //var windowHeight = $(window).height();
//                $('img').each(function () {       // 遍历图片 重置大小
//                    $(this).css({'width': windowWidth});
//                });
</script>

        <script type="text/javascript">
            SyntaxHighlighter.defaults['gutter'] = true;
            SyntaxHighlighter.defaults['html-script'] = false;
            SyntaxHighlighter.all();
        </script>
<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>