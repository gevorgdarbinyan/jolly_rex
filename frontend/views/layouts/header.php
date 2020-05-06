<?php
use yii\helpers\Html;
use common\models\Orders;
?>
<nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar slide-menu-icon"></span>
                        <span class="icon-bar slide-menu-icon"></span>
                        <span class="icon-bar slide-menu-icon"></span>                        
                    </button>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/']); ?>">
                        <img class="logo" src="<?php echo Yii::$app->request->baseUrl; ?>/images/logo.png">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">

                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/site/about">About us</a></li>
                        <li><a href="/entertainers/">Entertainers</a></li>
                        <li><a href="/venue/">Venues</a></li>
                        <li><a href="/food/providers/">Foods</a></li>
                        <li><a href="/product/providers/">Products</a></li>
                        <li><a href="#">Partner with us</a></li>
                        <?php
                        if (Yii::$app->user->isGuest) {
                            ?>
<!--                            <li><a id="sign_up" style="cursor: pointer;"><span class="glyphicon glyphicon-sing-up"></span> Sign Up</a></li>
                            <li><a id="log_in" style="cursor: pointer;"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>-->
                            <li><a href="/site/signup"><span class="glyphicon glyphicon-sing-up"></span> Sign Up</a></li>
                            <li><a href="/site/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                            <?php
                        } else {
                            ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle logged-in-user-email" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= Yii::$app->user->identity->email ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <?= Html::a('Profile', ['user/profile', 'id' => Yii::$app->user->identity->id], []); ?>
                                    </li>
                                    <li>
                                        <?= Html::a('My settings', ['site/user-settings#site-user-settings'], []); ?>
                                    </li>
                                    <li>
                                        <?= Html::a('Log out', ['site/logout'], []); ?>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <?= Html::a('<span class="glyphicon glyphicon-shopping-cart"></span> ', ['orders/basket'], ['']); ?>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>