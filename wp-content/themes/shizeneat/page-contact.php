<?php
/*
Template Name: Contact Page
*/

if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
	?>

	<main id="main">

        <section class="contact-lead-section">
            <div class="container">
                <div class="content-in">
                    <div class="section-title">
                        <h3 class="lead">
                            <img class="left" src="<?php echo T_DIRE_URI; ?>/assets/img/contact/contact-ttl-1.png" alt="お問合せフォーム">
                            <span>お問合せフォーム</span>
                            <img class="right" src="<?php echo T_DIRE_URI; ?>/assets/img/contact/contact-ttl-2.png" alt="お問合せフォーム">
                        </h3>
                    </div>
					<div class="section-desc">当サイトのご利用方法や農業体験に関するご質問がありましたら、こちらよりお問い合わせください。</div>
                    <div class="section-content">
                        <?php echo do_shortcode('[contact-form-7 id="81" title="お問合せフォーム"]'); ?>
                    </div>
                </div>
            </div>
        </section>
		
	</main>

	<?php
		endwhile;
	endif;
	?>

<?php get_footer();?>
