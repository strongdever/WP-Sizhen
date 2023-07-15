<?php

	/*
	Template Name: FrontPage
	*/

	if ( ! defined( 'ABSPATH' ) ) exit;
	get_header();

?>

<main id="top">

    <section class="mainvisual">
        <div class="container">
            <picture class="mainvisual-banner">
                <source media="(min-width:769px)" srcset="<?php echo T_DIRE_URI; ?>/assets/img/mainvisual-banner.png">
                <source media="(max-width:768px)" srcset="<?php echo T_DIRE_URI; ?>/assets/img/mainvisual-banner-sp.png">
                <img src="<?php echo T_DIRE_URI; ?>/assets/img/mainvisual-banner.png" alt="<?php echo bloginfo('name'); ?>">
            </picture>
        </div>
    </section>

    <section class="top-intro">
        <div class="container">
            <?php get_template_part('template', 'parts/banner'); ?>
        </div>
    </section>

    <?php
        $subsidy_args = [
            'post_type' => 'subsidy',
            'post_status' => 'publish',
            'posts_per_page' => 6,
            'orderby' => 'post_date',
            'order' => "DESC",
        ];
        $subsidy_query = new WP_Query( $subsidy_args );
    ?>
    <?php if( $subsidy_query->have_posts() ) : ?>
    <section class="top-recommended">
        <div class="container">
            <h3 class="section-title">おすすめ助成金</h3>
            <div class="section-content">
                <ul class="subsidy-list">
                    <?php while( $subsidy_query->have_posts() ) :  $subsidy_query->the_post(); ?>
                    <li>
                        <div class="subsidy-item">
                            <div class="wrap">
                                <a href="<?php the_permalink(); ?>" class="thumb">
                                    <?php if( has_post_thumbnail() ): ?>
                                        <?php the_post_thumbnail(); ?>
                                    <?php else: ?>
                                        <img src="<?php echo catch_that_image(); ?>" width="340" height="227" alt="<?php the_title(); ?>">
                                    <?php endif; ?>
                                </a>
                                <h4 class="title">
                                    <strong><?php the_title(); ?></strong>
                                    <?php if( get_field('course') ) : ?>
                                        <small>(<?php the_field('course'); ?>)</small>
                                    <?php endif; ?>
                                </h4>
                                <div class="content">
                                    <div class="text"><?php the_field('excerpt'); ?></div>
                                </div>
                            </div>
                            <div class="more">
                                <a href="<?php the_permalink(); ?>" class="more-link">詳細を見る</a>
                            </div>
                        </div>
                    </li>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </ul>
                <?php if( $subsidy_query->found_posts > 6 ) : ?>
                    <a href="<?php echo HOME . 'subsidy'; ?>" class="link-btn mt-60 mt-sp-50 mx-auto">
                        <span>もっと見る</span>
                    </a>
                <?php endif; ?>
            </div>
            <div class="support-box">
                <div class="box-cotnent">
                    <h4 class="title">静岡県密着型のサポート</h4>
                    <p class="text">お問い合わせいただいた企業の診断しております<br>それぞれの企業にあった助成金を提案します。</p>
                </div>
                <img class="box-effect" src="<?php echo T_DIRE_URI; ?>/assets/img/support-effect.png" alt="">
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section class="top-banners">
        <div class="container">
            <h3 class="section-lead"><span class="color-yellow">助成金の基礎コンテンツ</span><br class="sp">についてはこちら</h3>
            <div class="section-content">
                <ul class="top-banner-list">
                    <li>
                        <a href="<?php echo HOME . 'detail'; ?>" class="top-banner">
                            <figure class="back">
                                <img src="<?php echo T_DIRE_URI; ?>/assets/img/banner-ph-01.png" alt="">
                            </figure>
                            <div class="wrap">
                                <h4 class="title">助成金とは</h4>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo HOME . 'merit'; ?>" class="top-banner">
                            <figure class="back">
                                <img src="<?php echo T_DIRE_URI; ?>/assets/img/banner-ph-02.png" alt="">
                            </figure>
                            <div class="wrap">
                                <h4 class="title">専門家に頼むメリット</h4>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo HOME . 'flow'; ?>" class="top-banner">
                            <figure class="back">
                                <img src="<?php echo T_DIRE_URI; ?>/assets/img/banner-ph-03.png" alt="">
                            </figure>
                            <div class="wrap">
                                <h4 class="title">受給までの流れ</h4>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo HOME . 'point'; ?>" class="top-banner">
                            <figure class="back">
                                <img src="<?php echo T_DIRE_URI; ?>/assets/img/banner-ph-04.png" alt="">
                            </figure>
                            <div class="wrap">
                                <h4 class="title">助成金活用ポイント</h4>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="top-policies">
        <div class="container">
            <h3 class="section-lead">横田社会保険労務士事務所の<br class="sp"><strong class="color-green">ポリシー</strong></h3>
            <div class="section-content">
                <div class="sub-lead">代表者挨拶</div>
                <div class="greeting-box  mb-50 mb-sp-40">
                    <div class="inner-row">
                        <div class="left">
                            <div class="profile">
                                <figure class="profile-avatar">
                                    <img src="<?php echo T_DIRE_URI; ?>/assets/img/greeting-ph.png" alt="">
                                </figure>
                                <div class="profile-text">
                                    <p>横田社会保険労務士事務所</p>
                                    <h4>横田研</h4>
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="message">
                                <h4 class="lead">事務所ポリシー</h4>
                                <div class="text">良心と強い責任感のもと、公正な立場で誠実に職務を遂行します。常に専門性を追求し、理論と実務に精通します。契約を誠実に履行し、クライアントの信頼に応えます</div>
                            </div>
                            <div class="message">
                                <h4 class="lead">挨拶</h4>
                                <div class="text">私たちは、企業にあった就業規則によるリスク回避や、煩雑な手続きの代行による業務効率化の支援、職場環境向上などを目的とした助成金の申請などで、経営者の方をお手伝いしています。経営者が事業に専念できるよう、私達社労士事務所のスタッフが全力で支援致します。</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-lead">事務所概要</div>
                <div class="officemap-box">
                    <div class="map-wrap">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3277.154049211847!2d138.2599911!3d34.776897!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x601a449fe75860fb%3A0x8ccc270b51652a6d!2z5pel5pys44CB44CSNDIxLTAzMDIg6Z2Z5bKh55yM5qab5Y6f6YOh5ZCJ55Sw55S65bed5bC777yS77yW77yT!5e0!3m2!1sja!2sru!4v1680246387677!5m2!1sja!2sru"
                            width="1000" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="info-wrap">
                        <h4 class="lead">横田社会保険労務士事務所</h4>
                        <div class="text">静岡県榛原郡吉田町川尻263-1<br>電話番号：0548-33-0040<span class="pc">　</span><br class="sp">FAX：0548-33-0241<br>E-mail：office@sr-com.jp</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="top-choosings">
        <div class="container">
            <h3 class="section-lead">静岡助成金センターが選ばれる<strong class="color-red">7</strong>つの<strong class="color-yellow">理由</strong></h3>
            <div class="section-content">
                <div class="choosing-list-box">
                    <ul class="choosing-list">
                        <li>
                            <div class="choosing-item">
                                <h4 class="title"><span class="color-yellow">相談料0円</span>だからお気軽に相談頂いています！</h4>
                                <div class="text">助成金は、まだまだ「知られていない」という現状があります。まずは、神奈川県内の企業様に助成金の活用方法をご紹介させていただくために、相談料を無料で診断兼相談を実施しています。煩雑な申請代行もきちんとサポート致しますので、安心してお任せいただいています！</div>
                            </div>
                        </li>
                        <li>
                            <div class="choosing-item">
                                <h4 class="title"><span class="color-yellow">助成金特化</span>による企業の資金調達サポート！</h4>
                                <div class="text">助成金の申請代行は、「もらえない可能性」というリスクがあり、あまり積極的に行っている社労士事務所が少ないことは事実です。私たちもその怖さは、十分認識しています。しかし、神奈川の経営者様と色々な打ち合わせや相談を行っている中で、資金調達ニーズに応えていかなければいけないと、発起いたしました。神奈川県内でも、屈指の実績があると自負しております。</div>
                            </div>
                        </li>
                        <li>
                            <div class="choosing-item">
                                <h4 class="title"><span class="color-yellow">建設業に精通した担当者在籍</span>した担当者在籍</h4>
                                <div class="text">行政書士事務所を併設しており、年間120件以上の建設業許可の申請代行を行っております。 そのため建設業界の助成金申請も数多く行っておりますので、助成金申請をお考えの建設業経営者の方はお問い合わせください。</div>
                            </div>
                        </li>
                        <li>
                            <div class="choosing-item">
                                <h4 class="title"><span class="color-yellow">神奈川トップクラス</span>の助成金・補助金申請実績！</h4>
                                <div class="text">助成金のご提案をすると、ほとんどの企業が「是非、お願いします！」と言って頂きます。毎年同じ助成金を活用される企業様もたくさんいらっしゃいます。こうした中で、神奈川でトップクラスの申請・相談実績を誇っています！</div>
                            </div>
                        </li>
                        <li>
                            <div class="choosing-item">
                                <h4 class="title">神奈川を中心に<span class="color-yellow">出張相談実施中！</span></h4>
                                <div class="text">忙しい経営者様から、「事務所に行く時間が・・・」と言われて、助成金のチャンスを逃してしまっているのがもどかしく、可能な限り出張相談も完全予約制で行っています。神奈川を中心に随時実施中です。ご希望の方は、ご相談ください。</div>
                            </div>
                        </li>
                        <li>
                            <div class="choosing-item">
                                <h4 class="title">ＨＰに、<span class="color-yellow">70ページ以上の助成金情報</span>を掲載！</h4>
                                <div class="text">助成金をご存じない経営者様を少しでもなくすため、現在活用できる最新助成金から、業種別のオススメ助成金まで、神奈川の企業様が元気になるための助成金制度をご紹介いたします！ 今後も、随時更新していきます。また、紹介しきれていない助成金もございます。ますは、お問い合わせください。</div>
                            </div>
                        </li>
                        <li>
                            <div class="choosing-item">
                                <h4 class="title"><span class="color-yellow">全国160事務所以上</span>の全国ネットワークに参加！</h4>
                                <div class="text">助成金を活用して企業様の資金ニーズに応えている社労士のネットワークがあります。そこで、様々な助成金受給事例や、活用事例を研究しています。最新の助成金を受給漏れがないように、日々新たな情報を発信していきます！</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <?php
        $news_args = [
            'post_type' => 'news',
            'post_status' => 'publish',
            'posts_per_page' => 6,
            'orderby' => 'post_date',
            'order' => "DESC",
        ];
        $news_query = new WP_Query( $news_args );
    ?>
    <?php if( $news_query->have_posts() ) : ?>
    <section class="top-news">
        <div class="container">
            <h3 class="section-title">新着情報</h3>
            <div class="news-list-wrap">
                <ul class="news-list">
                    <?php while( $news_query->have_posts() ) :  $news_query->the_post(); ?>
                    <li>
                        <div class="news-item">
                            <div class="thumb">
                                <a href="<?php the_permalink(); ?>" class="image">
                                    <?php if( has_post_thumbnail() ): ?>
                                        <?php the_post_thumbnail("small"); ?>
                                    <?php else: ?>
                                        <img src="<?php echo catch_that_image(); ?>" width="150" height="100" alt="<?php the_title(); ?>">
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="content">
                                <time class="date"><?php the_time("Y.m.d"); ?></time>
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            </div>
                        </div>
                    </li>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </ul>
            </div>
            <a href="<?php echo HOME . 'news'; ?>" class="link-btn mt-60 mt-sp-50 mx-auto">
                <span>もっと見る</span>
            </a>
        </div>
    </section>
    <?php endif; ?>

    <section id="contact" class="section-contact-banner">
        <div class="container">
            <?php get_template_part('template', 'parts/banner'); ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>


        