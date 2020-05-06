<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<?php 
use Yii\web\View;

$this->registerJsFile('@web/js/orders/confirmation.js', ['position' => View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/css/orders/confirmation.css');
?>
<div class="pyro">
    <div class="before"></div>
    <div class="after"></div>
</div>
<div class="row confirmaton-template">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
    </div>
</div>

<div id="letters-text">
  <h1 class="ml8">
    <span class="letters-container">
      <span class="letters letters-left">CONGRATULATIONS!<br /><br /><span style="font-size:36px;">Thank You For Your Order</span></span>
    </span>
  </h1>
</div>
<audio controls id="music">
  <source src="/images/confirmation/music.mp3" type="audio/mpeg">
</audio>

<!-- <embed src="/images/confirmation/music.mp3" autostart="true" loop="false"> -->
<script type="text/javascript">
    anime.timeline({loop: true})
  .add({
    targets: '.ml8 .circle-white',
    scale: [0, 3],
    opacity: [1, 0],
    easing: "easeInOutExpo",
    rotateZ: 360,
    duration: 1100
  }).add({
    targets: '.ml8 .circle-container',
    scale: [0, 1],
    duration: 1100,
    easing: "easeInOutExpo",
    offset: '-=1000'
  }).add({
    targets: '.ml8 .circle-dark',
    scale: [0, 1],
    duration: 1100,
    easing: "easeOutExpo",
    offset: '-=600'
  }).add({
    targets: '.ml8 .letters-left',
    scale: [0, 1],
    duration: 1200,
    offset: '-=550'
  }).add({
    targets: '.ml8 .bang',
    scale: [0, 1],
    rotateZ: [45, 15],
    duration: 1200,
    offset: '-=1000'
  }).add({
    targets: '.ml8',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 1400
  });

anime({
  targets: '.ml8 .circle-dark-dashed',
  rotateZ: 360,
  duration: 8000,
  easing: "linear",
  loop: true
});
</script>