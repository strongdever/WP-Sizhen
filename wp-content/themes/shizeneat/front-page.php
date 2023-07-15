<?php

	/*
	Template Name: FrontPage
	*/

	if ( ! defined( 'ABSPATH' ) ) exit;
	get_header();

?>

<main id="main">

    <section class="mainvisual">
        <picture class="mainvisual-bg">
            <source media="(min-width:769px)" srcset="<?php echo T_DIRE_URI; ?>/assets/img/mainvisual.png">
            <source media="(max-width:768px)" srcset="<?php echo T_DIRE_URI; ?>/assets/img/mainvisual.png">
            <img src="<?php echo T_DIRE_URI; ?>/assets/img/mainvisual.png" alt="">
        </picture>
    </section>

    <section class="top-about">
        <div class="container">
            <div class="section-title">
                <h3 class="lead">
                    <span>農業体験とは？</span>
                    <img class="right" src="<?php echo T_DIRE_URI; ?>/assets/img/about-ttl-1.png" alt="農業体験とは？">
                </h3>
            </div>
            <div class="section-content">
                <div class="content-in">
                    <ul class="experience-list">
                        <li>
                            <div class="experience-item">
                                <figure class="image">
                                    <img src="<?php echo T_DIRE_URI; ?>/assets/img/about-ph-1.png" alt="">
                                </figure>
                                <p class="name">米</p>
                            </div>
                        </li>
                        <li>
                            <div class="experience-item">
                                <figure class="image">
                                    <img src="<?php echo T_DIRE_URI; ?>/assets/img/about-ph-2.png" alt="">
                                </figure>
                                <p class="name">野菜</p>
                            </div>
                        </li>
                        <li>
                            <div class="experience-item">
                                <figure class="image">
                                    <img src="<?php echo T_DIRE_URI; ?>/assets/img/about-ph-3.png" alt="">
                                </figure>
                                <p class="name">果物</p>
                            </div>
                        </li>
                        <li>
                            <div class="experience-item">
                                <figure class="image">
                                    <img src="<?php echo T_DIRE_URI; ?>/assets/img/about-ph-4.png" alt="">
                                </figure>
                                <p class="name">山菜</p>
                            </div>
                        </li>
                        <li>
                            <div class="experience-item">
                                <figure class="image">
                                    <img src="<?php echo T_DIRE_URI; ?>/assets/img/about-ph-5.png" alt="">
                                </figure>
                                <p class="name">牧場（酪農）</p>
                            </div>
                        </li>
                    </ul>
                    <div class="experience-intro">
                        <h4 class="lead">自分が食べるものを自分で<br class="sp">育てる、収穫する。</h4>
                        <p class="desc">そんな体験をすることで、きっとご飯がもっとおいしくなる！<br>農業体験では、1日体験から、作物が育つまでの期間を農家と共にするような体験プランを用意しています。</p>
                        <div class="plan-action">
                            <a href="<?php echo HOME . 'plan/'; ?>" class="plan-btn mx-auto">
                                <div class="btn-body">
                                    <span>募集中の体験プランをみる</span>
                                </div>
                                <img class="btn-left" src="<?php echo T_DIRE_URI; ?>/assets/img/plan-btn-1.png" alt="">
                                <img class="btn-right" src="<?php echo T_DIRE_URI; ?>/assets/img/plan-btn-2.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="top-merit">
        <div class="container">
            <div class="content-in">
                <div class="section-title">
                    <h4 class="sup">生命力を養う</h4>
                    <h3 class="lead">
                        <img class="left" src="<?php echo T_DIRE_URI; ?>/assets/img/merit-ttl-1.png" alt="4つのメリット">
                        <span>4つのメリット</span>
                        <img class="right" src="<?php echo T_DIRE_URI; ?>/assets/img/merit-ttl-2.png" alt="4つのメリット">
                    </h3>
                    <p class="sub">農業体験はいいこと、いっぱい！</p>
                </div>
                <div class="section-content">
                    <ul class="merit-block-list">
                        <li>
                            <div class="merit-block-item">
                                <figure class="thumb">
                                    <img src="<?php echo T_DIRE_URI; ?>/assets/img/merit-ph-1.png" alt="">
                                </figure>
                                <div class="content">
                                    <h4 class="title">自然の中でリフレッシュ</h4>
                                    <p class="desc">
                                        自然を体験しながら自ら育てた農作物を食べることは、心と体のリフレッシュになります。自然との共存を体験し、体を動かし食べ物を収穫することは人間本来の活力を取り戻す機会になります。
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="merit-block-item">
                                <figure class="thumb">
                                    <img src="<?php echo T_DIRE_URI; ?>/assets/img/merit-ph-2.png" alt="">
                                </figure>
                                <div class="content">
                                    <h4 class="title">新なた仕事や事業の可能性</h4>
                                    <p class="desc">
                                        農家の仕事を実際に体験してみることで、自身の新しい仕事の可能性、事業の可能性を見出すことができます。実際に農家の方を話を聞きながら、自身の仕事として継続していけそうか判断したり、新規事業の可能性を検討することもできます。
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="merit-block-item">
                                <figure class="thumb">
                                    <img src="<?php echo T_DIRE_URI; ?>/assets/img/merit-ph-3.png" alt="">
                                </figure>
                                <div class="content">
                                    <h4 class="title">お子様の食育に</h4>
                                    <p class="desc">
                                        都会で育つと、畑や田んぼ、山などを普段、間近で見ることができません。農業体験は、普段、食べているものが、どのような環境で、どのように育てられているのかを知ることができます。今までとは違った食への意識や興味を育みます。
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="merit-block-item">
                                <figure class="thumb">
                                    <img src="<?php echo T_DIRE_URI; ?>/assets/img/merit-ph-4.png" alt="">
                                </figure>
                                <div class="content">
                                    <h4 class="title">3世代コミュニケーション</h4>
                                    <p class="desc">
                                        農家は、農作物を育てたり自然と共に生きる知恵を親から子へ伝えながら共有してきます。農業体験を行うことで３世代が共通の話題で会話したり、昔話をしたり、普段とは違ったコミュニケーションが生まれます。
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="merit-action">
                        <a href="<?php echo HOME . 'merit/'; ?>" class="link-btn mx-auto">
                            <span>農業体験のメリットをみる</span>
                            <svg class="icon" width="7" height="13" viewBox="0 0 7 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1.5L6 6.5L1 11.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="top-experience">
        <div class="container">
            <div class="section-title">
                <h3 class="lead">
                    <img class="left" src="<?php echo T_DIRE_URI; ?>/assets/img/experience-ttl-1.png" alt="農業体験の活用方法はいろいろ">
                    <span>農業体験の活用方法<br class="sp">はいろいろ</span>
                </h3>
            </div>
            <div class="section-content">
                <ul class="experiences-list">
                    <li>
                        <div class="experience-item">
                            <figure class="thumb">
                                <img src="<?php echo T_DIRE_URI; ?>/assets/img/experience-ph-1.png" alt="">
                            </figure>
                            <p class="name">家族旅行で、子供の教育</p>
                        </div>
                    </li>
                    <li>
                        <div class="experience-item">
                            <figure class="thumb">
                                <img src="<?php echo T_DIRE_URI; ?>/assets/img/experience-ph-2.png" alt="">
                            </figure>
                            <p class="name">家族旅リフレッシュと研修を兼ねた行で社員旅行の一部に</p>
                        </div>
                    </li>
                    <li>
                        <div class="experience-item">
                            <figure class="thumb">
                                <img src="<?php echo T_DIRE_URI; ?>/assets/img/experience-ph-3.png" alt="">
                            </figure>
                            <p class="name">農家との提携で、新規事業のヒントが得られる</p>
                        </div>
                    </li>
                    <li>
                        <div class="experience-item">
                            <figure class="thumb">
                                <img src="<?php echo T_DIRE_URI; ?>/assets/img/experience-ph-4.png" alt="">
                            </figure>
                            <p class="name">学校の教育旅行</p>
                        </div>
                    </li>
                    <li>
                        <div class="experience-item">
                            <figure class="thumb">
                                <img src="<?php echo T_DIRE_URI; ?>/assets/img/experience-ph-5.png" alt="">
                            </figure>
                            <p class="name">農業を仕事にして、暮らしたい人との出会い</p>
                        </div>
                    </li>
                    <li>
                        <div class="experience-item">
                            <figure class="thumb">
                                <img src="<?php echo T_DIRE_URI; ?>/assets/img/experience-ph-6.png" alt="">
                            </figure>
                            <p class="name">自然がある地域への移住の足がかりに</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <?php
		$farm_args = [
			'post_type' => 'farm',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'orderby' => 'post_date',
			'order' => "DESC",
		];
	?>
    <?php $custom_query = new WP_Query( $farm_args ); ?>
    <?php if( $custom_query->have_posts() ) : ?>
    <section class="top-recommended">
        <div class="section-title">
            <h3 class="lead">
                <img class="left" src="<?php echo T_DIRE_URI; ?>/assets/img/recommend-ttl-1.png" alt="おすすめの農場紹介">
                <span>おすすめの農場紹介</span>
                <img class="right" src="<?php echo T_DIRE_URI; ?>/assets/img/recommend-ttl-2.png" alt="おすすめの農場紹介">
            </h3>
            <p class="sub">ピックアップ農場</p>
        </div>
        <div class="section-content">
            <div class="swiper recommended-swiper">
                <div class="swiper-wrapper">
                    <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
                        <div class="swiper-slide">
                            <div class="recommended-item">
                                <figure class="thumb">
                                    <?php if( has_post_thumbnail() ): ?>
										<?php the_post_thumbnail("farm-slide"); ?>
									<?php else: ?>
										<img src="<?php echo catch_that_image(); ?>" alt="<?php the_title(); ?>">
									<?php endif; ?>
                                </figure>
                                <div class="wrap">
                                    <div class="content">
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
                                        <p class="desc"><?php echo $farm_pref_str; ?></p>
                                        <h4 class="name"><?php the_title(); ?></h4>
                                    </div>
                                    <div class="action">
                                        <a href="<?php the_permalink(); ?>" class="link-btn mx-auto">
                                            <span>体験プランを見る</span>
                                            <svg width="7" height="13" viewBox="0 0 7 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 1.89844L6 6.89844L1 11.8984" stroke="#3B8E65" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            <div class="plan-action">
                <a href="<?php echo HOME . 'plan/'; ?>" class="plan-btn mx-auto">
                    <div class="btn-body">
                        <span>募集中の体験プランをみる</span>
                    </div>
                    <img class="btn-left" src="<?php echo T_DIRE_URI; ?>/assets/img/plan-btn-1.png" alt="">
                    <img class="btn-right" src="<?php echo T_DIRE_URI; ?>/assets/img/plan-btn-2.png" alt="">
                </a>
            </div>
        </div>
    </section>
    <?php wp_reset_postdata(); ?>
    <?php endif; ?>

    <section id="terms" class="top-terms">
        <div class="container">
            <div class="content-in">
                <div class="section-title">
                    <h3 class="lead">
                        <span>農場体験のご利用方法</span>
                        <img class="right" src="<?php echo T_DIRE_URI; ?>/assets/img/term-ttl-1.png" alt="農場体験のご利用方法">
                    </h3>
                </div>
                <div class="section-content">
                    <ul class="term-list">
                        <li>
                            <div class="term-item">
                                <div class="label">
                                    <small>STEP</small>
                                    <span>01</span>
                                </div>
                                <h4 class="title">農業体験先となる農場を探す</h4>
                                <p class="desc">募集中の体験プランから、まずは農業体験をする農場を検索してお探しください。<br>農場は都道府県や、ご希望の地図上の場所、各農場の体験プランの特徴から探すことができます。</p>
                            </div>
                        </li>
                        <li>
                            <div class="term-item">
                                <div class="label">
                                    <small>STEP</small>
                                    <span>02</span>
                                </div>
                                <h4 class="title">農業体験プランの確認</h4>
                                <p class="desc">検索結果に表示された農場が提供している農業体験プランを確認してください。<br>農業体験してみたい農作物の種類や期間、費用などの条件を確認し、農場宛にプランの相談を行ってください。</p>
                            </div>
                        </li>
                        <li>
                            <div class="term-item">
                                <div class="label">
                                    <small>STEP</small>
                                    <span>03</span>
                                </div>
                                <h4 class="title">農業体験プランを相談する</h4>
                                <p class="desc">ご希望の日程をカレンダーから選び、参加人数やご連絡先などの必要事項<br>農業体験の目的やご希望内容、質問などをコメント欄に入れ「相談する」ボタンを押してください。<br>※この時点はまだ農業体験は確定ではありません。</p>
                            </div>
                        </li>
                        <li>
                            <div class="term-item">
                                <div class="label">
                                    <small>STEP</small>
                                    <span>04</span>
                                </div>
                                <h4 class="title">お申し込み</h4>
                                <p class="desc">農業体験を相談した後、ご希望の日程やコメント欄に入力いただいた相談や希望について農場からメールにて返信いたします。<br>日程や必要な持ち物、費用のお支払い方法などの確認いただき、やりとりの中で農業体験の予約が完了となります。</p>
                            </div>
                        </li>
                    </ul>
                    <div class="plan-action">
                        <a href="<?php echo HOME . 'plan/'; ?>" class="plan-btn mx-auto">
                            <div class="btn-body">
                                <span>募集中の体験プランをみる</span>
                            </div>
                            <img class="btn-left" src="<?php echo T_DIRE_URI; ?>/assets/img/plan-btn-1.png" alt="">
                            <img class="btn-right" src="<?php echo T_DIRE_URI; ?>/assets/img/plan-btn-2.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>


        