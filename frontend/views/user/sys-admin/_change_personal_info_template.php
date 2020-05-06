<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="row">
        <h2>Update Personal Info</h2>
    </div>
    <form id="personal-data-update" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php if ($userPhoto) { ?>
                <!--<img src="/common/uploads/customer/<?= $userPhoto['user_id'] . '/' . $userPhoto['photo'] ?>">-->
                <img src="/images/Layer.jpg" style="margin-bottom: 20px;">
            <?php } else { ?>
                <span class="glyphicon glyphicon-picture" style="font-size: 250px; margin-bottom: 20px;"></span>
            <?php } ?>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <input type="file" name="customerPhoto" class="customerPhoto">
            </div>
            </div>
        </div>
        <div class="form-group">
            <label>Postal Code</label>
            <input type="text" class="form-control new_postal_code" value="<?= $userData['postal_code'] ?>">
            <p class="help-block help-block-error"></p>
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control new_address" value="<?= $userData['address'] ?>">
            <p class="help-block help-block-error"></p>
        </div>
        <div class="form-group">
            <label>Phone Number</label>
            <input type="text" class="form-control new_phone_number" value="<?= $userData['phone_number'] ?>">
            <p class="help-block help-block-error"></p>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary change_personal_info_request">
                Update Personal Info
            </button>
        </div>
    </form>
</div>