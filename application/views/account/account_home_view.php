<div id="content">
    <?php
    $data = array('id' => 'frm');
    echo form_open("auth/account/basic", $data);
    ?>

    <h2>Personal Information</h2>

    <?php if (isset($msg)): ?>
        <p class="error"><?= $msg; ?></p>
    <? endif; ?>

    <div class="area-form-input">
        <?= form_label('Full Name:', 'user_fullname') ?>
        <div class="area-form-field">
            <p><?= form_input(array('id' => 'user_fullname', 'name' => 'user_fullname'), $user->user_fullname); ?></p>
            <?= form_error('user_fullname', '<p class="error">', '</p>'); ?>
        </div>
    </div>

    <div class="area-form-input">
        <?= form_label('Email:', 'user_email') ?>
        <div class="area-form-field">
            <p><?= $user->user_email . ' ' . anchor('auth/change_email', 'Change'); ?></p>
        </div>
    </div>

    <div class="area-form-input">
        <?= form_label('Telephone:', 'user_country_code') ?>
        <?php $telephone = $this->functions->parse_telephone($user->user_phone); ?>
        <div class="area-form-field">
            <?= form_input(array('id' => 'user_country_code', 'name' => 'user_country_code', 'maxlength' => '3'), $telephone['country_code']); ?>
            <?= form_input(array('id' => 'user_area_code', 'name' => 'user_area_code', 'maxlength' => '3'), $telephone['area_code']); ?>
            <?= form_input(array('id' => 'user_telephone', 'name' => 'user_telephone', 'maxlength' => '7'), $telephone['number']); ?>
            <?= form_error('user_telephone', '<p class="error">', '</p>'); ?>
        </div>
    </div>

    <div class="area-form-input">
        <?= form_label('Mobile:', 'user_mobile_country_code') ?>
        <?php $mobile = $this->functions->parse_telephone($user->user_mobile); ?>
        <div class="area-form-field">
            <?= form_input(array('id' => 'user_mobile_country_code', 'name' => 'user_mobile_country_code', 'maxlength' => '3'), $mobile['country_code']); ?>
            <?= form_input(array('id' => 'user_mobile_area_code', 'name' => 'user_mobile_area_code', 'maxlength' => '3'), $mobile['area_code']); ?>
            <?= form_input(array('id' => 'user_mobile', 'name' => 'user_mobile', 'maxlength' => '7'), $mobile['number']); ?>
            <?= form_error('user_mobile', '<p class="error">', '</p>'); ?>
        </div>
    </div>

    <div class="area-form-input">
        <?= form_label('Street Address:', 'user_address_street') ?>
        <div class="area-form-field">
            <p><?= form_input(array('id' => 'user_address_street', 'name' => 'user_address_street'), $user->user_address_street); ?></p>
            <?= form_error('user_address_street', '<p class="error">', '</p>'); ?>
            <p><?= form_input(array('id' => 'user_address_secondary', 'name' => 'user_address_secondary'), $user->user_address_secondary); ?></p>
            <?= form_error('user_address_secondary', '<p class="error">', '</p>'); ?>
        </div>
    </div>

    <div class="area-form-input">
        <?= form_label('City:', 'user_address_city') ?>
        <div class="area-form-field">
            <p><?= form_input(array('id' => 'user_address_city', 'name' => 'user_address_city'), $user->user_address_city); ?></p>
            <?= form_error('user_address_city', '<p class="error">', '</p>'); ?>
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
        <?= form_label('Country:', 'user_address_country') ?>
        <div class="area-form-field">
            <p><?= form_dropdown('user_address_country', $countries, $user->user_address_country); ?></p>
            <?= form_error('user_address_country', '<p class="error">', '</p>'); ?>
        </div>
    </div>

    <div class="area-form-field">
        <?= form_submit('btn_register', 'Update'); ?>
    </div>

    <?= form_close(); ?>
</div>