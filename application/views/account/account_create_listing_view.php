<?php
    $form_address = '#';
?>

<div id="content">
    <h1>List an Item</h1>
    <p>Complete the form below to add a listing to our marketplace.</p>
    
    <?= form_open($form_address, array('class' => 'form-content', 'id' => 'add_listing')); ?>  
    <!-- IF ADMIN THEN SHOW THIS AREA -->
        <?= form_fieldset('Client Information', array('id' => 'client_info', 'class' => 'dynamic')); ?>
    
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

            <div id="field-fullname" class="area-form-input">
                <?= form_label('Full Name:','user_fullname') ?>
                <div class="area-form-field">
                        <p><?= form_input(array('id' => 'user_fullname', 'name' => 'user_fullname', 'value' => set_value('user_fullname'))); ?></p>
                        <p id="field-btn-find">
                            <?= form_submit('btn_find_user','Find User'); ?>
                        </p>
                </div>
            </div>
    
            <div class="area-form-input">
                <?= form_label('Email:','user_email') ?>
                <div class="area-form-field">
                        <p><?= form_input(array('id' => 'user_email', 'name' => 'user_email', 'value' => set_value('user_email'))); ?></p>
                        <?= form_error('user_email','<p class="error">', '</p>'); ?>
                </div>
            </div>

            <div id="field-telephone" class="area-form-input">
                <?= form_label('Telephone:','user_country_code') ?>
                <div class="area-form-field">
                        <?= form_input(array('readonly' => 'true', 'id' => 'user_country_code', 'name' => 'user_country_code', 'maxlength' => '3', 'value' => set_value('user_country_code'))); ?>
                        <?= form_input(array('id' => 'user_area_code', 'name' => 'user_area_code', 'maxlength' => '3', 'value' => set_value('user_area_code'))); ?>
                        <?= form_input(array('id' => 'user_telephone', 'name' => 'user_telephone', 'maxlength' => '7', 'value' => set_value('user_telephone'))); ?>
                        <?= form_error('user_telephone_number','<p class="error">', '</p>'); ?>
                </div>
            </div>

    <?php
        $countries = array(
            'AF' => 'Afghanistan',
            'AX' => 'Aland Islands',
            'AL' => 'Albania',
            'DZ' => 'Algeria',
            'AS' => 'American Samoa',
            'AD' => 'Andorra',
            'AO' => 'Angola',
            'AI' => 'Anguilla',
            'AQ' => 'Antarctica',
            'AG' => 'Antigua and Barbuda',
            'AR' => 'Argentina',
            'AM' => 'Armenia',
            'AW' => 'Aruba',
            'AU' => 'Australia',
            'AT' => 'Austria',
            'AZ' => 'Azerbaijan',
            'BS' => 'Bahamas',
            'BH' => 'Bahrain',
            'BD' => 'Bangladesh',
            'BB' => 'Barbados',
            'BY' => 'Belarus',
            'BE' => 'Belgium',
            'BZ' => 'Belize',
            'BJ' => 'Benin',
            'BM' => 'Bermuda',
            'BT' => 'Bhutan',
            'BO' => 'Bolivia',
            'BA' => 'Bosnia and Herzegovina',
            'BW' => 'Botswana',
            'BV' => 'Bouvet Island',
            'BR' => 'Brazil',
            'IO' => 'British Indian Ocean Territory',
            'BN' => 'Brunei',
            'BG' => 'Bulgaria',
            'BF' => 'Burkina Faso',
            'BI' => 'Burundi',
            'KH' => 'Cambodia',
            'CM' => 'Cameroon',
            'CA' => 'Canada',
            'CV' => 'Cape Verde',
            'KY' => 'Cayman Islands',
            'CF' => 'Central African Republic',
            'TD' => 'Chad',
            'CL' => 'Chile',
            'CN' => 'China',
            'CX' => 'Christmas Island',
            'CC' => 'Cocos Islands',
            'CO' => 'Colombia',
            'KM' => 'Comoros',
            'CG' => 'Congo',
            'CD' => 'Congo, Democratic Republic of',
            'CK' => 'Cook Islands',
            'CR' => 'Costa Rica',
            'CI' => 'Côte d\'Ivoire',
            'HR' => 'Croatia',
            'CU' => 'Cuba',
            'CY' => 'Cyprus',
            'CZ' => 'Czech Republic',
            'DK' => 'Denmark',
            'DJ' => 'Djibouti',
            'DM' => 'Dominica',
            'DO' => 'Dominican Republic',
            'EC' => 'Ecuador',
            'EG' => 'Egypt',
            'SV' => 'El Salvador',
            'GQ' => 'Equatorial Guinea',
            'ER' => 'Eritrea',
            'EE' => 'Estonia',
            'ET' => 'Ethiopia',
            'FK' => 'Falkland Islands',
            'FO' => 'Faroe Islands',
            'FJ' => 'Fiji',
            'FI' => 'Finland',
            'FR' => 'France',
            'GF' => 'French Guiana',
            'PF' => 'French Polynesia',
            'TF' => 'French Southern Territories',
            'GA' => 'Gabon',
            'GM' => 'Gambia',
            'GE' => 'Georgia',
            'DE' => 'Germany',
            'GH' => 'Ghana',
            'GI' => 'Gibraltar',
            'GR' => 'Greece',
            'GL' => 'Greenland',
            'GD' => 'Grenada',
            'GP' => 'Guadeloupe',
            'GU' => 'Guam',
            'GT' => 'Guatemala',
            'GG' => 'Guernsey',
            'GN' => 'Guinea',
            'GW' => 'Guinea-Bissau',
            'GY' => 'Guyana',
            'HT' => 'Haiti',
            'HM' => 'Heard Island and McDonald Islands',
            'HN' => 'Honduras',
            'HK' => 'Hong Kong',
            'HU' => 'Hungary',
            'IS' => 'Iceland',
            'IN' => 'India',
            'ID' => 'Indonesia',
            'IR' => 'Iran',
            'IQ' => 'Iraq',
            'IE' => 'Ireland',
            'IM' => 'Isle of Man',
            'IL' => 'Israel',
            'IT' => 'Italy',
            'JM' => 'Jamaica',
            'JP' => 'Japan',
            'JE' => 'Jersey',
            'JO' => 'Jordan',
            'KZ' => 'Kazakhstan',
            'KE' => 'Kenya',
            'KI' => 'Kiribati',
            'KW' => 'Kuwait',
            'KG' => 'Kyrgyzstan',
            'LA' => 'Laos',
            'LV' => 'Latvia',
            'LB' => 'Lebanon',
            'LS' => 'Lesotho',
            'LR' => 'Liberia',
            'LY' => 'Libya',
            'LI' => 'Liechtenstein',
            'LT' => 'Lithuania',
            'LU' => 'Luxembourg',
            'MO' => 'Macao',
            'MK' => 'Macedonia',
            'MG' => 'Madagascar',
            'MW' => 'Malawi',
            'MY' => 'Malaysia',
            'MV' => 'Maldives',
            'ML' => 'Mali',
            'MT' => 'Malta',
            'MH' => 'Marshall Islands',
            'MQ' => 'Martinique',
            'MR' => 'Mauritania',
            'MU' => 'Mauritius',
            'YT' => 'Mayotte',
            'MX' => 'Mexico',
            'FM' => 'Micronesia',
            'MD' => 'Moldova',
            'MC' => 'Monaco',
            'MN' => 'Mongolia',
            'ME' => 'Montenegro',
            'MS' => 'Montserrat',
            'MA' => 'Morocco',
            'MZ' => 'Mozambique',
            'MM' => 'Myanmar',
            'NA' => 'Namibia',
            'NR' => 'Nauru',
            'NP' => 'Nepal',
            'NL' => 'Netherlands',
            'AN' => 'Netherlands Antilles',
            'NC' => 'New Caledonia',
            'NZ' => 'New Zealand',
            'NI' => 'Nicaragua',
            'NE' => 'Niger',
            'NG' => 'Nigeria',
            'NU' => 'Niue',
            'NF' => 'Norfolk Island',
            'MP' => 'Northern Mariana Islands',
            'KP' => 'North Korea',
            'NO' => 'Norway',
            'OM' => 'Oman',
            'PK' => 'Pakistan',
            'PW' => 'Palau',
            'PS' => 'Palestinian Territory',
            'PA' => 'Panama',
            'PG' => 'Papua New Guinea',
            'PY' => 'Paraguay',
            'PE' => 'Peru',
            'PH' => 'Philippines',
            'PN' => 'Pitcairn',
            'PL' => 'Poland',
            'PT' => 'Portugal',
            'PR' => 'Puerto Rico',
            'QA' => 'Qatar',
            'RE' => 'Reunion',
            'RO' => 'Romania',
            'RU' => 'Russia',
            'RW' => 'Rwanda',
            'SH' => 'Saint Helena',
            'KN' => 'Saint Kitts and Nevis',
            'LC' => 'Saint Lucia',
            'PM' => 'Saint Pierre and Miquelon',
            'VC' => 'Saint Vincent and the Grenadines',
            'WS' => 'Samoa',
            'SM' => 'San Marino',
            'ST' => 'Sao Tome and Principe',
            'SA' => 'Saudi Arabia',
            'SN' => 'Senegal',
            'RS' => 'Serbia',
            'CS' => 'Serbia and Montenegro',
            'SC' => 'Seychelles',
            'SL' => 'Sierra Leone',
            'SG' => 'Singapore',
            'SK' => 'Slovakia',
            'SI' => 'Slovenia',
            'SB' => 'Solomon Islands',
            'SO' => 'Somalia',
            'ZA' => 'South Africa',
            'GS' => 'South Georgia and South Sandwich Islands',
            'KR' => 'South Korea',
            'ES' => 'Spain',
            'LK' => 'Sri Lanka',
            'SD' => 'Sudan',
            'SR' => 'Suriname',
            'SJ' => 'Svalbard and Jan Mayen',
            'SZ' => 'Swaziland',
            'SE' => 'Sweden',
            'CH' => 'Switzerland',
            'SY' => 'Syria',
            'TW' => 'Taiwan',
            'TJ' => 'Tajikistan',
            'TZ' => 'Tanzania',
            'TH' => 'Thailand',
            'XX_TI' => 'Tibet',
            'TL' => 'Timor-Leste',
            'TG' => 'Togo',
            'TK' => 'Tokelau',
            'TO' => 'Tonga',
            'TT' => 'Trinidad and Tobago',
            'TN' => 'Tunisia',
            'TR' => 'Turkey',
            'TM' => 'Turkmenistan',
            'TC' => 'Turks and Caicos Islands',
            'TV' => 'Tuvalu',
            'UG' => 'Uganda',
            'UA' => 'Ukraine',
            'AE' => 'United Arab Emirates',
            'GB' => 'United Kingdom',
            'US' => 'United States',
            'UM' => 'United States minor outlying islands',
            'UY' => 'Uruguay',
            'UZ' => 'Uzbekistan',
            'VU' => 'Vanuatu',
            'VA' => 'Vatican City',
            'VE' => 'Venezuela',
            'VN' => 'Vietnam',
            'VG' => 'Virgin Islands, British',
            'VI' => 'Virgin Islands, U.S.',
            'WF' => 'Wallis and Futuna',
            'EH' => 'Western Sahara',
            'YE' => 'Yemen',
            'ZM' => 'Zambia',
            'ZW' => 'Zimbabwe'
        );
    ?>
    <div class="area-form-input">
        <?= form_label('Country:','user_address_country') ?>
        <div class="area-form-field">
            <p><?= form_dropdown('user_address_country', $countries, 'GY'); ?></p>
            <?= form_error('user_address_country','<p class="error">', '</p>'); ?>
        </div>
    </div>
        <?= form_fieldset_close(); ?>
    <!-- END ADMIN AREA -->
    
        <?= form_fieldset('Listing Details', array('id' => 'listing_info', 'class' => 'dynamic')) ?>
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
    
        <?= form_fieldset('Product Image', array('id' => 'listing_image', 'class' => 'dynamic')); ?>
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

<script type="text/javascript">
$(document).ready(function() {
    
    $('#field-btn-find').hide();
    
    $('#user_fullname').keyup(function() {
        var user_fullname = $('#user_fullname').val();
        var existingUser = $('#user_exists_yes').attr('checked');
        var existingNames = [];
        if (existingUser == 'checked') {
            $.post('<?php echo base_url()?>index.php/test/ajax_searchusers', { 'user_fullname':user_fullname },
                function(data) {
                    $('#user_fullname').autocomplete({
                            source: data
                    });
                },"json"
            );
        }
    });

});
</script>