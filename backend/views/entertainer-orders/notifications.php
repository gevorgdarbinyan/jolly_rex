<?php
use yii\widgets\ListView;

$this->title = 'Orders Notifications';
?>
<h3><?=$entertainerOrders->partType_relation->name.' '.$entertainerOrders->host_child_name.' '.$entertainerOrders->event_date;?></h3>
<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <?=
            ListView::widget([
                'dataProvider' => $dataProvider,
                'options' => [
                    'tag' => 'div',
                    'class' => 'list-wrapper',
                    'id' => 'list-wrapper',
                ],
//        'layout' => "{pager}\n{items}\n{summary}",
                'layout' => "{pager}\n{items}",
                'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('_list_item', ['model' => $model]);

            // or just do some echo
            // return $model->title . ' posted by ' . $model->author;
        },
                'itemOptions' => [
                    'tag' => false,
                ],
                'pager' => [
                    'firstPageLabel' => 'first',
                    'lastPageLabel' => 'last',
                    'nextPageLabel' => 'next',
                    'prevPageLabel' => 'previous',
                    'maxButtonCount' => 3,
                ],
            ]);
            ?>
</div>

<div>
    <?php foreach($entertainerOrderNotifications as $notification): ?>
        <?php if($notification->sent_by_entertainer === 1) : ?>
            <h4>From: <?=$notification->entertainerOrder_relation->entertainer_relation->name;?></h4>
            <h4>To: <?=$notification->entertainerOrder_relation->customer_relation->fullName;?></h4>
        <?php endif; ?>

        <?php if($notification->sent_by_customer === 1) : ?>
            <h4>From: <?=$notification->entertainerOrder_relation->customer_relation->fullName;?></h4>
            <h4>To: <?=$notification->entertainerOrder_relation->entertainer_relation->name;?></h4>
        <?php endif; ?>
        
        <p><?=$notification->message;?></p>
        <p><?=$notification->entertainerOrder_relation->event_date?></p>
    <?php endforeach;?>
</div>