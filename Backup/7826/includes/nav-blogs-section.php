<?php
// ================================
// STANDALONE API FETCH FOR MENU
// ================================
// Check if data is already fetched to avoid multiple API calls
if (!isset($global_nav_blogs)) {
    
    $nav_api_url = "https://blog.punjabinsurance.ca/wp-json/wp/v2/posts?_embed&per_page=5";
    $nav_response = false;

    // Use cURL for fast and reliable fetching
    if (function_exists('curl_init')) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $nav_api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5); // 5 sec timeout to avoid slowing down website
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $nav_response = curl_exec($ch);
        curl_close($ch);
    } else {
        // Fallback if cURL is disabled
        $nav_response = @file_get_contents($nav_api_url);
    }

    // Decode JSON if response is valid
    if ($nav_response) {
        $global_nav_blogs = json_decode($nav_response);
    } else {
        $global_nav_blogs = [];
    }
}

// Ensure dynamic $base_url is available in this scope
if (!isset($base_url)) {
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https://" : "http://";
    $base_url = $protocol . $_SERVER['HTTP_HOST'] . "/";
}
?>

<div class="meganav-blogs">
    <h4 class="mega-content-heading">Learning Center</h4>
    <div class="owl-carousel meganav-blogs-carousel">
        
        <?php if (!empty($global_nav_blogs) && !isset($global_nav_blogs->code)): foreach ($global_nav_blogs as $post): 
            $b_slug = $post->slug ?? '';
            $b_title = $post->title->rendered ?? '';
            $b_date = isset($post->date) ? date("F j, Y", strtotime($post->date)) : '';
            
            // Featured Image with fallback
            $b_img = $post->_embedded->{'wp:featuredmedia'}[0]->source_url ?? $base_url . 'images/default-blog.webp';
            
            // Author Data (Name & Image)
            $b_author_name = $post->_embedded->author[0]->name ?? 'Team Punjab Insurance';
            $b_author_img = $post->_embedded->author[0]->avatar_urls->{'48'} ?? $base_url . 'images/avatar-face1.webp';
            
            // Categories
            $b_cats = $post->_embedded->{'wp:term'}[0] ?? [];
        ?>
        
        <div class="item">
            <div class="blog-card">
                <div class="blog-thumb">
                    <a href="<?= $base_url ?>blog/<?= $b_slug ?>">
                        <img src="<?= $b_img ?>" alt="<?= htmlspecialchars(strip_tags($b_title)) ?>" style="width: 100%; height: 100px; object-fit: cover;">
                    </a>
                </div>
                
                <div class="blog-thumb-content">
                    <div class="blog-thumb-category-chips">
                        <?php 
                        if (!empty($b_cats)) {
                            $cat_count = 0;
                            foreach ($b_cats as $cat) {
                                if ($cat_count >= 2) break; // Maximum 2 categories dikhane ke liye
                                $cat_name = $cat->name ?? 'Blog';
                                $cat_slug = $cat->slug ?? '';
                                echo '<a href="'.$base_url.'blog/category/'.$cat_slug.'" class="blog-category-chip">'.htmlspecialchars($cat_name).'</a>';
                                $cat_count++;
                            }
                        } else {
                            echo '<a href="'.$base_url.'blogs" class="blog-category-chip">Blog</a>';
                        }
                        ?>
                    </div>
                    
                    <h3 class="blog-thumb-title">
                        <a href="<?= $base_url ?>blog/<?= $b_slug ?>"><?= strip_tags($b_title) ?></a>
                    </h3>
                    
                    <div class="blog-thumb-meta">
                        <div class="blog-thumb-author">
                            <img src="<?= $b_author_img ?>" alt="<?= htmlspecialchars($b_author_name) ?>">
                            <span><?= htmlspecialchars($b_author_name) ?></span>
                        </div>
                        <div class="blog-thumb-date">
                            <img src="<?= $base_url ?>images/icons/calendar.svg" width="15" alt="Calendar Icon">
                            <span><?= $b_date ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php endforeach; else: ?>
            <p style="padding: 15px; color: #666;">No recent blogs found.</p>
        <?php endif; ?>
        
    </div>
</div>