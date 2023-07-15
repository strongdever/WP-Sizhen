<?php

if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$paged = get_query_var('paged') ? get_query_var('paged') : 1;
?>

	<main id="main">
        <section class="detail-list-section">
            <div class="container">
                <div class="content-in">
                    <div class="sub-title type1">
                        <h3 class="lead">
                            <img class="left" src="<?php echo T_DIRE_URI; ?>/assets/img/plan/list-ttl-1.png" alt="プラン一覧">
                            <span>プラン一覧</span>
                        </h3>
                    </div>
                    <div class="section-content">
                        <?php
                			$plan_args = [
                				'post_type' => 'plan',
                				'post_status' => 'publish',
                				'posts_per_page' => -1,
                				'orderby' => 'post_date',
                				'order' => "DESC",
                			];
                            
                		?>
                        <?php $plan_query = new WP_Query( $plan_args ); ?>
                        <?php if( $plan_query->have_posts() ) : ?>
                        <ul class="detail-block-list">
                            <?php while ( $plan_query->have_posts() ) : $plan_query->the_post(); ?>
                                <?php 
                                    $holding_period = get_field('holding_period');
                                    $holding_date_str = '<strong>' . (new DateTime($holding_period['started_at']))->format('n月j日') . '～' . (new DateTime($holding_period['ended_at']))->format('n月j日') . '</strong>';
                                    if( have_rows('unavailable_period') ) {
                                        $holding_date_str .= '※開催不可日　';
                                        $count = 0;
                                        while ( have_rows('unavailable_period') ) { 
                                            the_row();
                                            $started_date = new DateTime(get_sub_field('started_at'));
                                            $temp_str = "";
                                            if( get_sub_field('ended_at') ) {
                                                $ended_date = new DateTime(get_sub_field('ended_at'));
                                                $holding_date_str .= $started_date->format('n月j日') . '～' . $ended_date->format('n月j日');
                                            } else {
                                                $holding_date_str .= $started_date->format('n月j日');
                                            }
                                            if( $count == 0 ) {
                                                $holding_date_str .= $temp_str;
                                            } else {
                                                $holding_date_str .= '、' . $temp_str;
                                            }
                                        }
                                    }
                                ?>
                                <li>
                                    <div class="detail-block-item">
                                        <figure class="thumb">
                                            <?php if( has_post_thumbnail() ): ?>
												<?php the_post_thumbnail("plan-thumb"); ?>
											<?php else: ?>
												<img src="<?php echo catch_that_image(); ?>" alt="<?php the_title(); ?>">
											<?php endif; ?>
                                        </figure>
                                        <div class="wrap">
                                            <div class="content">
                                                <h4 class="title"><?php the_title(); ?></h4>
                                                <?php if( get_field('overview') ) : ?>
                                                <p class="desc"><?php the_field('overview'); ?></p>
                                                <?php endif; ?>
                                            </div>
                                            <div class="meta">
                                                <ul class="list">
                                                    <li>
                                                        <p class="name">開催時期</p>
                                                        <p class="text"><?php echo $holding_date_str; ?></p>
                                                    </li>
                                                    <li>
                                                        <p class="name">費用に含まれるもの</p>
                                                        <p class="text"><?php the_field('includes'); ?></p>
                                                    </li>
                                                    <li>
                                                        <p class="name">ご準備いただくもの</p>
                                                        <p class="text"><?php the_field('prepares'); ?></p>
                                                    </li>
                                                    <li>
                                                        <p class="name">レンタル</p>
                                                        <p class="text"><?php the_field('rents'); ?></p>
                                                    </li>
                                                    <li>
                                                        <p class="name">備考</p>
                                                        <p class="text"><?php the_field('comment'); ?></p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="action">
                                                <p class="price"><small>おとな１人</small><strong><?php echo number_format( get_field('price') ); ?></strong><b>円</b>（税込）/日/泊</p>
                                                <a href="<?php the_permalink(); ?>" class="link-btn">
                                                    <span>このプランを相談する</span>
                                                    <svg class="icon" width="7" height="13" viewBox="0 0 7 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1 1.5L6 6.5L1 11.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                        <?php wp_reset_postdata(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

	</main>

<?php get_footer();?>