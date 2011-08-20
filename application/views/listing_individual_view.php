<div id="content" class="clearfix">
    <div class="area-type noborder clearfix">
        <h2><?php echo $listing->listing_name; ?></h2>
        <p>Listed in: <?php echo(anchor($links['link_category'], $listing->name_category)); ?> <span>&raquo;</span> sub-category.</p>
        <!-- TEST Line -->
        
        <?php
        isset($listing->name_image) ? $image = $listing->name_image : $image = 'tlgy_noitem.jpg';
        if (isset($listing->name_image)) {
            list($width, $height, $type, $attr) = getimagesize($image);
            echo(anchor($link_imgs, '<img alt="" class="img-listing-item" src="' . $image . '" ' . $attr . ' />'));
        } else {
            echo '<img alt="" class="img-listing-item" src="' . $links['img_dir'] . $image . '" >';
        }
        ?>


        <div class="listing-info">
            <h4>Price: <?php echo($listing->listing_price); ?></h4>
            <p class="listing-label"><span>Summary:</span> <?php echo($listing->listing_name) ?></p>
            <p class="listing-label"><span>Location:</span> <?php echo($listing->listing_location) ?></p>
            <p class="listing-label"><span>Telephone:</span> <?php echo($listing->user_fullname) ?></p>
            <p id="description"><span>Description:</span></p>
            <p><?php echo (str_replace("\n", '</p><p>', $listing->listing_desc)); ?></p>
        </div>
    </div>

</div>

<div id="secondary" class="clearfix">
    <a class="button" href="#">Make an Offer</a>
    <div class="area-secondary">
        <?php
        if ($user['image'] != '') {
            list($width, $height, $type, $attr) = getimagesize($img_dir . $user['image']);
            echo ('<img id="img-profile-pic" alt="user profile pic" src="' . $img_dir . $user['image'] . '" />');
        }
        ?>
        <h4><?php echo($user['name']); ?></h4>
        <p>Contact me if you have any questions</p>
        <p class="listing-active-link"><a href="#">Active Listings (1)</a></p>
        <p><a href="#">View Previous Listings</a></p>
    </div>
</div>

<div id="related-listings" class="clearfix">
    <h2>Related Listings</h2>

    <?php foreach ($related_listings as $listing): ?>

        <div class="area-related-listing">
            <p><span><a href="">Listed item number one</a></span></p>
            <p class="related-listings-price">Price: $15,000</p>
            <p>Georgetown</p>
            <p>Posted 05/06/2011</p>
        </div>
    <?php endforeach; ?>

</div>