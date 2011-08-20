<?php
    $title = 'TradeLinkGY.com | Your Premier Listings Resource'; // REPLACE with page title per page
    $counter = 0;
?>

<div id="content" class="clearfix">
    <div class="area-type clearfix">
        <h2>Featured Listings</h2>
        <div class="area-listing-holder">

        <?php foreach ($featured_listings as $row): ?>
            <?php
                $image = 'tlgy_noitem.jpg';
                if (isset($row->name_image))
                    $image = $row->name_image;
            ?>

            <div class="area-listing <?php if (++$counter == 3) echo (" clearfix"); ?>">
                <?php echo(anchor($links['link_listing'], '<img alt="' . $row->listing_name . '" class="image-listing" src="' . $links['img_dir'] . $image . '" width="230" height="160" />')); ?>
                <h3><?php echo(anchor($links['link_listing'] . base64_encode($row->id_listing), $row->listing_name)); ?></h3>
                <?php if ($row->listing_price): ?>
                    <p>Price: <span class="price">$<?php echo $row->listing_price; ?></span></p>
                <?php endif;?>
                <p><?php echo($this->functions->cut_string($row->listing_desc, 30)); ?></p>
                <p class="listing-sub-info"><?php echo ($row->listing_location); ?></p>
                <p class="listing-sub-info">Posted <?php echo substr($row->listing_created, 0, 10); ?></p>
            </div>
        <?php endforeach; ?>

        <?php $counter = 0; ?>
        </div>

        <span class="pagination-link"><?php echo anchor($links['link_listing'].'featured', 'View All Featured &raquo;'); ?></span>
    </div>

    <div class="area-type clearfix">
        <h2>Recent Listings</h2>
        <div class="area-listing-holder">
        <?php foreach ($recent_listings as $row): ?>
            <?php
                $image = 'tlgy_noitem.jpg';
                if (isset($row->name_image))
                    $image = $row->name_image;
            ?>

            <div class="area-listing<?php if (++$counter == 3)
            echo (" clearfix"); ?>">
                <?php echo anchor($links['link_listing'], '<img alt="' . $row->listing_desc . '" class="image-listing" src="' . $links['img_dir'] . $image . '" width="230" height="160" />'); ?>
                <h3><?php echo anchor($links['link_listing'] . base64_encode($row->id_listing), $row->listing_name); ?></h3>
                <?php if ($row->listing_price): ?>
                    <p>Price: <span class="price">$<?php echo $row->listing_price; ?></span></p>
                <?php endif;?>
                <p><?php echo $this->functions->cut_string($row->listing_desc, 30); ?></p>
                <p class="listing-sub-info"><?php echo ($row->listing_location); ?></p>
                <p class="listing-sub-info">Posted <?php echo substr($row->listing_created, 0, 10); ?></p>
            </div>
        <?php endforeach; ?>

        <?php $counter = 0; ?>
        </div>

        <span class="pagination-link"><?php echo anchor($links['link_listing'].'all', 'View All Listings &raquo;'); ?></span>
    </div>
</div>

<div id="secondary" class="clearfix">
    <div class="area-secondary">
        <h2>Browse the Market</h2>
        <ul id="category">
            <?php
                foreach ($categories as $row) {
                    echo ('<li>' . anchor($links['link_category'] . $row->id_category, $row->name_category) . '</li>');
                }
            ?>
        </ul>
    </div>

    <a class="button" href="<?php echo site_url();?>/listings/insert_listing">Add your listing</a>

    <div class="area-secondary">
        <h2>Where do I start?</h2>
        <ul class="area-start">
            <li class="start started">
                <p><a href="#" title="Getting started with TradeLinkGY.com">Getting Started</a></p>
                <p>Introducing Guyana's best deals and widest selection.</p>
            </li>
            <li class="start sell">
                <p><a href="#" title="Learn how to sell items using TradeLinkGY.com">How to sell</a></p>
                <p>Reach the widest audience with your sales.</p>
            </li>
            <li class="start buy">
                <p><a href="#" title="Learn how to buy items using TradeLinkGY.com">How to buy</a></p>
                <p>Take advantage of these incredible offers.</p>
            </li>
        </ul>
    </div>
</div>