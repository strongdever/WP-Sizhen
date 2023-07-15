<?php
/*
Template Name: Plans Search Page
*/

if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$pref = get_query_var('pref') ? (int)get_query_var('pref') : 0;
$keyword = get_query_var('keyword') ? trim(get_query_var('keyword')) : "";
$keys = get_query_var('key') ? wp_unslash((array)get_query_var('key')) : [];
$period = get_query_var('period') ? (int)get_query_var('period') : 0;
$min_price = get_query_var('min-price') ? (int)get_query_var('min-price') : 0;
$max_price = get_query_var('max-price') ? (int)get_query_var('max-price') : 0;
$tab = get_query_var('tab') ? (int)get_query_var('tab') : 0;
$area_arr = get_query_var('area') ? get_query_var('area') : [];
// var_export( $area_arr[1] );
// exit;

?>

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
	?>

	<main id="main">
        <?php 
            $is_detail_tab = false;
            if(!empty($keyword) || !empty($keys) || $period || $min_price || $max_price) {
                $is_detail_tab = true;
            }
        ?>
        <section class="plan-lead-section">
            <div class="container">
                <div class="section-title">
                    <h3 class="lead">
                        <img class="left" src="<?php echo T_DIRE_URI; ?>/assets/img/plan/plan-ttl-1.png" alt="募集中の体験プラン">
                        <span>募集中の体験プラン</span>
                        <img class="right" src="<?php echo T_DIRE_URI; ?>/assets/img/plan/plan-ttl-2.png" alt="募集中の体験プラン">
                    </h3>
                </div>
                <div class="section-content">
                    <div class="tabs">
                        <ul class="tabs-list">
                            <li>
                                <a href="#tab1" class="tabs-link<?php echo ($tab == 1 || $tab == 0) ? ' active' : ''; ?>">都道府県<br class="sp">から探す</a>
                            </li>
                            <li>
                                <a href="#tab3" class="tabs-link<?php echo $tab == 3 ? ' active': ''; ?>">体験プラン<br class="sp">から探す</a>
                            </li>
                        </ul>
                        <?php 
                            $pref_args = [
                                'taxonomy' => 'pref',
                                'hide_empty' => false,
                                "parent" => 0,
                            ];
                            $all_prefs = get_terms( $pref_args );
                            if( !empty( $all_prefs ) ) :
                        ?>
                        <div id="tab1" class="tab"<?php echo ($tab == 1 || $tab == 0) ? ' style="display: block;"' : ''; ?>>
                            <div class="tab-content">
                                <form role="search" method="get" action="<?php echo esc_url( home_url( 'plan-search' ) ); ?>">
                                    <input type="hidden" name="tab" value="1">
                                    <ul class="area-selects">
                                        <?php $index = 0; ?>
                                        <?php foreach ($all_prefs as $parent_pref): ?>
                                        <li>
                                            <select name="area[]">
                                                <option value="<?php echo $parent_pref->term_id; ?>"<?php if($area_arr) : ?>
                                                <?php echo $area_arr[$index] == $parent_pref->term_id ? ' selected' : ''; ?>
                                                <?php endif; ?>><?php echo $parent_pref->name . " (" . $parent_pref->count . ")"; ?></option>
                                                <?php
                                                    $sub_prefs = get_terms([
                                                        'taxonomy' => 'pref',
                                                        "hide_empty" => false,
                                                        "parent" => $parent_pref->term_id,
                                                    ]);
                                                ?>
                                                <?php if( !empty( $sub_prefs ) ) : foreach ($sub_prefs as $sub_pref) : ?>
                                                    
                                                <option value="<?php echo $sub_pref->term_id; ?>"<?php if($area_arr) : ?>
                                                <?php echo $area_arr[$index] == $sub_pref->term_id ? ' selected' : ''; ?>
                                                <?php endif; ?>><?php echo $sub_pref->name . " (" . $sub_pref->count . ")"; ?></option>
                                                <?php endforeach; endif; ?>
                                            </select>
                                        </li>
                                        <?php $index++; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                    <div class="form-action">
                                        <button type="submit" class="link-btn">
                                            <span>検索する</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div id="tab3" class="tab"<?php echo $tab == 3 ? ' style="display: block;"': ''; ?>>
                            <div class="tab-content">
                                <form role="search" method="get" action="<?php echo esc_url( home_url( 'plan-search' ) ); ?>" class="detail-form">
                                    <input type="hidden" name="tab" value="3">
                                    <div class="form-group mb-40 mb-sp-24">
                                        <p class="label">キーワード</p>
                                        <div class="keyword-input">
                                            <input type="text" name="keyword" placeholder="例：いちご農園" value="<?php echo !empty($keyword) ? $keyword : ''; ?>">
                                            <button type="button">検索条件に追加</button>
                                        </div>
                                        <ul class="keyword-tags"<?php echo empty($keys) ? ' style="display: none;"' : ''; ?>>
                                            <?php if( !empty( $keys ) ) : ?>
                                                <?php foreach ($keys as $key) : ?>
                                                    <li class="keyword-tag">
                                                        <input type="hidden" name="key[]" value="<?php echo trim($key); ?>">
                                                        <span><?php echo trim($key); ?></span>
                                                        <i class="fa fa-close"></i>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <div class="form-group mb-40 mb-sp-20">
                                        <p class="label">期間</p>
                                        <ul class="checkbox-list">
                                            <li>
                                                <label class="checkbox">1日
                                                    <input type="checkbox" name="period" value="1"<?php echo ($period == 1) ? ' checked="checked"' : ''; ?>>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="checkbox">1泊2日
                                                    <input type="checkbox" name="period" value="2"<?php echo ($period == 2) ? ' checked="checked"' : ''; ?>>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="checkbox">3日〜1週間未満
                                                    <input type="checkbox" name="period" value="3"<?php echo ($period == 3) ? ' checked="checked"' : ''; ?>>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="checkbox">1週間〜1ヶ月未満
                                                    <input type="checkbox" name="period" value="4"<?php echo ($period == 4) ? ' checked="checked"' : ''; ?>>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="checkbox">1ヶ月〜1年未満
                                                    <input type="checkbox" name="period" value="5"<?php echo ($period == 5) ? ' checked="checked"' : ''; ?>>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="checkbox">1年以上
                                                    <input type="checkbox" name="period" value="6"<?php echo ($period == 6) ? ' checked="checked"' : ''; ?>>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="form-group">
                                       <p class="label">ご予算</p>
                                       <ul class="between">
                                            <li class="m">
                                                <select name="min-price" id="min-price">
                                                    <option value="">下限なし</option>
                                                    <option value="1000"<?php echo ($min_price == 1000) ? ' selected="selected"' : ''; ?>>1,000円</option>
                                                    <option value="2000"<?php echo ($min_price == 2000) ? ' selected="selected"' : ''; ?>>2,000円</option>
                                                    <option value="5000"<?php echo ($min_price == 5000) ? ' selected="selected"' : ''; ?>>5,000円</option>
                                                    <option value="10000"<?php echo ($min_price == 10000) ? ' selected="selected"' : ''; ?>>10,000円</option>
                                                    <option value="20000"<?php echo ($min_price == 20000) ? ' selected="selected"' : ''; ?>>20,000円</option>
                                                </select>
                                            </li>
                                            <li class="s">～</li>
                                            <li class="m">
                                                <select name="max-price" id="max-price">
                                                    <option value="">上限なし</option>
                                                    <option value="10000"<?php echo ($max_price == 10000) ? ' selected="selected"' : ''; ?>>10,000円</option>
                                                    <option value="20000"<?php echo ($max_price == 20000) ? ' selected="selected"' : ''; ?>>20,000円</option>
                                                    <option value="50000"<?php echo ($max_price == 50000) ? ' selected="selected"' : ''; ?>>50,000円</option>
                                                    <option value="100000"<?php echo ($max_price == 100000) ? ' selected="selected"' : ''; ?>>100,000円</option>
                                                    <option value="200000"<?php echo ($max_price == 200000) ? ' selected="selected"' : ''; ?>>200,000円</option>
                                                </select>
                                            </li>
                                       </ul>
                                    </div>
                                    <div class="form-action">
                                        <button type="submit" class="link-btn">
                                            <span>検索する</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php if( $tab ) : ?>
            
            <?php 
            $merged_farm_ids = [];
            if(!empty($keyword) || !empty($keys) || $period || $min_price || $max_price) {

                $merged_plan_ids = [];

                if( !empty( $keyword ) ) {
                    $split_keywords = explode(" ", $keyword);
                    foreach ( $split_keywords as $split_keyword ) {
                        if( !empty( $split_keyword ) ) {
                            $split2_keywords = explode("　", $split_keyword);
                            foreach ( $split2_keywords as $split2_keyword ) {
                                if( !empty( $split2_keyword ) ) {
                                    $keys[] = trim( $split2_keyword );
                                }
                            }
                        }
                    }
                    $keys = array_values( $keys );
                }

                if( !empty( $keys ) ) {
                    foreach ( $keys as $key ) {
                        $plan_key_args = [
            				'post_type' => 'plan',
            				'post_status' => 'publish',
            				'posts_per_page' => -1,
                            'fields' => 'ids',
            				'orderby' => 'post_date',
            				'order' => "DESC",
                            'meta_or_title' => trim( $key ),
                            'meta_query' => [
                                'relation' => 'OR',
                                [
                                    'key' => 'price',
                                    'value' => trim( $key ),
                                    'compare' => 'LIKE',
                                    'type'    => 'BINARY'
                                ],
                                [
                                    'key' => 'overview',
                                    'value' => trim( $key ),
                                    'compare' => 'LIKE',
                                    'type'    => 'BINARY'
                                ],
                                [
                                    'key' => 'includes',
                                    'value' => trim( $key ),
                                    'compare' => 'LIKE',
                                    'type'    => 'BINARY'
                                ],
                                [
                                    'key' => 'prepares',
                                    'value' => trim( $key ),
                                    'compare' => 'LIKE',
                                    'type'    => 'BINARY'
                                ],
                                [
                                    'key' => 'rentals',
                                    'value' => trim( $key ),
                                    'compare' => 'LIKE',
                                    'type'    => 'BINARY'
                                ],
                                [
                                    'key' => 'comment',
                                    'value' => trim( $key ),
                                    'compare' => 'LIKE',
                                    'type'    => 'BINARY'
                                ],
                            ]
            			];

                        if ( !empty($plan_key_meta_query) ) {
                            $plan_key_args['meta_query'] = $plan_key_meta_query;
                        }

                        $plan_key_ids = get_posts( $plan_key_args );

                        if( !empty( $plan_key_ids ) ) {
                            $merged_plan_ids = array_unique( array_merge( $merged_plan_ids, $plan_key_ids ) );
                        }
                    }
                }

                $plan_search_args = [
                    'post_type' => 'plan',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'fields' => 'ids',
                    'orderby' => 'post_date',
                    'order' => "DESC",
                ]; 

                $plan_search_meta_query = [];

                if( !empty( $period ) ) {
                    $plan_search_meta_query[] = [
                        'key' => 'period',
                        'value' => $period,
                        'compare' => 'IN',
                    ];
                }

                if( !empty( $min_price ) ) {
                    $plan_search_meta_query[] = [
                        'key' => 'price',
                        'value' => $min_price,
                        'compare' => '>=',
                        'type'    => 'numeric'
                    ];
                }

                if( !empty( $max_price ) ) {
                    $plan_search_meta_query[] = [
                        'key' => 'price',
                        'value' => $max_price,
                        'compare' => '<=',
                        'type'    => 'numeric'
                    ];
                }

                if ( !empty($plan_search_meta_query) ) {
                    $plan_search_args['meta_query'] = $plan_search_meta_query;
                }

                $plan_search_ids = get_posts( $plan_search_args );

                $merged_plan_ids = (!empty( $keys )) ? array_intersect($merged_plan_ids, $plan_search_ids) : $plan_search_ids;

                $merged_plan_ids = array_unique(array_values($merged_plan_ids));

                if( !empty( $merged_plan_ids ) ) {
                    $plan_args = [
                        'post_type' => 'plan',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'orderby' => 'post_date',
                        'order' => "DESC",
                        'post__in' => $merged_plan_ids
                    ];

                    $plan_query = new WP_Query( $plan_args );
                    if( $plan_query->have_posts() ) {
                        while ( $plan_query->have_posts() ) { 
                            $plan_query->the_post();
                            array_push($merged_farm_ids, get_field('farms'));
                        }
                        wp_reset_postdata();
                    }
                }

                if( !empty( $keys ) ) {
                    foreach ( $keys as $key ) {
                        $farm_key_args = [
            				'post_type' => 'farm',
            				'post_status' => 'publish',
            				'posts_per_page' => -1,
                            'fields' => 'ids',
            				'orderby' => 'post_date',
            				'order' => "DESC",
                            'meta_or_title' => trim( $key ),
                            'meta_query' => [
                                'relation' => 'OR',
                                [
                                    'key' => 'address',
                                    'value' => trim( $key ),
                                    'compare' => 'LIKE',
                                    'type'    => 'BINARY'
                                ],
                                [
                                    'key' => 'size',
                                    'value' => trim( $key ),
                                    'compare' => 'LIKE',
                                    'type'    => 'BINARY'
                                ],
                                [
                                    'key' => 'crop',
                                    'value' => trim( $key ),
                                    'compare' => 'LIKE',
                                    'type'    => 'BINARY'
                                ],
                                [
                                    'key' => 'overview',
                                    'value' => trim( $key ),
                                    'compare' => 'LIKE',
                                    'type'    => 'BINARY'
                                ],
                            ]
            			];

                        $farm_key_ids = get_posts( $farm_key_args );

                        if( !empty( $farm_key_ids ) ) {
                            $merged_farm_ids = array_unique( array_merge( $merged_farm_ids, $farm_key_ids ) );
                        }

                        $pref_args = [
                            'post_type' => 'farm',
            				'post_status' => 'publish',
            				'posts_per_page' => -1,
                            'fields' => 'ids',
                            'orderby' => 'post_date',
            				'order' => "DESC",
                            'tax_query' => [
                                'relation' => 'OR',
                                [
                                    'taxonomy' => 'pref',
                                    'field' => 'term_id',
                                    'terms' =>  get_terms([
                                        'taxonomy' => 'pref',
                                        'name__like' => trim( $key ),
                                        'fields' => 'ids',
                                    ])                 
                                ]
                            ],
                        ];

                        $farm_pref_ids = get_posts( $pref_args );

                        if( !empty( $farm_pref_ids ) ) {
                            $merged_farm_ids = array_unique( array_merge( $merged_farm_ids, $farm_pref_ids ) );
                        }
                    }
                }
            }

            ?>

            <?php
    			$args = [
    				'post_type' => 'farm',
    				'post_status' => 'publish',
    				'posts_per_page' => -1,
    				'orderby' => 'post_date',
    				'order' => "DESC",
    			];

                $meta_query = [];
                $tax_query = [];

                if( !empty( $area_arr ) ) {
                    $tax_query[] = [
                        'taxonomy' => 'pref',
                        'field' => 'term_id',
                        'terms' => $area_arr,
                    ];
                }

                if(!empty($keyword) || !empty($keys) || $period || $min_price || $max_price) {
                    $args['post__in'] = !empty( $merged_farm_ids ) ? $merged_farm_ids : [0];
                }

                if ( !empty($meta_query) ) {
                    $args['meta_query'] = $meta_query;
                }
                
                if ( !empty($tax_query) ) {
                    $args['tax_query'] = $tax_query;
                }
    		?>

    	  	<?php $custom_query = new WP_Query( $args ); ?>
            <section class="plan-list-section">
                <div class="container">
                    <div class="content-in">
                        <?php if( $custom_query->have_posts() ) : ?>
						<div class="plan-found-count"><strong><?php echo $custom_query->found_posts; ?></strong>件の農場が見つかりました</div>
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
                            <div class="sub-title type1">
                                <h3 class="lead">
                                    <img class="left" src="<?php echo T_DIRE_URI; ?>/assets/img/plan/list-ttl-1.png" alt="検索結果">
                                    <span>検索結果</span>
                                </h3>
                            </div>
                            <p class="no-data">検索結果がありません。</p>
				        <?php endif; ?>
                    </div>
                </div>
            </section>

        <?php endif; ?>
		
	</main>

	<?php
		endwhile;
	endif;
	?>

    <?php
    add_action('wp_footer', 'custom_script_wp_footer', 1000, 8);
    function custom_script_wp_footer() {
    ?>
    <script>
        var pref = "16";
        // $(function() {
        //     $(document).on("change", ".tabs .area-selects select", function(e) {
        //         e.preventDefault();
        //             pref = $(this).val();
        //             return pref;
        //     });
        //     $(document).on("click", ".tab-content .form-action .link-btn", function(e) {
        //         e.preventDefault();
        //         window.location.href = baseSiteUrl + "plan-search?tab=1&pref=" + pref;
        //     });
        // });
            
        $(document).on("keypress", ".detail-form .keyword-input input[name='keyword']", function(e) {
            if(e.which == 13) {
                e.preventDefault();
                var input_keyword = $(this).val();
                if( input_keyword ) {
                    var split_keyword = input_keyword.split(" ");
                    var keywords = [];
                    split_keyword.forEach(el => {
                        if( el ) {
                            var temp_splits = el.split("　");
                            temp_splits.forEach(el1 => {
                                if( el1 ) {
                                    keywords.push( el1 );
                                }
                            });
                        }
                    });
                    var keywords_container = $(this).parent('.keyword-input').next('.keyword-tags');
                    for ( let i = keywords.length - 1; i >= 0; i-- ) {
                        keywords_container.prepend('<li class="keyword-tag"><input type="hidden" name="key[]" value="' + keywords[i] + '"><span>' + keywords[i] + '</span><i class="fa fa-close"></i></li>');
                    }
                    $(this).val('');
                    if( keywords_container.has('.keyword-tag').length > 0 ) {
                        keywords_container.show();
                    }
                }
            }
        });

        $(document).on("click", ".detail-form .keyword-input button", function(e) {
            e.preventDefault();
            var input_keyword = $(this).prev('input').val();
            if( input_keyword ) {
                var split_keyword = input_keyword.split(" ");
                var keywords = [];
                split_keyword.forEach(el => {
                    if( el ) {
                        var temp_splits = el.split("　");
                        temp_splits.forEach(el1 => {
                            if( el1 ) {
                                keywords.push( el1 );
                            }
                        });
                    }
                });
                var keywords_container = $(this).parent('.keyword-input').next('.keyword-tags');
                for ( let i = keywords.length - 1; i >= 0; i-- ) {
                    keywords_container.prepend('<li class="keyword-tag"><input type="hidden" name="key[]" value="' + keywords[i] + '"><span>' + keywords[i] + '</span><i class="fa fa-close"></i></li>');
                }
                $(this).val('');
                if( keywords_container.has('.keyword-tag').length > 0 ) {
                    keywords_container.show();
                }
            }
        });

        $(document).on("click", ".detail-form .keyword-tags .fa-close", function(e) {
            e.preventDefault();
            $(this).parent('.keyword-tag').remove();
            var keywords_container = $(this).parents('.keyword-tags');
            if( keywords_container.has('.keyword-tag').length == 0 ) {
                keywords_container.hide();
            }
        });

        $(document).on("change", ".detail-form .checkbox-list input[type='checkbox']", function(e) {
            if ($(this).is(':checked')) {
                $(this).parents('.checkbox-list').find('input[type="checkbox"').not(this).prop('checked', false);
            }
        });

        // $(document).on("submit", "form.detail-form", function(e) {
        //     if(!$(this).find('input[name="keyword"]').val() && $(this).find('.keyword-tags .keyword-tag input').length == 0 && $(this).find('.checkbox-list input[type="checkbox"]:checked').length == 0 ) {
        //         e.preventDefault();
        //         $('.tabs .tabs-list li:first-child .tabs-link').click();
        //     }
        // }); 
    </script>
    <?php
    }
    ?>

<?php get_footer();?>
