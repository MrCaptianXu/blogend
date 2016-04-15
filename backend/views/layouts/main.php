<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <?= Html::cssFile('@web/public/bootstrap/css/dashboard.css') ?>
        <?= Html::cssFile('@web/public/uploadify/uploadify.css') ?>
        <?= Html::jsFile('@web/public/uploadify/jquery-1.11.3.min.js') ?>
        <?= Html::jsFile('@web/public/uploadify/jquery.uploadify.min.js') ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'MrCaptain\'Share',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-3 col-md-2 sidebar">
                        <ul class="nav nav-sidebar">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">

                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                            <a class="collapsed glyphicon glyphicon-th-list" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseTwo">
                                                博文管理
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                        <ul class="list-group" style="padding-left: 5%;">
                                            <li class="list-group-item ">
                                                <a class="article-index left-menu" accesskey=""href="<?= Yii::$app->urlManager->createUrl(['article/index']) ?>"><span class="article-index submenu glyphicon glyphicon-pencil">&nbsp;</span>博文列表</a>
                                            </li>
                                            <li class="list-group-item ">
                                                <a class="left-menu" accesskey=""href="<?= Yii::$app->urlManager->createUrl(['article/add']) ?>"><span class="article-add submenu glyphicon glyphicon-pencil">&nbsp;</span>添加博文</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel panel-default"><!--分类管理-->
                                    <div class="panel-heading" role="tab" id="headingTwo">
                                        <h4 class="panel-title">
                                            <a class="collapsed glyphicon glyphicon-th-list" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseTwo">
                                                分类管理
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                        <ul class="list-group" style="padding-left: 5%;">
                                            <li class="list-group-item ">
                                                <a class="left-menu" accesskey=""href="<?= Yii::$app->urlManager->createUrl(['category/index']) ?>"><span class="category-index submenu glyphicon glyphicon-pencil">&nbsp;</span>分类列表</a>
                                            </li>
                                            <li class="list-group-item ">
                                                <a class="left-menu" accesskey=""href="<?= Yii::$app->urlManager->createUrl(['category/add']) ?>"><span class="category-add submenu glyphicon glyphicon-pencil">&nbsp;</span>添加分类</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!--分类管理-->

                                <div class="panel panel-default"><!--Think管理-->
                                    <div class="panel-heading" role="tab" id="headingTwo">
                                        <h4 class="panel-title">
                                            <a class="collapsed glyphicon glyphicon-th-list" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThink" aria-expanded="false" aria-controls="collapseTwo">
                                                Think管理
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThink" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                        <ul class="list-group" style="padding-left: 5%;">
                                            <li class="list-group-item ">
                                                <a class="left-menu" accesskey=""href="<?= Yii::$app->urlManager->createUrl(['think/index']) ?>"><span class="think-index submenu glyphicon glyphicon-pencil">&nbsp;</span>Think列表</a>
                                            </li>
                                            <li class="list-group-item ">
                                                <a class="left-menu" accesskey=""href="<?= Yii::$app->urlManager->createUrl(['think/add']) ?>"><span class="think-add submenu glyphicon glyphicon-pencil">&nbsp;</span>添加Think</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!--Think管理-->

                            </div>
                        </ul>
                    </div>
                    <!--/left bar end -->
                    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                        <?=
                        Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ])
                        ?>
                        <?= Alert::widget() ?>
                        <?= $content ?>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
    <?php
    $controller = Yii::$app->controller->id;
    $action = Yii::$app->controller->action->id;
    $subMenu = $controller . '-' . $action;
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            activeMenu();
        });
        function activeMenu() {

            var submenu = '<?php echo $subMenu; ?>';
            $('.submenu').each(function () {
                if ($(this).hasClass(submenu))
                {
                    var menu = $(this);
                } else {
                    $(this).removeClass('active');
                    $(this).parent().removeClass('in');
                }
            });
            $('.' + submenu).closest('ul').css('background', '#d6533b');
            $('.' + submenu).closest('li').css('background', '#f4645f');
            var divObj= $('.' + submenu).closest('div');
            divObj.attr('style','');
            divObj.addClass('in');
        }
    </script>


</html>
<?php $this->endPage() ?>
