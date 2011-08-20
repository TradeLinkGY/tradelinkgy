<div id="secondary" class="clearfix">
    <div class="area-secondary">
        <h2>Manage Account</h2>
        <ul id="category">
            <li><?php echo anchor('auth/account/basic', 'Personal Information'); ?></li>
            <li><?php echo anchor('auth/account/change_password', 'Change Password'); ?></li>
            <li><?php echo anchor('auth/account/change_email', 'Change Email Address'); ?></li>
        </ul>
    </div>
    <div class="area-secondary">
        <h2>Manage Listings</h2>
        <ul id="category">
            <li><?php echo anchor('listings/insert_listing', 'Create Listing'); ?></li>
            <li><?php echo anchor('auth/account/my_listings', 'Review Listings'); ?></li>
        </ul>
    </div>
</div>