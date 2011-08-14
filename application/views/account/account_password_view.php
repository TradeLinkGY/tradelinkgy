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
            <?= form_label('New Password:','password') ?>
            <div class="area-form-field">
                    <p><?= form_password(array('id' => 'password', 'name' => 'password')); ?></p>
            </div>
        </div>

        <div class="area-form-input">
            <?= form_label('Confirm Password:','passwordconf') ?>
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
<script type="text/javascript">
$(document).ready(function() {
    
    $('#passwordconf').blur(function() {
        var user_password = $('#password').val();
        var user_confpass = $('#passwordconf').val();
        $.ajax({
            type: "POST",
            url: '<?php echo base_url()?>index.php/test/ajax_confpass',
            data: {user_password: user_password, user_confpass: user_confpass},
            success: function(data)
            {
                $('#field-password').replaceWith('');
                if (data) {
                    $('#passwordconf').after('<p id="field-password" class="error">' + data + '</p>');
                }
            },
            dataType: "json"
        });
    });

});
</script>