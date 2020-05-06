<div>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="galleryBlockHeading">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" href="#galleryBlock" aria-expanded="false" aria-controls="galleryBlock">
                            Gallery
                            <!--<span class="glyphicon glyphicon-menu-down pull-right"></span>-->
                            <span class="glyphicon glyphicon-plus pull-right"></span>
                        </a>
                    </h4>
                </div>
                <div id="galleryBlock" class="fade collapse">
                    <div class="panel-body">
                        <?php $items = [
                            [
                                'url' => 'http://farm8.static.flickr.com/7429/9478294690_51ae7eb6c9_b.jpg',
                                'src' => 'http://farm8.static.flickr.com/7429/9478294690_51ae7eb6c9_s.jpg',
                                'options' => array('title' => 'Camposanto monumentale (inside)')
                            ],
                            [
                                'url' => 'http://farm4.static.flickr.com/3712/9478186779_81c2e5f7ef_b.jpg',
                                'src' => 'http://farm4.static.flickr.com/3712/9478186779_81c2e5f7ef_s.jpg',
                                'options' => array('title' => 'Sail us to the Moon')
                            ],
                            [
                                'url' => 'http://farm4.static.flickr.com/3789/9476654149_b4545d2f25_b.jpg',
                                'src' => 'http://farm4.static.flickr.com/3789/9476654149_b4545d2f25_s.jpg',
                                'options' => array('title' => 'Sail us to the Moon')
                            ],
                            [
                                'url' => 'http://farm8.static.flickr.com/7429/9478868728_e9109aff37_b.jpg',
                                'src' => 'http://farm8.static.flickr.com/7429/9478868728_e9109aff37_s.jpg',
                                'options' => array('title' => 'Sail us to the Moon')
                            ],
                            [
                                'url' => 'http://farm4.static.flickr.com/3825/9476606873_42ed88704d_b.jpg',
                                'src' => 'http://farm4.static.flickr.com/3825/9476606873_42ed88704d_s.jpg',
                                'options' => array('title' => 'Sail us to the Moon')
                            ],
                            [
                                'url' => 'http://farm4.static.flickr.com/3749/9480072539_e3a1d70d39_b.jpg',
                                'src' => 'http://farm4.static.flickr.com/3749/9480072539_e3a1d70d39_s.jpg',
                                'options' => array('title' => 'Sail us to the Moon')
                            ],
                            [
                                'url' => 'http://farm8.static.flickr.com/7352/9477439317_901d75114a_b.jpg',
                                'src' => 'http://farm8.static.flickr.com/7352/9477439317_901d75114a_s.jpg',
                                'options' => array('title' => 'Sail us to the Moon')
                            ],
                            [
                                'url' => 'http://farm4.static.flickr.com/3802/9478895708_ccb710cfd1_b.jpg',
                                'src' => 'http://farm4.static.flickr.com/3802/9478895708_ccb710cfd1_s.jpg',
                                'options' => array('title' => 'Sail us to the Moon')
                            ],
                        ];?>
                        <?= dosamigos\gallery\Gallery::widget(['items' => $items]);?>
                    </div>
                </div>
            </div>
        </div>
</div>