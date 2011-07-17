<div id="content">
    <?php
        $data = array('id' => 'frm');
        echo form_open('auth/account/change_password', $data);
    ?>
        <?= form_fieldset('Change Password'); ?>

        <?php if (validation_errors()): ?>
            <div style="color: #f00;"><?= validation_errors(); ?></div>
        <? endif; ?>

        <?php if (isset($msg)): ?>
            <div style="color: #f00;"><?= $msg; ?></div>
        <? endif; ?>

        <div class="area-form-input">
            <?= form_label('Current Password:','user_current_password') ?>
            <div class="area-form-field">
                    <p><?= form_password(array('id' => 'user_current_password', 'name' => 'user_current_password')); ?></p>
            </div>
        </div>

        <div class="area-form-input">
            <?= form_label('New Email:','password') ?>
            <div class="area-form-field">
                    <p><?= form_password(array('id' => 'password', 'name' => 'password')); ?></p>
            </div>
        </div>

        <div class="area-form-input">
            <?= form_label('Confirm Email:','passwordconf') ?>
            <div class="area-form-field">
                    <p><?= form_password(array('id' => 'passwordconf', 'name' => 'passwordconf')); ?></p>
            </div>
        </div>

        <?= form_fieldset_close(); ?>
            
        <div class="area-form-field">
                    <?= form_submit('btn_change_pwd', 'Change Password'); ?>
        </div>            
        
    <?= form_close(); ?>

</div>