<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
	?>
	<main id="main">
        <?php $farm_id = get_the_ID(); ?>
        <section class="detail-lead-section">
            <div class="section-title">
                <h3 class="lead">
                    <img class="left" src="<?php echo T_DIRE_URI; ?>/assets/img/plan/plan-ttl-1.png" alt="農場詳細">
                    <span>農場詳細</span>
                    <img class="right" src="<?php echo T_DIRE_URI; ?>/assets/img/plan/plan-ttl-2.png" alt="農場詳細">
                </h3>
            </div>
            <div class="section-content">
                <?php $gallerys = get_field('gallery'); ?>
                <?php if( $gallerys ) : ?>
                    <div class="swiper detail-thumbs-swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($gallerys as $gallery) : ?>
                                <div class="swiper-slide">
                                    <figure class="thumb">
                                        <img src="<?php echo esc_url($gallery['sizes']['farm-gallery']); ?>" alt="<?php echo esc_html($gallery['title'] . $gallery['alt']); ?>">
                                    </figure>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <section class="detail-sub-section">
            <div class="container">
                <div class="content-in">
                    <div class="detail-wrapper clearfix">
                        <div class="wrap">
                            <h3 class="title"><?php the_title(); ?></h3>
                            <div class="sub">
                                <?php 
                                    $crops = get_the_terms( get_the_ID(), 'crop' );
                                    $crops_str = "";
                                    if( !empty( $crops ) ) {
                                        foreach ($crops as $key => $crop) {
                                            if( $key == 0 ) {
                                                $crops_str .= $crop->name;
                                            } else {
                                                $crops_str .= "　" . $crop->name;
                                            }
                                        }
                                    }
                                ?>
                                <?php if( get_field('crop') ) : ?>
                                    <span>収穫物  <?php the_field('crop'); ?></span>
                                <?php endif; ?>
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
                                    <span>所在地 <?php echo $farm_pref_str; ?></span>
                                <?php endif; ?>
                                <?php if( get_field('size') ) : ?>
                                    <span>広さ <?php the_field('size'); ?></span>
                                <?php endif; ?>
                                <?php if( get_field('farm_email') ) : ?>
                                    <span>メールアドレス <?php the_field('farm_email'); ?></span>
                                <?php endif; ?>
                            </div>
                            <?php if( get_field('overview') ) : ?>
                                <p class="desc"><?php the_field('overview'); ?></p>
                            <?php endif; ?>
                            <a href="<?php echo add_query_arg(['farm_id' => get_the_ID()], HOME . 'farm-contact'); ?>" class="outline-btn">
                                <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 2.375C20 1.34375 19.1 0.5 18 0.5H2C0.9 0.5 0 1.34375 0 2.375V13.625C0 14.6562 0.9 15.5 2 15.5H18C19.1 15.5 20 14.6562 20 13.625V2.375ZM18 2.375L10 7.0625L2 2.375H18ZM18 13.625H2V4.25L10 8.9375L18 4.25V13.625Z" fill="#3B8E65"/>
                                </svg>
                                <span>この農場に質問やお問い合わせ</span>
                            </a>
                        </div>
                        <div class="google-map">
                            <iframe src="<?php echo esc_url( get_field('google-map') ); ?>" width="600" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
        <section class="detail-list-section">
            <div class="container">
                <div class="content-in">
                    <div class="sub-title type1">
                        <h3 class="lead">
                            <img class="left" src="<?php echo T_DIRE_URI; ?>/assets/img/plan/list-ttl-1.png" alt="検索結果">
                            <span>プラン一覧</span>
                        </h3>
                    </div>
                    <div class="section-content">
                        <ul class="detail-block-list">
                            <?php while ( $plan_query->have_posts() ) : $plan_query->the_post(); ?>
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
                                            <?php 
                                                $holding_period = get_field('holding_period');
                                                $plan_started_at = $holding_period['started_at'];
                                                $plan_ended_at = $holding_period['ended_at'];
                                                $holiday_days_str = "";
                                                if( have_rows('unavailable_period') ) {
                                                    $count = 0;
                                                    while ( have_rows('unavailable_period') ) { 
                                                        the_row();
                                                        $started_date = new DateTime(get_sub_field('started_at'));
                                                        $temp_str = "";
                                                        if( get_sub_field('ended_at') ) {
                                                            $ended_date = new DateTime(get_sub_field('ended_at'));
                                                            $temp_str = $started_date->format('n月j日') . '～' . $ended_date->format('n月j日');
                                                        } else {
                                                            $temp_str = $started_date->format('n月j日');
                                                        }
                                                        if( $count == 0 ) {
                                                            $holiday_days_str .= $temp_str;
                                                        } else {
                                                            $holiday_days_str .= '、' . $temp_str;
                                                        }
                                                        $count ++;
                                                    }
                                                }
                                            ?>
                                            <div class="meta">
                                                <ul class="list">
                                                    <li>
                                                        <p class="name">開催時期</p>
                                                        <p class="text"><strong><?php echo (new DateTime($plan_started_at))->format('n月j日') . '～' . (new DateTime($plan_ended_at))->format('n月j日'); ?></strong></p>
                                                    </li>
                                                    <li>
                                                        <p class="name">開催不可日</p>
                                                        <p class="text"><?php echo $holiday_days_str; ?></p>
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
                    </div>
                </div>
            </div>
        </section>
        <?php wp_reset_postdata(); ?>
        <?php endif; ?>
		
	</main>

	<?php
		endwhile;
	endif;
	?>

<?php get_footer();?>
