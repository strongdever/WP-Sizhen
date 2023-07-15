<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja" style="margin-top: 0 !important;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta property="og:locale" content="ja_JP">

    <!-- Webpage Title -->
    <title>
        <?php if(is_front_page() || is_home()){
      echo get_bloginfo('name');
    } else{
      wp_title('|',true,'right'); echo bloginfo('name'); 
    }?>
    </title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <?php wp_head(); ?>

</head>

<?php 
  global $post;
  
    if( $post->post_type != "page" ) {
        $post_slug = $post->post_type;
    } else {
        $post_slug = $post->post_name;
    }

    if( is_category() ) {
        $nav_last_category = get_queried_object();
        $post_slug = $nav_last_category->slug;
    }
    if( is_single() ) {
        $nav_last_category = [];
        $nav_query_categories = get_the_category();
        if(!empty($nav_query_categories)) {
            $nav_last_category = $nav_query_categories[0];
        }
        if (!empty($nav_last_category)) {
            $post_slug = $nav_last_category->slug;
        }
    }
?>

<body>

    <header id="header">
        <h1 class="header-logo">
            <a href="<?php echo HOME; ?>">
                <img src="<?php echo T_DIRE_URI; ?>/assets/img/logo.png" alt="<?php echo bloginfo('name'); ?>">
            </a>
        </h1>
        <nav class="header-nav">
            <div class="container">
                <ul class="nav-menu">
                    <li>
                        <a href="<?php echo HOME . 'merit/'; ?>" class="menu-link<?php echo ($post_slug == 'merit') ? ' active' : ''; ?>">
                            <img src="<?php echo T_DIRE_URI; ?>/assets/img/menu-1.png" alt="農業体験のメリット">
                            <span>農業体験のメリット</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo HOME . 'plan-search/'; ?>" class="menu-link<?php echo ($post_slug == 'plan-search') ? ' active' : ''; ?>">
                            <img src="<?php echo T_DIRE_URI; ?>/assets/img/menu-2.png" alt="募集中の体験プラン">
                            <span>募集中の体験プラン</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo HOME . 'usage/'; ?>" class="menu-link<?php echo ($post_slug == 'usage') ? ' active' : ''; ?>">
                            <img src="<?php echo T_DIRE_URI; ?>/assets/img/menu-3.png" alt="活用方法">
                            <span>活用方法</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo HOME . '#terms'; ?>" class="menu-link<?php echo ($post_slug == '#terms') ? ' active' : ''; ?>">
                            <img src="<?php echo T_DIRE_URI; ?>/assets/img/menu-4.png" alt="ご利用方法">
                            <span>ご利用方法</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo HOME . 'contact/'; ?>" class="menu-link<?php echo ($post_slug == 'contact') ? ' active' : ''; ?>">
                            <img src="<?php echo T_DIRE_URI; ?>/assets/img/menu-5.png" alt="お問い合わせ">
                            <span>お問い合わせ</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div id="mobile-nav">
        <nav class="mobile-nav-container">
            <ul class="mobile-nav-menu">
                <li>
                    <a href="<?php echo HOME . 'merit/'; ?>" class="menu-link">
                        <img src="<?php echo T_DIRE_URI; ?>/assets/img/menu-1.png" alt="農業体験のメリット">
                        <span>農業体験のメリット</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo HOME . 'plan-search/'; ?>" class="menu-link">
                        <img src="<?php echo T_DIRE_URI; ?>/assets/img/menu-2.png" alt="募集中の体験プラン">
                        <span>募集中の体験プラン</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo HOME . 'usage/'; ?>" class="menu-link">
                        <img src="<?php echo T_DIRE_URI; ?>/assets/img/menu-3.png" alt="活用方法">
                        <span>活用方法</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo HOME . '#terms'; ?>" class="menu-link">
                        <img src="<?php echo T_DIRE_URI; ?>/assets/img/menu-4.png" alt="ご利用方法">
                        <span>ご利用方法</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo HOME . 'contact/'; ?>" class="menu-link">
                        <img src="<?php echo T_DIRE_URI; ?>/assets/img/menu-5.png" alt="お問い合わせ">
                        <span>お問い合わせ</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>