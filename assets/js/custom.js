/*
 * Site specific JavaScript functions.
 */

$(document).ready(function() {
    /*
     * functions from account_password_view.php
     */
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
    
    /*
     * functions from register_view.php
     */
    $('#user_email').blur(function() {
        var user_email = $('#user_email').val();
        $.ajax({
            type: "POST",
            url: '<?php echo base_url()?>index.php/test/ajax_email',
            data: {user_email: user_email},
            success: function(data)
            {
                $('#field-username').replaceWith('');
                if (data) {
                    $('#user_email').after('<p id="field-username" class="error">' + data + '</p>');
                }
            },
            dataType: "json"
        });
    });
    
    $('#user_confpass').blur(function() {
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
    
    /*
     * functions from account_create_listing_view.php
     */
    $('#field-btn-find').hide();

    if ($('#user_exists_no').attr('checked') != 'checked') {
        $('#field-email').hide();
        $('#field-telephone').hide();
        $('#field-country').hide();
    }

    $('#user_exists_yes').change(function() {
        $('#field-email').stop(true, true).hide('slow');
        $('#field-telephone').stop(true, true).hide('slow');
        $('#field-country').stop(true, true).hide('slow');
    })

    $('#user_exists_no').change(function() {
        $('#field-email').stop(true, true).show('slow');
        $('#field-telephone').stop(true, true).show('slow');
        $('#field-country').stop(true, true).show('slow');
    })

    $('#user_fullname').keyup(function() {
        var user_fullname = $('#user_fullname').val();
        var existingUser = $('#user_exists_yes').attr('checked');

        if (existingUser == 'checked') {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url() ?>index.php/listing/ajax_searchusers',
                data: {user_fullname: user_fullname},
                success: function(data)
                {
                    $('#user_fullname').autocomplete({
                        source: data
                    });
                },
                dataType: "json"
            });
        }
    });

    var input = document.getElementById("filename"),
        formdata = false;

    if (window.FormData) {
        formdata = new FormData();
    }

    $('#filename').change(function(){
        var listing_code = $('input[name="listing_code"]').val();
        if (listing_code != '')
        {
            if (formdata) {
                $('#area-form-preview').show();
                document.getElementById("image-preview").innerHTML = "<span>Uploading . . .</span>";
                var i = 0, img, reader, file = this.files[0];

                if (!!file.type.match(/image.*/)) {
                    if (formdata) {
                        formdata.append("filename", file);
                    }
                }

                $.ajax({
                    url: '<?php echo base_url() ?>index.php/test/upload_image/'+listing_code,
                    type: "POST",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        var preview = document.getElementById("image-preview"),
                            img = document.createElement("img");

                        img.src = data;
                        $('#image-preview').empty();
                        preview.appendChild(img);;

                    },
                    dataType: "json"
                });
            }
        };
    });

    $('textarea#prod_desc').ckeditor( function() { /* callback code */ }, { toolbar : 'Basic', uiColor : '#efefef'} );
});