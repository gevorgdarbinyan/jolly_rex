<div>
    <h1 class="entertaner-page-heading"><?= $userData['name'] ?></h1>
</div>
<div>
    <h2>
        <?php
        $userRating = $userData['rating'];
        for ($i = 0; $i < 5; $i++) {
            if ($i < $userRating) {
                ?>
                <span class="glyphicon glyphicon-star" style="color: #FF9400; font-size: 21px;"></span>
                <?php
            } else {
                ?>
                <span class="glyphicon glyphicon-star" style="color: #D3D3D3; font-size: 21px;"></span>
                <?php
            }
        }
        ?>
    </h2>
</div>