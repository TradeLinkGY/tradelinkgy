<div id="content">
    <?php
        $data = array('id' => 'frm');
        echo form_open('auth/account/change_email', $data);
    ?>
        <?= form_fieldset('Change Email Address'); ?>

        <?php if (validation_errors()): ?>
            <div style="color: #f00;"><?= validation_errors(); ?></div>
        <? endif; ?>

        <?php if (isset($msg)): ?>
            <div style="color: #f00;"><?= $msg; ?></div>
        <? endif; ?>

        <div class="area-form-input">
            <?= form_label('Current Email:','user_current_email') ?>
            <div class="area-form-field">
                    <p><?= $user->user_email; ?></p>
            </div>
        </div>

        <div class="area-form-input">
            <?= form_label('New Email:','user_email') ?>
            <div class="area-form-field">
                    <p><?= form_input(array('id' => 'user_email', 'name' => 'user_email', 'value' => set_value('user_email'))); ?></p>
            </div>
        </div>

        <div class="area-form-input">
            <?= form_label('Confirm Email:','user_confemail') ?>
            <div class="area-form-field">
                    <p><?= form_input(array('id' => 'user_confemail', 'name' => 'user_confemail', 'value' => set_value('user_confemail'))); ?></p>
            </div>
        </div>

        <?= form_fieldset_close(); ?>
            
        <div class="area-form-field">
                <?= form_submit('btn_change_email', 'Change Email'); ?>
        </div>            
        
    <?= form_close(); ?>

</div>
