<div id="secondary" class="clearfix">
    <div class="area-secondary">
        <h2>Manage Account</h2>
        <ul id="category">
            <li><?= anchor('auth/account/basic', 'Personal Information'); ?></li>
            <li><?= anchor('auth/account/change_password', 'Change Password'); ?></li>
            <li><?= anchor('auth/account/change_email', 'Change Email Address'); ?></li>
        </ul>
    </div>
    <div class="area-secondary">
        <h2>Manage Listings</h2>
        <ul id="category">
            <li><?= anchor('test/index', 'Create Listing'); ?></li>
            <li><?= anchor('auth/account/my_listings', 'Review Listings'); ?></li>
        </ul>
    </div>
</div>