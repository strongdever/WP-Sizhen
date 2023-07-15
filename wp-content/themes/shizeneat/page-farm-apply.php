<?php
/*
Template Name: Farm Apply Page
*/

if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$farm_id = get_query_var('farm_id') ? (int)get_query_var('farm_id') : 0;
if( $farm_id ) {
    $farm_data = get_post($farm_id, 'farm');
    $farm_title = $farm_data->post_title;
?>
    <input type="hidden" name="farm-title" id="farm-title" value="<?php echo $farm_title; ?>">
<?php
}
?>

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
	?>

	<main id="main">
        <section class="faq-lead-section">
            <div class="container">
                <div class="content-in">
                    <div class="section-title">
                        <h3 class="lead">
                            <img class="left" src="<?php echo T_DIRE_URI; ?>/assets/img/plan/plan-ttl-1.png" alt="農場詳細">
                            <span>農場への<br class="sp">質問やお問い合わせ</span>
                            <img class="right" src="<?php echo T_DIRE_URI; ?>/assets/img/plan/plan-ttl-2.png" alt="農場詳細">
                        </h3>
                    </div>
                    <div class="section-desc">プランのご相談以外で農場へのご質問がある場合には、こちらからお問い合わせください。</div>
                    <div class="section-content">
                        <?php echo do_shortcode('[contact-form-7 id="5" title="農場への質問やお問い合わせ"]'); ?>
                    </div>
                </div>
            </div>
        </section>
		
	</main>

	<?php
		endwhile;
	endif;
	?>

<?php
if( $farm_id ) {
    add_action('wp_footer', 'custom_script_wp_footer', 1000, 8);
    function custom_script_wp_footer() {
    ?>
    <script>
        $(function() {
            var farmTitle = $('#farm-title').val();
            $(window).on("load", function(e) {
                e.preventDefault();
                $('.contact-form input[name="your-farm"]').val(farmTitle);
            });
        });
    </script>
    <?php
    }
}
?>
<?php get_footer();?>
