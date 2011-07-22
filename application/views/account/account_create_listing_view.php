<?php
    $form_address = '#';
?>

<div id="content">
    <h1>List an Item</h1>
    <p>Complete the form below to add a listing to our marketplace.</p>
    
    <?= form_open($form_address, array('class' => 'form-content', 'id' => 'add_listing')); ?>  
    <!-- IF ADMIN THEN SHOW THIS AREA -->
        <?= form_fieldset('Client Information'); ?>
            <div class="area-form-input">
                <?= form_label('Full Name:','user_fullname') ?>
                <div class="area-form-field">
                        <p>
                            <?= form_input(array('id' => 'user_fullname', 'name' => 'user_fullname', 'value' => set_value('user_fullname'))); ?>
                        </p>
                        <p>
                            <?= form_submit('btn_find_user','Find User'); ?>
                        </p>
                </div>
            </div>
    
            <div class="area-form-input">
                <?= form_label('Existing User:','user_exists') ?>
                <div class="area-form-field">
                        <p>
                            <?= form_radio(array('id' => 'user_exists_yes', 'name' => 'user_exists', 'value' => set_value('user_exists_yes'))); ?>
                            <?= form_label('Yes, this user exists', 'user_exists_yes', array('class' => 'inline-label')); ?>
                        </p>
                        <p>
                            <?= form_radio(array('id' => 'user_exists_no', 'name' => 'user_exists', 'value' => set_value('user_exists_no'))); ?>
                            <?= form_label('No, create a new user', 'user_exists_no', array('class' => 'inline-label')); ?>
                        </p>
                </div>
            </div>

            <div class="area-form-input">
                <?= form_label('Telephone:','user_country_code') ?>
                <div class="area-form-field">
                        <?= form_input(array('readonly' => 'true', 'id' => 'user_country_code', 'name' => 'user_country_code', 'maxlength' => '3', 'value' => set_value('user_country_code'))); ?>
                        <?= form_input(array('id' => 'user_area_code', 'name' => 'user_area_code', 'maxlength' => '3', 'value' => set_value('user_area_code'))); ?>
                        <?= form_input(array('id' => 'user_telephone', 'name' => 'user_telephone', 'maxlength' => '7', 'value' => set_value('user_telephone'))); ?>
                        <?= form_error('user_telephone_number','<p class="error">', '</p>'); ?>
                </div>
            </div>
    
            <div class="area-form-input">
                <?= form_label('Email:','user_email') ?>
                <div class="area-form-field">
                        <p><?= form_input(array('id' => 'user_email', 'name' => 'user_email', 'value' => set_value('user_email'))); ?></p>
                        <?= form_error('user_email','<p class="error">', '</p>'); ?>
                </div>
            </div>
        <?= form_fieldset_close(); ?>
    <!-- END ADMIN AREA -->
    
        <?= form_fieldset('Listing Details') ?>
            <div class="area-form-input">
                <?= form_label('Listing Name:','prod_name') ?>
                <div class="area-form-field">
                        <p><?= form_input(array('id' => 'prod_name', 'name' => 'prod_name', 'value' => set_value('prod_name'))); ?></p>
                        <?= form_error('prod_name','<p class="error">', '</p>'); ?>
                </div>
            </div>
    
            <div class="area-form-input">
                <?= form_label('Keyword:','prod_keyword') ?>
                <div class="area-form-field">
                        <p><?= form_input(array('id' => 'prod_keyword', 'name' => 'prod_keyword', 'value' => set_value('prod_keyword'))); ?></p>
                        <p>Enter one word/phrase (ONLY) that best describes your listing.</p>
                        <?= form_error('prod_keyword','<p class="error">', '</p>'); ?>
                </div>
            </div>
    
            <div class="area-form-input">
                <?= form_label('Category:','listing_category') ?>
                <div class="area-form-field">
                       <?php
                            $all_categories = '';
                            foreach($categories as $category) {
                                $all_categories[$category->id_category] = $category->name_category;
                            }
                        ?>
                        
                        <p><?= form_dropdown('prod_category', $all_categories); ?></p>
                        <?= form_error('prod_category','<p class="error">', '</p>'); ?>
                </div>
            </div>
    
            <div class="area-form-input">
                <?= form_label('Description:','prod_desc') ?>
                <div class="area-form-field">
                        <p><?= form_textarea(array('id' => 'prod_desc', 'name' => 'prod_desc', 'value' => set_value('prod_desc'))); ?></p>
                        <?= form_error('listing_keyword','<p class="error">', '</p>'); ?>
                </div>
            </div>
    
            <div class="area-form-input">
                <?= form_label('Price:','prod_currency') ?>
                <div class="area-form-field">
                        <?php $currency = array('GYD' => 'GY$', 'USD' => 'US$'); ?>
                        <p><?= form_dropdown('prod_currency', $currency, 'GYD', 'id="prod_currency"'); ?>
                        <?= form_input(array('id' => 'prod_price', 'name' => 'prod_price', 'value' => set_value('prod_price'))); ?></p>
                        <?= form_error('prod_keyword','<p class="error">', '</p>'); ?>
                </div>
            </div>
        <?= form_fieldset_close(); ?>
    
        <?= form_fieldset('Product Image'); ?>
            <div class="area-form-input">
                <?= form_label('Preview:') ?>
                <div class="area-form-field">
                        <p>
                            <?php if($this->session->userdata('img_name')==null) {?>
                                <img alt="no image" src="<?php echo base_url(); ?>assets/img/tlgy_noitem.jpg"/>
                            <?php } else { ?>
                                <img alt="user image" src="<?php echo base_url().'uploads/'.$this->session->userdata('img_name'); ?>"/>
                            <?php } ?>
                        </p>
                </div>
            </div>
            <div class="area-form-input">
                <?= form_label('Upload Photo:','filename') ?>
                <div class="area-form-field">
                        <p><?= form_upload(array('id' => 'filename', 'name' => 'filename', 'value' => set_value('filename'), 'size' => '40')); ?></p>
                        <?= form_error('filename','<p class="error">', '</p>'); ?>
                        <ul class="list-form">
                            <li>If selected image is not desired, you can browse again for another.</li>
                            <li>For our purposes, your image will be resized for optimal loading.</li>
                            <li>Allowed image types include: <em>.jpg, .gif, .png &amp; .bmp</em></li>
                            <li>If no image is available at this time, leave this field blank</li>
                        </ul>
                </div>
            </div>
        <?= form_fieldset_close(); ?>
        <div class="area-form-field">
                <?= form_submit('btn_continue', 'Continue'); ?>
                <?= form_reset('btn_reset', 'Reset'); ?>
	</div>
        
    <?= form_close(); ?>
</div>