<div id="content">
    <?php
        $data = array('id' => 'frm');
        echo form_open('auth/account/change_password', $data);
    ?>
        <?php echo form_fieldset('Change Password'); ?>

        <?php if (validation_errors()): ?>
            <div style="color: #f00;"><?php echo validation_errors(); ?></div>
        <? endif; ?>

        <?php if (isset($msg)): ?>
            <div style="color: #f00;"><?php echo $msg; ?></div>
        <? endif; ?>

        <div class="area-form-input">
            <?php echo form_label('Current Password:','user_current_password') ?>
            <div class="area-form-field">
                    <p><?php echo form_password(array('id' => 'user_current_password', 'name' => 'user_current_password')); ?></p>
            </div>
        </div>

        <div class="area-form-input">
            <?php echo form_label('New Password:','password') ?>
            <div class="area-form-field">
                    <p><?php echo form_password(array('id' => 'password', 'name' => 'password')); ?></p>
            </div>
        </div>

        <div class="area-form-input">
            <?php echo form_label('Confirm Password:','passwordconf') ?>
            <div class="area-form-field">
                    <p><?php echo form_password(array('id' => 'passwordconf', 'name' => 'passwordconf')); ?></p>
            </div>
        </div>

        <?php echo form_fieldset_close(); ?>
            
        <div class="area-form-field">
                    <?php echo form_submit('btn_change_pwd', 'Change Password'); ?>
        </div>            
        
    <?php echo form_close(); ?>

</div>