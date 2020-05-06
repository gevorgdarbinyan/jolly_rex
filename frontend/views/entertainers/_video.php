<?php if ($userData['video']) { ?>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="videoBlockHeading">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#videoBlock" aria-expanded="true" aria-controls="videoBlock">
                    Video
                    <!--<span class="glyphicon glyphicon-menu-down pull-right"></span>-->
                    <span class="glyphicon glyphicon-minus pull-right"></span>
                </a>
            </h4>
        </div>
        <!-- <div id="videoBlock" class="collapse in"> -->
        <div id="videoBlock" class="collapse fade in" aria-expanded="true">
            <div class="panel-body">
                <div class="embed-responsive embed-responsive-16by9 entertainer-page-video-block">
                    <iframe class="embed-responsive-item" src="<?= $userData['video'] ?>" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>