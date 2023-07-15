<?php
/*
Template Name: Farm Contact Thanks Page
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
                            <span>問い合わせが完了しました</span>
                        </h3>
                    </div>
                    <div class="section-desc">農園へのお問い合わせありがとうございました。<br>農園より、順次ご連絡いたしますので今しばらくお待ちください。</div>
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
