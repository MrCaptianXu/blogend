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
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'MrCaptain\'Share',
                'brandUrl' => '#',
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
//                ['label' => 'Home', 'url' => ['/site/index']],
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

            <div class="container" style="border: 2px #f4645f solid;box-shadow:8px 10px 20px #ccc ">
                <div class="row" style="padding-left:30%;">
                    <div class="col-lg-9">
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
        function activeMenu(){
            var submenu = '<?php echo $subMenu; ?>';
            $('.submenu').each(function () {
                if ($(this).hasClass(submenu))
                {
                    menu = $(this);
                }else{
                    $(this).removeClass('active');
                    $(this).parent().removeClass('in');
                }
            }); 
            $('.'+ submenu).addClass('active');
            $('.'+ submenu).parent().addClass('in');
        }
    </script>
</html>
<?php $this->endPage() ?>
