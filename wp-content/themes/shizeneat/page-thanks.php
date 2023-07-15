<?php
/*
Template Name: Thanks Page
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
                    <div class="section-desc">お問い合わせありがとうございました。<br>順次事務局よりご連絡いたしますので、今しばらくお待ちください。</div>
                    <div class="section-content">
                        <a href="<?php echo HOME; ?>" class="link-btn common-btn">
                            <span>トップページに戻る</span>
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
