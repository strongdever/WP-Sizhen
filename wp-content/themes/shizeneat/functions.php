<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// サイト情報
define( 'HOME', home_url( '/' ) );
define( 'TITLE', get_option( 'blogname' ) );

// 状態
define( 'IS_ADMIN', is_admin() );
define( 'IS_LOGIN', is_user_logged_in() );
define( 'IS_CUSTOMIZER', is_customize_preview() );

// テーマディレクトリパス
define( 'T_DIRE', get_template_directory() );
define( 'S_DIRE', get_stylesheet_directory() );
define( 'T_DIRE_URI', get_template_directory_uri() );
define( 'S_DIRE_URI', get_stylesheet_directory_uri() );

define( 'THEME_NOTE', 'shizen-eat' );

// define( 'WPCF7_AUTOP', false );

error_reporting(0);

flush_rewrite_rules();

// 固定ページとMW WP Formでビジュアルモードを使用しない
function stop_rich_editor($editor) {
    global $typenow;
    global $post;
    if(in_array($typenow, array('page', 'post', 'mw-wp-form'))) {
        $editor = false;
    }
    return $editor;
}

add_filter('user_can_richedit', 'stop_rich_editor');

// エディター独自スタイル追加
//TinyMCE追加用のスタイルを初期化
if(!function_exists('initialize_tinymce_styles')) {
    function initialize_tinymce_styles($init_array) {
        //追加するスタイルの配列を作成
        $style_formats = array(
            array(
                'title' => '注釈',
                'inline' => 'span',
                'classes' => 'cmn_note'
            )
        );
        //JSONに変換
        $init_array['style_formats'] = json_encode($style_formats);
        return $init_array;
    }
}

add_filter('tiny_mce_before_init', 'initialize_tinymce_styles', 10000);

// オプションページを追加
// if(function_exists('acf_add_options_page')) {
//     $option_page = acf_add_options_page(array(
//         'page_title' => 'テーマオプション', // 設定ページで表示される名前
//         'menu_title' => 'テーマオプション', // ナビに表示される名前
//         'menu_slug' => 'top_setting',
//         'capability' => 'edit_posts',
//         'redirect' => false
//     ));
// }

function my_script_constants() {
?>
    <script type="text/javascript">
        var templateUrl = '<?php echo S_DIRE_URI; ?>';
        var baseSiteUrl = '<?php echo HOME; ?>';
        var themeAjaxUrl = '<?php echo admin_url( 'admin-ajax.php' ) ?>';
    </script>
<?php
}

add_action('wp_head', 'my_script_constants');
// CSS・スクリプトの読み込み
function theme_add_files() {
    global $post;

	wp_enqueue_style('c-font', T_DIRE_URI.'/assets/font/fonts.css', [], '1.0', 'all');
	wp_enqueue_style('c-reset', T_DIRE_URI.'/assets/css/reset.css', [], '1.0', 'all');
    wp_enqueue_style('c-swiper-bundle', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css', [], '1.0', 'all');
    wp_enqueue_style('c-common', T_DIRE_URI.'/assets/css/common.css', [], '1.0', 'all');
    wp_enqueue_style('c-style', T_DIRE_URI.'/assets/css/style.css', [], '1.0', 'all');
    wp_enqueue_style('c-theme', T_DIRE_URI.'/style.css', [], '1.0', 'all');

    // WordPress本体のjquery.jsを読み込まない
    if(!is_admin()) {
        wp_deregister_script('jquery');
    }

    wp_enqueue_script('s-jquery', T_DIRE_URI.'/assets/js/jquery.min.js', [], '1.0', false);
    wp_enqueue_script('s-swiper-bundle', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js', [], '1.0', true);
    wp_enqueue_script('s-fontawesome', 'https://kit.fontawesome.com/8cbdf0a85f.js', [], '6.8.1', true);
    wp_enqueue_script('s-common', T_DIRE_URI.'/assets/js/common.js', [], '1.0', true);
}

add_action('wp_enqueue_scripts', 'theme_add_files');

function add_fontawesome_attributes( $tag, $handle ) {
    if ( 's-fontawesome' === $handle ) {
        return str_replace( 'src', 'crossorigin="anonymous" src', $tag );
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'add_fontawesome_attributes', 10, 2 );

function theme_admin_assets() {

    wp_enqueue_script( 'admin-custom', T_DIRE_URI . '/admin/js/custom.js', array( 'jquery' ) );
}
add_action('admin_enqueue_scripts', 'theme_admin_assets');

function post_menu_remove () { 
    remove_menu_page('edit.php');
}
 
add_action('admin_menu', 'post_menu_remove');

function custom_term_radio_checklist( $args ) {
    if ( ! empty( $args['taxonomy'] ) && $args['taxonomy'] === 'product-type' || $args['taxonomy'] === 'category' ) {
        if ( empty( $args['walker'] ) || is_a( $args['walker'], 'Walker' ) ) { 
            if ( ! class_exists( 'WPSE_139269_Walker_Category_Radio_Checklist' ) ) {
                class WPSE_139269_Walker_Category_Radio_Checklist extends Walker_Category_Checklist {
                    function walk( $elements, $max_depth, ...$args ) {
                        $output = parent::walk( $elements, $max_depth, ...$args );
                        $output = str_replace(
                            array( 'type="checkbox"', "type='checkbox'" ),
                            array( 'type="radio"', "type='radio'" ),
                            $output
                        );

                        return $output;
                    }
                }
            }

            $args['walker'] = new WPSE_139269_Walker_Category_Radio_Checklist;
        }
    }

    return $args;
}

add_filter( 'wp_terms_checklist_args', 'custom_term_radio_checklist' );

function theme_custom_setup() {
    add_theme_support( 'post-thumbnails' );
    add_image_size( "farm-gallery", 600, 400, true );
    add_image_size( "farm-thumb", 266, 183, true );
    add_image_size( "farm-slide", 480, 340, true );
    add_image_size( "plan-thumb", 1080, 450, true );
    add_image_size( "plan-medium", 1200, 300, true );
    set_post_thumbnail_size( 266, 183, true );
    add_editor_style('assets/css/reset.css');
    add_editor_style('assets/css/common.css');
    add_editor_style('assets/css/style.css');
    add_editor_style('editor-style.css');
}

add_action( 'after_setup_theme', 'theme_custom_setup' );

function replaceImagePath( $arg ) {
    $content = str_replace('"images/', '"' . T_DIRE_URI . '/assets/img/', $arg);
    $content = str_replace('"/images/', '"' . T_DIRE_URI . '/assets/img/', $content);
    $content = str_replace(', images/', ', ' . T_DIRE_URI . '/assets/img/', $content);
    $content = str_replace("('images/", "('". T_DIRE_URI . '/assets/img/', $content);
    return $content;
}

add_action('the_content', 'replaceImagePath');

function disable_wp_auto_p( $content ) {
    if ( is_singular( 'page' ) ) {
      remove_filter( 'the_content', 'wpautop' );
    }
    remove_filter( 'the_excerpt', 'wpautop' );
    return $content;
}

add_filter( 'the_content', 'disable_wp_auto_p', 0 );

add_filter('wpcf7_autop_or_not', '__return_false');

add_filter('query_vars', function($vars) {
	$vars[] = 'plan';
    $vars[] = 'farm_id';
    $vars[] = 'pref';
    $vars[] = 'keyword';
    $vars[] = 'key';
    $vars[] = 'period';
    $vars[] = 'min-price';
    $vars[] = 'max-price';
	$vars[] = 'tab';
    $vars[] = 'area';
	return $vars;
});

add_action( 'pre_get_posts', function( $q ) {
    if( $title = $q->get( 'meta_or_title' ) ) {
        add_filter( 'get_meta_sql', function( $sql ) use ( $title ) {
            global $wpdb;

            // Only run once:
            static $nr = 0;
            if( 0 != $nr++ ) return $sql;

            // Modified WHERE
            $sql['where'] = sprintf(
                " AND ( %s OR %s ) ",
                $wpdb->prepare( "{$wpdb->posts}.post_title LIKE BINARY '%%%s%%'", $title),
                mb_substr( $sql['where'], 5, mb_strlen( $sql['where'] ) )
            );

            return $sql;
        });
    }
});

// 検索方式を「LIKE」から「LIKE BINARY」へ変更するコード
function my_posts_where( $where, $query ) {
  $where = str_replace( 'LIKE', 'LIKE BINARY', $where );
  return $where;
}
add_filter( 'posts_where', 'my_posts_where', 10, 2 );

function check_same_title( $title ) {
  global $wpdb;
  $post_title = wp_unslash( sanitize_post_field( 'post_title', $title, 0, 'db' ) );
  $post_id = $wpdb->get_var( $wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE post_title = '{$post_title}'") );
  if($post_id) {
    return (int)$post_id;
  }
  return false;
}

function array_compare_function($a, $b) {
    if ($a===$b) {
        return 0;
    }
    return ($a > $b) ? 1 : -1;
}

add_filter( 'wpcf7_validate_email*', 'custom_email_confirmation_validation_filter', 20, 2 );
  
function custom_email_confirmation_validation_filter( $result, $tag ) {
  if ( 'your-email-confirm' == $tag->name ) {
    $your_email = isset( $_POST['your-email'] ) ? trim( $_POST['your-email'] ) : '';
    $your_email_confirm = isset( $_POST['your-email-confirm'] ) ? trim( $_POST['your-email-confirm'] ) : '';
  
    if ( $your_email != $your_email_confirm ) {
      $result->invalidate( $tag, "これが正しいメールアドレスですか？" );
    }
  }
  
  return $result;
}

add_action( 'wp_footer', 'wpm_redirect_cf7' );
function wpm_redirect_cf7() {
    if ( is_page('contact') ) {
        $thank_you_page =  HOME . 'contact/thanks/';
    } else if ( is_page( 'farm-contact' ) ) {
        $thank_you_page = HOME . 'farm-contact/thanks/';
    } else {
        $thank_you_page = HOME . 'farm-apply/thanks/';
    } ?>
 
    <script type="text/javascript">
    document.addEventListener('wpcf7mailsent', function(event) {
        location = '<?php echo $thank_you_page; ?>';
    }, false);
    </script>
<?php }

function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $post->post_content, $matches);
    $first_img = $matches[1][0];
  
    if(empty($first_img)) {
      $first_img = T_DIRE_URI . "/assets/img/noimage.jpg";
    }
    return $first_img;
  }

//add SVG to allowed file uploads
function add_file_types_to_uploads($file_types){

    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );

    return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');

function generateCalendar($month, $year, $breaks = []) {
    $date = new DateTime($year . '-' . $month);
    $firstDay = date('w', mktime(0, 0, 0, $month, 1, $year));
    $daysInMonth = $date->format('t');
    ob_start();
    ?>
        <table class="calendar">
            <thead>
                <tr>
                    <th colspan="7" class="month"><?php echo $year . '年' . $month . '月'; ?></th>
                </tr>
                <tr>
                    <th class="red">日</th>
                    <th>月</th>
                    <th>火</th>
                    <th>水</th>
                    <th>木</th>
                    <th>金</th>
                    <th class="blue">土</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $dayCount = 1;
                $numWeeks = ceil(($daysInMonth + $firstDay) / 7);
                for ($i = 0; $i < $numWeeks; $i++) {
                    echo '<tr>';
                    for ($j = 0; $j < 7; $j++) {
                        $breakClass= '';
                        if ($dayCount > $daysInMonth) {
                            break;
                        }
                        $dateStr = $date->format('Y-m-d');
                        if (in_array($dateStr, $breaks)) {
                            $breakClass = ' class="old"';
                        }
                        if ($i == 0 && $j < $firstDay) {
                            echo '<td' . $breakClass . ' data-id="' . $date->format('Y年n月j日') . '"></td>';
                        } else {
                            echo '<td' . $breakClass . ' data-id="' . $date->format('Y年n月j日') . '"><div class="day">' . $dayCount . '</div></td>';
                            $date->add(new DateInterval('P1D'));
                            $dayCount++;
                        }
                    }
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

function taxonomy_checklist_checked_ontop_filter ($args) {
    $args['checked_ontop'] = false;
    return $args;
}

add_filter('wp_terms_checklist_args','taxonomy_checklist_checked_ontop_filter');

function new_excerpt_length($length) {
    return 112;
}
add_filter('excerpt_length', 'new_excerpt_length');

function new_excerpt_more($more) {
    return '...';
}

add_filter('excerpt_more', 'new_excerpt_more');

function wp_set_post_views( $postID ) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta( $postID, $count_key, true );

    if( $count == '' ) {
        $count = 0;
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
    } else {
        $count++;
        update_post_meta( $postID, $count_key, $count );
    }
}

function wp_get_post_views( $content ) {
    if ( is_single() ) {
        wp_set_post_views(get_the_ID());
    }
    return $content;
}
add_filter( 'the_content', 'wp_get_post_views' );

add_filter( 'previous_post_link', 'filter_single_post_pagination', 10, 4 );
add_filter( 'next_post_link',     'filter_single_post_pagination', 10, 4 );

function filter_single_post_pagination( $output, $format, $link, $post )
{
    if( $post ) {
        $title = get_the_title( $post );
        $url   = get_permalink( $post->ID );
        
        $class = 'prev-btn';

        if ( 'next_post_link' === current_filter() )
        {
            $class = 'next-btn';
        }
        if( $link ) {
            $text = $link;
        }
        ob_start();
        ?>
        <a href="<?php echo $url; ?>" class="page-btn <?php echo $class; ?>"><span><?php echo $text; ?></span></a>
        <?php
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    return false;
}

function wp_get_share_btns( $post_id = null ) {
    $post_id      = $post_id ? $post_id : get_the_ID();
    $share_title = html_entity_decode( get_the_title( $post_id ) );
    $share_url   = get_permalink( $post_id );
    $share_btns = [
        'twitter' => [
            'title'       => __( 'Twitter', THEME_NOTE ),
            'icon'        => '<i class="fa-brands fa-square-twitter"></i>',
            'href'        => 'https://twitter.com/intent/tweet?url=' .  urlencode( $share_url ) . '&text=' . $share_title . '',
            'class'       => 'twitter-link',
        ],
        'facebook' => [
            'title'       => __( 'Facebook', THEME_NOTE ),
            'icon'        => '<i class="fa-brands fa-square-facebook"></i>',
            'href'        => 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode( $share_url ),
            'class'       => 'facebook-link',
        ],
        'line' => [
            'title'       => __( 'LINE', THEME_NOTE ),
            'icon'        => '<i class="fa-brands fa-line"></i>',
            'href'        => 'https://social-plugins.line.me/lineit/share?url' .  urlencode( $share_url ) . '&text=' . $share_title . '',
            'class'       => 'line-link',
        ],
    ];
    ob_start();
    ?>
    <div class="share-links">
        <span class="label">この記事をシェアする</span>
        <?php foreach ($share_btns as $key => $btn) : ?>
            <a href="<?php echo $btn['href']; ?>" class="<?php echo $btn['class']; ?>">
                <?php echo $btn['icon']; ?>
            </a>
        <?php endforeach; ?>
    </div>
    <?php 
    $output = ob_get_contents();
    ob_end_clean();
    echo $output;
}

function custom_link_btn( $attr ) {

    $args = shortcode_atts( array(
        'link' => '/',
        'text' => 'もっと見る',
    ), $attr );
    
    ob_start();
    $link = $args['link'];
    if (strpos($args['link'], 'http') == false) {
        $link = home_url( $args['link']);
    }
    ?>
    <a href="<?php echo $link; ?>" class="link-btn mx-auto">
        <span><?php echo $args['text'] ?></span>
    </a>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

add_shortcode('link-btn', 'custom_link_btn');

function custom_get_posts( $attr ) {

    $args = shortcode_atts( array(
        'count' => 4,
        'cat' => 0,
        'orderby' => 'post_date',
        'order' => 'DESC',
    ), $attr );
    
    ob_start();

    $post_args = [
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $args['count'],
        'orderby' => $args['orderby'],
        'order' => $args['order'],
    ];

    if( $args['cat'] ) {
        $post_args['tax_query'] = [
            [
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => $args['cat'],
            ]
        ];
    }

    $post_query = new WP_Query( $post_args );

    ?>
    <?php if( $post_query->have_posts() ) : ?>
        <ul class="archive-card-list">
            <?php while( $post_query->have_posts() ) : $post_query->the_post(); ?>
            <li>
                <div class="archive-card">
                    <div class="info-wrap">
                        <a href="<?php the_permalink(); ?>" class="thumb">
                            <?php if( has_post_thumbnail() ): ?>
                                <?php the_post_thumbnail("small"); ?>
                            <?php else: ?>
                                <img src="<?php echo catch_that_image(); ?>" alt="<?php the_title(); ?>">
                            <?php endif; ?>
                        </a>
                        <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    </div>
                    <div class="meta-wrap">
                        <time class="date"><?php the_time("Y.m.d"); ?></time>
                        <a href="<?php the_permalink(); ?>" class="viewmore">
                            <span>View more</span>
                        </a>
                    </div>
                </div>
            </li>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </ul>
        <?php if( $args['cat'] ) : ?>
            <div class="archive-action">
                <a href="<?php get_category_link($args['cat']); ?>" class="link-btn">
                    <span>もっと詳しく見る &gt;</span>
                </a>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

add_shortcode('post-list', 'custom_get_posts');

// function get_farm_email( $attr ) {
//     $farm_emil = get_field('farm_email');
//     return $farm_email;
// }
// add_shortcode('farm_email', 'get_farm_email');

?>