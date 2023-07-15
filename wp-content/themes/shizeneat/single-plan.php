<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
	?>
	<main id="main">
        <section class="apply-lead-section">
            <div class="container">
                <div class="content-in">
                    <div class="section-title">
                        <h3 class="lead">
                            <img class="left" src="<?php echo T_DIRE_URI; ?>/assets/img/plan/plan-ttl-1.png" alt="募集中の体験のお申し込み">
                            <span>募集中の体験の<br class="sp">お申し込み</span>
                            <img class="right" src="<?php echo T_DIRE_URI; ?>/assets/img/plan/plan-ttl-2.png" alt="募集中の体験のお申し込み">
                        </h3>
                    </div>
                    <div class="section-content">
                        <div class="detail-block-box">
                            <figure class="thumb">
                                <?php if( has_post_thumbnail() ): ?>
									<?php the_post_thumbnail("plan-thumb"); ?>
								<?php else: ?>
									<img src="<?php echo catch_that_image(); ?>" alt="<?php the_title(); ?>">
								<?php endif; ?>
                            </figure>
                            <div class="wrap">
                                <div class="content">
                                    <?php 
                                    $farm_id = get_field('farms') ? get_field('farms') : 0;
                                    if( $farm_id ) {
                                        $farm_title = get_the_title($farm_id);
                                        $farm_prefs = get_the_terms($farm_id, 'pref');
                                        $farm_address_str = "";
                                        if( !empty( $farm_prefs ) ) {
                                            foreach ($farm_prefs as $farm_pref) {
                                                if( $farm_pref->parent > 0 ) {
                                                    $farm_address_str .= $farm_pref->name;
                                                    break;
                                                }
                                            }
                                        }
                                        if( get_field('address', $farm_id) ) {
                                            $farm_address_str .= get_field('address', $farm_id);
                                        }
                                        
                                    ?>
                                    <div class="title">
                                        <h4><?php echo $farm_title; ?></h4>
                                        <?php if( $farm_address_str ) : ?>
                                        <p><?php echo $farm_address_str; ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php } ?>
                                    <div class="sub">
                                        <h4><?php the_title(); ?></h4>
                                        <p><?php the_field('overview'); ?></p>
                                    </div>
                                    <div class="meta">
                                        <ul class="list">
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
                                    <p class="price"><small>おとな１人</small><strong><?php echo number_format( get_field('price') ); ?></strong><b>円</b>（税込）/日/泊</p>
                                </div>
                                <div class="schedules">
                                    <h3 class="head">
                                            <img class="left" src="<?php echo T_DIRE_URI; ?>/assets/img/plan/plan-ttl-1.png" alt="体験プラン開始日の選択">
                                            <span>体験プラン開始日の選択</span>
                                    </h3>
                                    <h4 class="label">カレンダーから開始日を選択してください</h4>
                                    <p class="selected-label" style="display: none;">選択した開始日：<span></span></p>
                                    <?php 
                                        $holiday_days = [];
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
                                                    $temp_interval = $started_date->diff($ended_date);
                                                    $temp_days = $temp_interval->days;
                                                    for ($i = 0; $i <= (int)$temp_days; $i++) {
                                                        $holiday_days[] = $started_date->format('Y-m-d');
                                                        $started_date->add(new DateInterval('P1D'));
                                                    }
                                                } else {
                                                    $temp_str = $started_date->format('n月j日');
                                                    $holiday_days[] = $started_date->format('Y-m-d');
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
                                            <?php if( $holiday_days_str ) : ?>
                                            <li>
                                                <p class="name">開催不可日</p>
                                                <p class="text"><?php echo $holiday_days_str; ?></p>
                                            </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <?php 
                                        $date1 = new DateTime((new DateTime($plan_started_at))->format('Y-m'));
                                        $date2 = new DateTime((new DateTime($plan_ended_at))->format('Y-m'));

                                        $interval = $date1->diff($date2);
                                        $months = ($interval->y * 12) + $interval->m;

                                        $year = date('Y', strtotime($plan_started_at));
                                        $month = date('m', strtotime($plan_started_at));

                                        $break_days = [];
                                        $date3 = new DateTime( $year . '-' . $month);
                                        for ($i = 0; $i < (int)date('j', strtotime($plan_started_at)) - 1; $i++) {
                                            $break_days[] = $date3->format('Y-m-d');
                                            $date3->add(new DateInterval('P1D'));
                                        }

                                        // $days_in_month = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($plan_ended_at)), date('Y', strtotime($plan_ended_at)));
                                        $days_in_month = $date2->format('t');

                                        
                                        $date4 = new DateTime($plan_ended_at);
                                        for ($i = 0; $i < $days_in_month - (int)date('j', strtotime($plan_ended_at)); $i++) {
                                            $date4->add(new DateInterval('P1D'));
                                            $break_days[] = $date4->format('Y-m-d');
                                        }

                                        if( !empty( $holiday_days ) ) {
                                            $break_days = array_unique( array_merge( $break_days, $holiday_days ) );
                                        }

                                    ?>
                                    <div class="calendar-panel">
                                        <div class="calendar-wrapper">
                                            <div class="swiper calendar-swiper">
                                                <div class="swiper-wrapper">
                                                    <?php
                                                    for ($i = 0; $i <= $months; $i++) {
                                                        $m = ($month + $i) % 12;
                                                        $y = $year + floor(($month + $i - 1) / 12);
                                                        echo '<div class="swiper-slide">' . generateCalendar($m, $y, $break_days) . '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="swiper-button-prev"></div>
                                            <div class="swiper-button-next"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="apply-form-section">
            <div class="container">
                <div class="content-in">
                    <div class="sub-title type1">
                        <h3 class="lead">
                            <img class="left" src="<?php echo T_DIRE_URI; ?>/assets/img/plan/list-ttl-1.png" alt="お申し込み情報">
                            <span>お申し込み情報</span>
                        </h3>
                    </div>
                    <p class="sub-desc">
                            ご希望の開始日をご確認の上、
                            <br class="sp">
                            お申し込み情報を入力して「相談する」をクリックしてください。
                    </p>
                    <p class="start-date" style="display: none;">選択した開始日&nbsp&nbsp&nbsp&nbsp<span>-</span></p>
                    <div class="section-content">
                        <?php echo do_shortcode('[contact-form-7 id="80" title="募集中の体験のお申し込み"]'); ?>
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
if( $plan ) {
add_action('wp_footer', 'custom_script_wp_footer', 1000, 8);
function custom_script_wp_footer() {
?>
<script>
    $(function() {

    $(window).on("load", function(e) {
        e.preventDefault();
        <?php 
            $farm_id = get_field('farms') ? get_field('farms') : 0;
            if( $farm_id ) {
                $farm_title = get_the_title((int)$farm_id);
                $farm_email = get_field('farm_email', (int)$farm_id);
            }
        ?>
        $('.contact-form input[name="your-farm"]').val("<?php echo $farm_title; ?>");
        $('.contact-form input[name="farm-email"]').val("<?php echo $farm_email; ?>");
    });

    $(document).on("click", ".calendar-wrapper .calendar td", function(e) {
        e.preventDefault();
            if( !$(this).hasClass('active') ) {
                $('.detail-block-box .schedules > .label').hide();
                $('.schedules .selected-label').show();
                $('.calendar-wrapper').find('td').removeClass('active');
                $(this).addClass('active');
                $('.schedules .selected-label span').text($(this).data('id'));
                $('.start-date span').text($(this).data('id'));
                $('.contact-form input[name="your-date"]').val($(this).data('id'));
            }
        });
    });
</script>
<?php
}
}
?>

<?php get_footer();?>
