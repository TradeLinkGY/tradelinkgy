<?php
$title = 'TradeLinkGY.com | Your Premier Listings Resource'; // REPLACE with page title per page
$counter = 0;
?>

<div id="content">
    <h2>"<?= $search_str; ?>"</h2>
    <p>Found <?=$search_items['num_rows'];?> listing<?php if($search_items['num_rows']!=1):?>s<?endif;?> matching your criteria.</p>
    
    <div class="area-listing-holder">

        <?php foreach ($search_items['rows'] as $row): ?>
            <?php
            $image = 'tlgy_noitem.jpg';
            if (isset($row->name_image))
                $image = $row->name_image;
            ?>

            <div class="area-listing-search clearfix">
                <?php echo (anchor($links['link_listing'], '<img alt="' . $row->listing_desc . '" class="image-listing" src="' . $links['img_dir'] . $image . '" width="230" height="160" />')); ?>
                <div class="listing-search">
                    <h3><?php echo (anchor($links['link_listing'] . $row->id_listing, $row->listing_name)); ?></h3>
                    <h4>Price: <?php echo($row->listing_price); ?></h4>
                    <p><?php echo($row->listing_location); ?></p>
                    <p>Posted <?php echo $row->listing_created; ?></p>
                </div>
            </div>

        <?php endforeach; ?>
        
        <?php $counter = 0; ?>
    </div>
</div>


<div id="secondary" class="clearfix">
    <div class="area-secondary">
        <h2>Categories</h2>
        <ul id="category">
            <?php
            foreach ($categories as $row) {
                echo ('<li>' . anchor($links['link_category'] . $row->id_category, $row->name_category) . '</li>');
            }
            ?>
        </ul>
    </div>
</div>