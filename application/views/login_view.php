<?php echo validation_errors(); ?>
<?php if(isset($login_err) && $login_err): ?>
    <div>Username/Password combination invalid</div>
<?php endif;?>
    
<?php echo form_open('auth/login', array('class' => 'form-content', 'id' => 'login')); ?>
    <?php echo form_hidden('path', $this->input->get('path')); ?>
    <?php echo form_fieldset('Login to your account'); ?>
    <div class="area-form-input">
        <?php echo form_label('Email:', 'user_email'); ?>
        <div class="area-form-field">
            <p><?php echo form_input(array('id' => 'user_email', 'name' => 'user_email', 'value' => set_value('user_email'))); ?></p>
        </div>
    </div>
    <div class="area-form-input">
        <?php echo form_label('Password:', 'user_password'); ?>
        <div class="area-form-field">
            <p><?php echo form_password(array('id' => 'user_password', 'name' => 'user_password')); ?></p>
        </div>
    </div>
    <div class="area-form-field">
        <p><?php echo form_checkbox(array('id' => 'user_remember', 'name' => 'user_remember', 'value' => 'remember', 'checked' => set_checkbox('user_remember', 'remember', FALSE))); 
            echo form_label('Stay logged in','user_remember', array('class'=>'inline-label')) ?></p></p>
    </div>
    <div class="area-form-input">
        <div class="area-form-field">
            <?php echo form_submit('btn_login', 'Login'); ?>
        </div>
    </div>
    <?php echo form_fieldset_close(); ?>
<?php echo form_close(); ?>
    <h2>Don't have an account?</h2>
    <p> It's free and easy. If you don't already have your account, <?php echo anchor('auth/register','register now'); ?>.</p>