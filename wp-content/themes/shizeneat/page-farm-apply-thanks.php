<?php
/*
Template Name: Farm Apply Thanks Page
*/

if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

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
                            <span>お申し込みを受け付けました</span>
                        </h3>
                    </div>
                    <div class="section-desc">体験プランへのお申し込みありがとうございました。<br>農園より、順次ご連絡いたしますので今しばらくお待ちください。</div>
                    <div class="section-content">
                        <a href="<?php echo HOME . 'plan-search/'; ?>" class="link-btn common-btn">
                            <span>農園詳細に戻る</span>
                        </a>
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
