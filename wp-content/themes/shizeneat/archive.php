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
                            <span>検索結果</span>
                        </h3>
                    </div>
                    <div class="section-content">
                        <ul class="plan-block-list">
                            <li>
                                <div class="plan-block-item">
                                    <div class="clearfix">
                                        <figure class="thumb">
                                            <img src="<?php echo T_DIRE_URI; ?>/assets/img/plan/plan-ph.png" alt="">
                                        </figure>
                                        <div class="wrap">
                                            <h4 class="title">高橋農園  コシヒカリ</h4>
                                            <p class="sub">茨城県下妻市唐崎９３２</p>
                                            <p class="desc">都心から車で2時間いないにつく大自然です</p>
                                            <a href="" class="link-btn">
                                                <span>この農場の詳細を見る</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <ul class="list">
                                            <li>
                                                <strong>1日体験ツアー開催　有機無農薬栽培のお野菜や果実</strong>
                                                <small>おとな１人</small>
                                                <span><b>50,000</b>円（税込）/日/泊</span>
                                            </li>
                                            <li>
                                                <strong>1日体験ツアー開催　有機無農薬栽培のお野菜や果実</strong>
                                                <small>おとな１人</small>
                                                <span><b>50,000</b>円（税込）/日/泊</span>
                                            </li>
                                            <li>
                                                <strong>1日体験ツアー開催　有機無農薬栽培のお野菜や果実</strong>
                                                <small>おとな１人</small>
                                                <span><b>50,000</b>円（税込）/日/泊</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="plan-block-item">
                                    <div class="clearfix">
                                        <figure class="thumb">
                                            <img src="<?php echo T_DIRE_URI; ?>/assets/img/plan/plan-ph.png" alt="">
                                        </figure>
                                        <div class="wrap">
                                            <h4 class="title">高橋農園  コシヒカリ</h4>
                                            <p class="sub">茨城県下妻市唐崎９３２</p>
                                            <p class="desc">都心から車で2時間いないにつく大自然です</p>
                                            <a href="" class="link-btn">
                                                <span>この農場の詳細を見る</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <ul class="list">
                                            <li>
                                                <strong>1日体験ツアー開催　有機無農薬栽培のお野菜や果実</strong>
                                                <small>おとな１人</small>
                                                <span><b>50,000</b>円（税込）/日/泊</span>
                                            </li>
                                            <li>
                                                <strong>1日体験ツアー開催　有機無農薬栽培のお野菜や果実</strong>
                                                <small>おとな１人</small>
                                                <span><b>50,000</b>円（税込）/日/泊</span>
                                            </li>
                                            <li>
                                                <strong>1日体験ツアー開催　有機無農薬栽培のお野菜や果実</strong>
                                                <small>おとな１人</small>
                                                <span><b>50,000</b>円（税込）/日/泊</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

	</main>

<?php get_footer();?>