<?php
    use dosamigos\ckeditor\CKEditorInline;
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="row">
        <h2>Update Personal Info</h2>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php if ($userPhoto) { ?>
                <!--<img src="/common/uploads/customer/<?= $userPhoto['user_id'] . '/' . $userPhoto['photo'] ?>">-->
                <img src="/images/Layer.jpg" style="margin-bottom: 20px;">
            <?php } else { ?>
                <span class="glyphicon glyphicon-picture" style="font-size: 250px; margin-bottom: 20px;"></span>
            <?php } ?>
        </div>
    </div>
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control new_name" value="<?= $userData['name'] ?>">
        <p class="help-block help-block-error"></p>
    </div>
    <div class="form-group">
        <label>First Name</label>
        <input type="text" class="form-control new_first_name" value="<?= $userData['first_name'] ?>">
        <p class="help-block help-block-error"></p>
    </div>
    <div class="form-group">
        <label>Last Name</label>
        <input type="text" class="form-control new_last_name" value="<?= $userData['last_name'] ?>">
        <p class="help-block help-block-error"></p>
    </div>
    <div>
        <label>Support Instant Booking</label>
        <input type="checkbox" class="new_support_instant_booking" <?= ($userData['support_instant_booking']) ? 'checked' : '' ?>>
    </div>
    <div class="form-group">
        <label>Short Description</label>
        <!--<input type="text" class="form-control new_short_description" value="<?= $userData['short_description'] ?>">-->
            <?php CKEditorInline::begin(['preset' => 'basic', 'options' => ['class' => 'new_short_description']]);?>
                <?= $userData['short_description'] ?>
            <?php CKEditorInline::end();?>
        <p class="help-block help-block-error"></p>
    </div>
    <div class="form-group">
        <label>Description</label>
        <!--<textarea type="text" class="form-control new_description">-->
            <?php CKEditorInline::begin(['preset' => 'basic', 'options' => ['class' => 'new_description']]);?>
                <?= $userData['description'] ?>
            <?php CKEditorInline::end();?>
        <!--</textarea>-->
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
        <label>Video</label>
        <input type="text" class="form-control new_video" value="<?= $userData['video'] ?>">
        <p class="help-block help-block-error"></p>
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-primary change_personal_info_request">
            Update Personal Info
        </button>
    </div>
</div>