<?php 
    $current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar-widget">
    <h3 class="sidebar-widget-heading">About Punjab Insurance</h3>
    <ul class="sidebar-links-list cic-links-list">

        <li class="<?php echo ($current_page == 'our-history.php') ? 'active' : ''; ?>">
            <a href="our-history.php">Our History</a>
        </li>

        <li class="<?php echo ($current_page == 'business-ownership.php') ? 'active' : ''; ?>">
            <a href="business-ownership.php">Business Ownership</a>
        </li>

        <li class="<?php echo ($current_page == 'companies-we-represent.php') ? 'active' : ''; ?>">
            <a href="companies-we-represent.php">Companies We Represent</a>
        </li>

        <li class="<?php echo ($current_page == 'media-center-press-release.php') ? 'active' : ''; ?>">
            <a href="media-center-press-release.php">Media Center/Press Release</a>
        </li>

        <li class="<?php echo ($current_page == 'photo-gallery.php') ? 'active' : ''; ?>">
            <a href="photo-gallery.php">Photo Gallery</a>
        </li>

        <li class="<?php echo ($current_page == 'our-commercials.php') ? 'active' : ''; ?>">
            <a href="our-commercials.php">Our Commercials</a>
        </li>
    </ul>
</div>