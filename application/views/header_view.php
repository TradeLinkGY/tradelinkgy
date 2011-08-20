<?php
//VARIABLES
$title = "TradeLinkGY.com | Your Premier Listings Resource"; // REPLACE with page title per page
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo($title); ?></title>
    <?php foreach ($css as $style): ?>
        <link href="<?php echo (base_url()); ?>assets/css/<?php echo ($style); ?>.css" rel="stylesheet" type="text/css" media="screen" />
    <?php endforeach; ?>
    </head>

    <body>
        <div id="wrapper">
            <div id="header">
                <?php echo (anchor('', '<img alt="TradeLinkGY.com logo" src="'.base_url().'assets/img/tlgy_logo-v1.png" width="310" height="70" />', array('title' => 'Return to Homepage', 'id' => 'logo'))); ?>
                <span id="text-account">
                <?php if ($this->session->userdata('uid') == null): ?>
                    <?php echo(anchor('auth/register', 'Register')); ?> | 
                    <?php echo(anchor('auth/login', 'Login')); ?> | 
                    <?php echo(anchor('home/help', 'Help')); ?>
                <?php else: ?>
                    <span><?php echo $this->session->userdata('name'); ?></span> |
                    <?php echo(anchor('auth/account/basic', 'My Account')); ?> |
                    <?php echo(anchor('auth/account/my_listings', 'My Listings')); ?> |
                    <?php echo(anchor('home/help', 'Help')); ?> | 
                    <?php echo(anchor('auth/logout', 'Logout')); ?>
                <?php endif; ?>
                </span>

                <ul id="area-tabs">
                    <li class="area-tabs-selected"><?php echo(anchor('#', 'Products')); ?></li>
                    <li><?php echo(anchor('#', 'Services')); ?></li>
                </ul>
                <?php echo form_open('home/search', array('id' => 'area-search')); ?>
                <label for="keyword">Search:</label>
                <select name="categories">
                    <option value="all">All Categories</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category->id_category ?>" <?php if(isset($search_cat) && $category->id_category==$search_cat) echo 'selected' ?>>
                            <?php echo $category->name_category; ?>
                        </option>
                    <?php endforeach; ?>
                    <?php
                    /* $last = count($categories) - 1;

                      foreach ($categories as $i => $row) {
                      $isFirst = ($i == 0);
                      $isLast = ($i == $last);
                      echo ('<option value="' . $row['value'] . '">' . $row['name'] . '</option>');
                      } */
                    ?>
                </select>
                <input type="text" name="keyword" <?php if(isset($search_str)) echo "value='$search_str'"; ?> />
                <input type="submit" value="Search" />
                <?php echo form_close(); ?>
            </div>
            <div id="area-content" class="clearfix">