<?php 
    global $post, $wp_query;
    $page_title_jp = "";
    $page_title_en = "";
    if( is_archive() || is_category() ) {
        $last_category = get_queried_object();
    if (!empty($last_category)) {
        $page_title_jp = $last_category->name;
    }
    } elseif ( is_single() ) {
        $last_category = [];
        $query_categories = get_the_category();
        if(!empty($query_categories)) {
            $last_category = $query_categories[0];
        }
        if (!empty($last_category)) {
            $page_title_jp = $last_category->name;
        }
    } elseif ( is_page() ) {
        $page_title_jp = get_the_title();
    } elseif ( is_search() ) {
        $page_title_jp = get_search_query();
    } elseif ( is_404() ) {
        $page_title_jp = "404";
    }

?>

<section class="pageindex">
    <div class="pageindex_wrapper">
        <div class="container">
            <h3 class="pageindex-title">
                <span><?php echo $page_title_jp; ?></span>
                <strong><?php echo $page_title_jp; ?></strong>
            </h3>
        </div>
    </div>
</section>