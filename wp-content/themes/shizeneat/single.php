<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
	?>

	<?php get_template_part('template', 'parts/firstview'); ?>

	<?php get_template_part('template', 'parts/breadcrumbs'); ?>

	<main id="single">

		<section class="p-lead-section">
			<div class="container">
				<article class="p-archive-single">
					<time class="single-date"><?php the_time("Y.m.d"); ?></time>
					<h3 class="single-title"><?php the_title(); ?></h3>
					<?php if( has_post_thumbnail() ): ?>
						<figure class="single-thumb">
							<?php the_post_thumbnail("full"); ?>
						</figure>
					<?php endif; ?>
					<div class="single-share">
						<?php wp_get_share_btns(); ?>
					</div>
					<div class="blog-content"><?php the_content(); ?></div>
				</article>
				<div class="single-pagination">
					<?php if( previous_post_link( "%link" ,'&lt;前へ' ,$in_same_cat = true) ) : ?><?php endif ; ?>
					<?php if( next_post_link( "%link" ,'次へ&gt;' ,$in_same_cat = true) ) : ?><?php endif ; ?>
				</div>
			</div>
		</section>

		<?php get_template_part('template', 'parts/banner'); ?>
		
	</main>

	<?php
		endwhile;
	endif;
	?>

<?php get_footer();?>
