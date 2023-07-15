<?php

if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$paged = get_query_var('paged') ? get_query_var('paged') : 1;
?>

	<main id="main">
        <section class="plan-list-section">
            <div class="container">
                <div class="content-in">
                    <div class="sub-title type1">
                        <h3 class="lead">
                            <img class="left" src="<?php echo T_DIRE_URI; ?>/assets/img/plan/list-ttl-1.png" alt="検索結果">
                            <span>農場一覧</span>
                        </h3>
                    </div>
                    <div class="section-content">
                        <?php
                			$args = [
                				'post_type' => 'farm',
                				'post_status' => 'publish',
                				'posts_per_page' => -1,
                				'orderby' => 'post_date',
                				'order' => "DESC",
                			];
                		?>
                	  	<?php $custom_query = new WP_Query( $args ); ?>
                        <?php if( $custom_query->have_posts() ) : ?>
                        <ul class="plan-block-list">
                            <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
                                <?php $farm_id = get_the_ID(); ?>
                                <li>
                                    <div class="plan-block-item">
                                        <div class="clearfix">
                                            <figure class="thumb">
                                                <?php if( has_post_thumbnail() ): ?>
													<?php the_post_thumbnail("farm-thumb"); ?>
												<?php else: ?>
													<img src="<?php echo catch_that_image(); ?>" alt="<?php the_title(); ?>">
												<?php endif; ?>
                                            </figure>
                                            <div class="wrap">
                                                <h4 class="title"><?php the_title(); ?></h4>
                                                <?php 
                                                    $farm_prefs = get_the_terms(get_the_ID(), 'pref');
                                                    $farm_pref_str = "";
                                                    if( !empty( $farm_prefs ) ) {
                                                        foreach ($farm_prefs as $farm_pref) {
                                                            if( $farm_pref->parent > 0 ) {
                                                                $farm_pref_str .= $farm_pref->name;
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    if( get_field('address') ) {
                                                        $farm_pref_str .= get_field('address');
                                                    }
                                                ?>
                                                <?php if( $farm_pref_str ) : ?>
                                                    <p class="sub"><?php echo $farm_pref_str; ?></p>
                                                <?php endif; ?>
                                                <?php if( get_field('overview') ) : ?>
                                                    <p class="desc"><?php the_field('overview'); ?></p>
                                                <?php endif; ?>
                                                <a href="<?php the_permalink(); ?>" class="link-btn">
                                                    <span>この農場の詳細を見る</span>
                                                </a>
                                            </div>
                                        </div>
                                        <?php
                                			$plan_args = [
                                				'post_type' => 'plan',
                                				'post_status' => 'publish',
                                				'posts_per_page' => -1,
                                				'orderby' => 'post_date',
                                				'order' => "DESC",
                                                'meta_query' => [
                                                    [
                                                        'key' => 'farms',
                                                        'value' => $farm_id,
                                                        'compare' => '==',
                                                        'type' => 'NUMERIC'                                          
                                                    ]
                                                ]
                                			];
                                            
                                		?>

                                	  	<?php $plan_query = new WP_Query( $plan_args ); ?>
                                        <?php if( $plan_query->have_posts() ) : ?>
                                        <div class="data">
                                            <ul class="list">
                                                <?php while ( $plan_query->have_posts() ) : $plan_query->the_post(); ?>
                                                <li>
                                                    <strong><?php the_title(); ?></strong>
                                                    <small>おとな１人</small>
                                                    <span><b><?php echo number_format( get_field('price') ); ?></b>円（税込）/日/泊</span>
                                                </li>
                                                <?php endwhile; ?>
                                            </ul>
                                        </div>
                                        <?php wp_reset_postdata(); ?>
                                        <?php endif; ?>
                                    </div>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                        <?php wp_reset_postdata(); ?>
                        <?php else : ?>
                            <p class="no-data">検索結果がありません。</p>
				        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

	</main>

<?php get_footer();?>