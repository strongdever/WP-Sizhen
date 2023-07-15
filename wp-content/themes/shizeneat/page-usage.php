<?php
/*
Template Name: Usage Page
*/

if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
	?>

	<main id="main">

        <section class="terms-lead-section">
            <div class="container">
                <div class="content-in">
                    <div class="section-title">
                        <h3 class="lead">
                            <img class="left" src="<?php echo T_DIRE_URI; ?>/assets/img/term/term-ttl-1.png" alt="農業体験の活用方法">
                            <span>農業体験の活用方法</span>
                            <img class="right" src="<?php echo T_DIRE_URI; ?>/assets/img/term/term-ttl-2.png" alt="農業体験の活用方法">
                        </h3>
                    </div>
                    <div class="section-content">
                        <div class="terms-intro-wrapper">
                            <h4 class="title">農業体験を通じて豊かな人生を送る。<br>新たな事業の足掛かりとして。</h4>
                            <p class="desc">農業体験は、現在の農業が抱える問題を解決するだけではなく様々な活用方法があります。<br>家庭や企業で農業体験を通じて豊かな人生を送ったり、新たな人生を見出したり。<br>企業の新たな事業の足掛かりとして活用いただければと思います。</p>
                        </div>
                        <div class="terms-list-wrapper">
                            <ul class="terms-block-list">
                                <li>
                                    <div class="terms-block-item clearfix">
                                        <figure class="thumb">
                                            <img src="<?php echo T_DIRE_URI; ?>/assets/img/term/term-1.png" alt="">
                                        </figure>
                                        <div class="wrap">
                                            <h4 class="title">子供の教育を兼ねた家族旅行</h4>
                                            <p class="desc">太陽の下で土をいじり、作物の育てながら得られる学びはとても多いです。生き物や食べ物、自然に関することを学ぶことで、普段の学校での学びとは違った生きる力を育むことができます。また、普段とは違った家族の会話を楽しむこともできます。</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="terms-block-item clearfix">
                                        <figure class="thumb">
                                            <img src="<?php echo T_DIRE_URI; ?>/assets/img/term/term-2.png" alt="">
                                        </figure>
                                        <div class="wrap">
                                            <h4 class="title">社員のリフレッシュを兼ねた<br>研修旅行</h4>
                                            <p class="desc">自然と触れ合いながらの農業体験は、従業員同士のコミュニケーションの活性化やチームワークの強化に効果的です。体を動かしながらの食育や、健康経営の一環として行うこともできます。育てた作物はオリジナルのラベルをつけ、お中元やお歳暮などの贈り物として活用することもできます。</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="terms-block-item clearfix">
                                        <figure class="thumb">
                                            <img src="<?php echo T_DIRE_URI; ?>/assets/img/term/term-3.png" alt="">
                                        </figure>
                                        <div class="wrap">
                                            <h4 class="title">農家との提携を新規事業のヒントに</h4>
                                            <p class="desc">新規事業として、自社オリジナルブランドの食品販売の展開や、飲食店における独自性の高いメニュー開発などをお考えの企業様は、自社提携農場の候補探しを、農業体験を通じて行うことができます。長年培った農家の知識をビジネスに活かすことができます。</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="terms-block-item clearfix">
                                        <figure class="thumb">
                                            <img src="<?php echo T_DIRE_URI; ?>/assets/img/term/term-4.png" alt="">
                                        </figure>
                                        <div class="wrap">
                                            <h4 class="title">学校行事としての教育旅行</h4>
                                            <p class="desc">遠足や修学旅行などの学校行事や教育旅行に農業体験はおすすめです。田植えから稲刈りまでの農業体験や、野菜や果物などの種まきから収穫までの体験を作物の成長記録と共に行うことができます。また大学などでの特定の作物の研究のため、提携農場を探す場合にも利用できます。</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="terms-block-item clearfix">
                                        <figure class="thumb">
                                            <img src="<?php echo T_DIRE_URI; ?>/assets/img/term/term-5.png" alt="">
                                        </figure>
                                        <div class="wrap">
                                            <h4 class="title">農業を仕事にして暮らすための<br>足掛かりに</h4>
                                            <p class="desc">将来の仕事として農業を検討している方、農作物を育てながら自然と共に暮らすことに憧れがある方などは、まずは農業という仕事を体験することからはじめてはいかがでしょうか。農家の仕事や実際の生活を体験することでより将来の仕事のイメージを持つことができます。</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="terms-block-item clearfix">
                                        <figure class="thumb">
                                            <img src="<?php echo T_DIRE_URI; ?>/assets/img/term/term-6.png" alt="">
                                        </figure>
                                        <div class="wrap">
                                            <h4 class="title">自然と共に暮らせる地域へ移住</h4>
                                            <p class="desc">都会を離れ、自然と共に生活したいと考えている方は、移住先を検討する際に、まずは地域の農業体験からはじめることをおすすめします。農業体験を通じて、期間限定で田舎暮らしを体験してみたり、暮らしながら農村の方々とコミュニケーションをとることで、生活の仕方や地域との相性を検討いただけます。</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
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
                </div>
            </div>
        </section>
		
	</main>

	<?php
		endwhile;
	endif;
	?>

<?php get_footer();?>
