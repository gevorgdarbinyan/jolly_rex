<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//use Yii;
use yii\helpers\Html;
use yii\web\View;
use \yii2fullcalendar\yii2fullcalendar;

$this->title = 'Food';

$this->registerJsFile('@web/js/food/page.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/css/food/page.css');
?>

<div class="container">
    <div class="food-external-page">
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="text-align-center" style="margin-top: 30px; margin-bottom: 30px;">
                        <?php
                        $images = [
                            [
                                'image' => 'http://farm8.static.flickr.com/7429/9478294690_51ae7eb6c9_b.jpg',
                                'small' => 'http://farm8.static.flickr.com/7429/9478294690_51ae7eb6c9_b.jpg',
                                'medium' => 'http://farm8.static.flickr.com/7429/9478294690_51ae7eb6c9_b.jpg'
                            ],
                            [
                                'image' => 'http://farm4.static.flickr.com/3712/9478186779_81c2e5f7ef_b.jpg',
                                'small' => 'http://farm4.static.flickr.com/3712/9478186779_81c2e5f7ef_b.jpg',
                                'medium' => 'http://farm4.static.flickr.com/3712/9478186779_81c2e5f7ef_b.jpg'
                            ],
                            [
                                'image' => 'http://farm4.static.flickr.com/3789/9476654149_b4545d2f25_b.jpg',
                                'small' => 'http://farm4.static.flickr.com/3789/9476654149_b4545d2f25_b.jpg',
                                'medium' => 'http://farm4.static.flickr.com/3789/9476654149_b4545d2f25_b.jpg'
                            ],
                        ];

                        echo \amilna\elevatezoom\ElevateZoom::widget([
                            'images' => $images,
                        ]);
                        ?>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#description">Description</a></li>
                        <li><a data-toggle="tab" href="#reviews">Reviews</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="description" class="tab-pane fade in active">
                            <p><?= str_replace("\n","<br />",$foodItemData->description); ?></p>
                        </div>
                        <div id="reviews" class="tab-pane fade">
                            <p>There are no reviews</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <h2 class="food-page-header"><?= $foodItemData->name ?></h2>
                <h6>Availability: <?=($foodItemData->in_stock == 1) ? 'In Stock' : 'Out of Stock';?></h6>
                <h5 class="price-header">£<?= $foodItemData->price ?></h5>
                <h6><?=$foodItemData->food_relation->name;?></h6>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="margin-top:30px;padding:18px;">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon input-number-decrement">-</span>
                        <input type="text" class="form-control bfh-number food-item-count" data-min="0" data-max="9999999" value="1">
                        <span class="input-group-addon input-number-increment">+</span>
                    </div>
                </div>
                <div style="margin: 20px 0px;">
                    Availibility of calendar
                    <?php
                    echo
                    yii2fullcalendar::widget(array(
                        'clientOptions' => [
                            'header' => ['right' => ''],
                            'dayClick' => new \yii\web\JsExpression('
                                function (date, jsEvent, view) {
                                    var dateValue = date.format();
                                    var dateExpression = new Date(dateValue);
                                    var toDateString = dateExpression.toDateString();
                                    $(this).css("background-color", "red");
                                    $(".selected-date").html(toDateString);
                                    $(".selected-date-class").val(dateValue);
                                    $("#time-container").show();
                                    var entertainerID = '.$foodItemData->id.';
                                    $("#modal-schedule-content").modal("show");
                                }'
                            ),
                            'dayRender' => new \yii\web\JsExpression('
                                function (date, cell) {
                                    var check = $.fullCalendar.formatDate(date,"YYYY-MM-DD");
                                    //console.log(check);
                                    if (moment().diff(date,"days") > 0){
                                        //cell.css("background-color","red");
                                    }else{
                                        //cell.css("background-color", "green");
                                    }
                                }'
                            ),
                        ],
                    ));
                    ?>
                </div>
                <div class="form-group">
                    <?=Html::button('L', ['class' => 'btn btn-defualt','style'=>'border:1px solid #ccc;']);?>
                    <?=Html::button('M', ['class' => 'btn btn-defualt','style'=>'border:1px solid #ccc;']);?>
                    <?=Html::button('S', ['class' => 'btn btn-defualt','style'=>'border:1px solid #ccc;']);?>
                </div>
                <div class="form-group">
                    <?=Html::textInput('people_count', '', ['class' => 'form-control people-count-class','placeholder'=>'How many people?...']);?>
                </div>
                <div class="form-group">
                    <?=Html::textInput('message_on', '', ['class' => 'form-control message-on-class','placeholder'=>'Message on the cake...']);?>
                </div>
                <div class="form-group">
                    <?=Html::textInput('color_message_on', '', ['class' => 'form-control message-on-class','placeholder'=>'Color of the message...']);?>
                </div>
                <div class="form-group">
                    <?=Html::textInput('font_message_on', '', ['class' => 'form-control message-on-class','placeholder'=>'Font of the message:Streigth/Italic...']);?>
                </div>
                <div class="form-group">
                    <?=Html::textInput('delivery_address', '', ['class' => 'form-control message-on-class','placeholder'=>'Address for delivery...']);?>
                </div>
                <div class="form-group">
                    <?=Html::textArea('note','',['class'=>'form-control note-class','rows'=>6,'placeholder'=>'Write a note...'])?>
                </div>
                <div class="form-group">
                    <?php echo Html::button('Add to Basket', ['class' => 'btn btn-primary add-to-cart']);?>
                </div>
            </div>
        </div>
    </div>

</div>