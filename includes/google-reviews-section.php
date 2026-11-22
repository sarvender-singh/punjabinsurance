


<?php
    // Automatically detect current domain (works with http/https, www or non-www)
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
    $domain   = $_SERVER['HTTP_HOST'];
    $widget_url = $protocol . $domain . "/includes/google-reviews-widget.html";
?>

<section class="bg-brand-linear mt-16 lg:mt-20 py-12 lg:py-16 google-review-main">
    <div class="container mx-auto px-4">
        <iframe 
            src="<?= htmlspecialchars($widget_url) ?>" 
            style="width:100%; border:none;" 
            height="600" 
            scrolling="no"
            loading="lazy">
        </iframe>
    </div>
</section>