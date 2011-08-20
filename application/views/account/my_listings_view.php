<?php 
    $form_address = '';
?>

<div id="content">
    <h1>My Listings</h1>
    <!-- IF ERROR SUBMITTING LIST THEM HERE 
    <p class="error">ERRORS</p>
    -->
    <table id="area-listing-table">
        <?php echo form_open($form_address, array('id' => 'view_listings')); ?>
        <thead>
            <tr>
                <th class="table-listing-checkbox"><?php echo form_checkbox('select_all', 'true', FALSE); ?></th>
                <th class="table-listing-id">ID</th>
                <th class="table-listing-name">Listing Name</th>
                <th class="table-listing-status">Status</th>
                <th class="table-listing-activity">Activity Period</th>
                <th class="table-listing-user">User</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td id="cell-listing-footer" colspan="6">
                    <span>
                    <?php 
                        echo form_submit(array('name' => 'btn_listing_edit', 'class' => 'nomargin'), 'Edit Listing');
                        echo form_submit(array('name' => 'btn_listing_active', 'class' => 'nomargin'), 'Add Image');
                    ?>
                    </span>
                    <span>
                    <?php
                        echo form_submit(array('name' => 'btn_listing_active', 'class' => 'nomargin'), 'Mark as Inactive');
                        echo form_submit(array('name' => 'btn_listing_active', 'class' => 'nomargin'), 'Mark as Active');
                    ?>
                    </span>
                     <?php if (strlen($pagination)): ?>
                        <span class="pagination-link">
                            Pages: <?php echo $pagination; ?>
                        </span>
                    <?php endif; ?>
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php $counter = 0; ?>
            <?php foreach ($listings['rows'] as $row): ?>
            <tr class="listing-<?php echo $row->id_listing; ?>">
                <td class="cell-listing-checkbox"><p><?php echo form_checkbox('listing-number['.$counter++.']', $row->id_listing, FALSE); ?></p></td>
                <td><p><?php echo $row->id_listing ?></p></td>
                <td><p><?php echo anchor('listings/display/'.$row->id_listing,$row->listing_name) ?></p></td>
                <td><p><?php echo $row->listing_status ?></p></td>
                <td class="cell-listing-activity">
                    <p>Created: <?php echo $row->listing_created ?></p>
                    <p>Expiring: <?php if (is_null($row->listing_expiry)) echo "Never"; else echo $row->listing_expiry; ?></p>
                </td>
                <td>
                    &nbsp;
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</div>

<script type="text/javascript">
$(document).ready(function() {
    
    $('input[name|="listing"]').change(function() {
        var listings = $('input[name|="listing"]').length;
        var selected = $('input[name|="listing"]:checked').length;
        
        if ($(this).attr('checked') === 'checked') {
            $(this).closest('tr').css('background-color','#efefef');
            if (selected === listings) {
                $('input[name="select_all"]').attr('checked', 'checked').css('opacity','1');
            }
            else {
                $('input[name="select_all"]').attr('checked', 'checked').css('opacity','0.5');
            }
        }
        else {
            $(this).closest('tr').css('background-color','#fff');
            if (selected === 0) {
                $('input[name="select_all"]').removeAttr('checked', 'checked').css('opacity','1');
            }
            else  {
                $('input[name="select_all"]').css('opacity','0.5');
            }
        }
    });
    
    $('input[name="select_all"]').change(function() {
        if ($(this).attr('checked') == 'checked') {
            $('input[name|="listing"]').attr('checked', 'checked');
            $('input[name|="listing"]').closest('tr').css('background-color','#efefef');
        }
        else {
            $('input[name|="listing"]').removeAttr('checked');
            $('input[name|="listing"]').closest('tr').css('background-color','#fff');
            $(this).css('opacity','1');
        }
    });
    
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