<?php
/*
Template Name: Merit Page
*/

if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
	?>

	<main id="main">

	    <section class="merit-lead-section">
            <div class="container">
                <div class="content-in">
                    <div class="section-title">
                        <h3 class="lead">
                            <img class="left" src="<?php echo T_DIRE_URI; ?>/assets/img/merit/merit-ttl-1.png" alt="農業体験のメリット">
                            <span>農業体験のメリット</span>
                            <img class="right" src="<?php echo T_DIRE_URI; ?>/assets/img/merit/merit-ttl-2.png" alt="農業体験のメリット">
                        </h3>
                    </div>
                    <div class="section-content">
                        <div class="about-merit-wrapper clearfix">
                            <div class="wrap">
                                <h4 class="title">農業体験を通じて<br>様々な課題を解決していく</h4>
                                <p class="desc">「自然を食べよう！」は農業体験を通じて農家の知識と経験を共有し、収穫された農産品を味わう体験をみなさまに提供する貸し農場紹介サイトです。<br><br>農場をレンタルし農業体験をすることで、自然の中でリフレッシュし、食を通じた教育の場（食育）と農業という新しい事業への参入チャンスを提供します。</p>
                            </div>
                            <img class="nature" src="<?php echo T_DIRE_URI; ?>/assets/img/merit/nature_zukai.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="merit-list-section">
            <div class="container">
                <div class="content-in">
                    <div class="sub-title">
                        <h3 class="lead">
                            <img class="left" src="<?php echo T_DIRE_URI; ?>/assets/img/merit/list-ttle-1.png" alt="農業体験のメリット">
                            <span>農業体験のメリット</span>
                        </h3>
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
                    </div>
                </div>
            </div>
        </section>

        <section class="merit-problem-section">
            <div class="container">
                <div class="content-in">
                    <div class="sub-title">
                        <h3 class="lead">
                            <img class="left" src="<?php echo T_DIRE_URI; ?>/assets/img/merit/list-ttle-1.png" alt="農家の問題解決に向けて">
                            <span>農家の問題解決に向けて</span>
                        </h3>
                    </div>
                    <div class="section-content">
                        <div class="problem-wrapper clearfix">
                            <div class="wrap">
                                <p class="desc">また農業体験を通じて、農家に起きている問題の解決も考えています。<br>現在、日本の農家は平均年齢は67.8歳と言われ、高齢化が年々進んでいます。<br><br>さらに農業の担い手不足も深刻で、農業従事者の推移も年々減っています。<br><br>そんな農家の高齢化と農業従事者の減少によって耕作放棄地、荒廃農地の増加も問題になっています。<br><br>このサイトを通じて農業体験者を増やすことで、新たな農業従事者が増え、農業人口の減少を止め、地域の活性化、食料自給率の向上、日本の農業の持続可能性も実現できたらと考えています。</p>
                            </div>
                            <ul class="thumbs">
                                <li>
                                    <figure class="thumb">
                                        <img src="<?php echo T_DIRE_URI; ?>/assets/img/merit/problem-1.png" alt="">
                                    </figure>
                                </li>
                                <li>
                                    <figure class="thumb">
                                        <img src="<?php echo T_DIRE_URI; ?>/assets/img/merit/problem-2.png" alt="">
                                    </figure>
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
