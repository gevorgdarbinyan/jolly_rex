<div>
    <h1 class="entertaner-page-heading"><?= $venueData['name'] ?></h1>
</div>
<div>
    <h2>
        <?php
        $userRating = $venueData['rating'];
        for ($i = 0; $i < 5; $i++) {
            if ($i < $userRating) {
                ?>
                <span class="glyphicon glyphicon-star" style="color: #FF9400; "></span>
                <?php
            } else {
                ?>
                <span class="glyphicon glyphicon-star" style="color: #D3D3D3;"></span>
                <?php
            }
        }
        ?>
    </h2>
</div>