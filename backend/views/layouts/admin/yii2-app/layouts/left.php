<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?=Yii::getAlias('@web') ?>/images/sys_admin.jpg" class="img-circle" alt="User Image"/>
            </div>
            <?php 
                $user = Yii::$app->user->identity; 
            ?>
            <div class="pull-left info">
                <p><?=$user->email;?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Orders', 'icon' => 'list-ul', 'url' => ['/orders']],
                    ['label' => 'Users', 'options' => ['class' => 'header']],
                    ['label' => 'Customers', 'icon' => 'users', 'url' => ['/customers']],
                    ['label' => 'Entertainers', 'icon' => 'users', 'url' => [''],
                        'items' => [
                            ['label' => 'Entertainer List', 'icon' => 'reorder', 'url' => ['/entertainer']],
                            ['label' => 'Entertainer Orders', 'icon' => 'reorder', 'url' => ['/entertainer-orders']],
                        ]
                    ],
                    ['label' => 'Venues', 'icon' => 'building', 'url' => ['/venue']],
                    ['label' => 'Products', 'icon' => 'gift', 'url' => ['/product']],
                    ['label' => 'Food', 'icon' => 'birthday-cake', 'url' => ['/food']],
                    ['label' => 'Party Theme', 'icon' => 'users', 'url' => ['/party-theme'],
                        'items' => [
                            ['label' => 'Services', 'icon' => 'reorder', 'url' => ['/services']]
                        ]
                    ],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
