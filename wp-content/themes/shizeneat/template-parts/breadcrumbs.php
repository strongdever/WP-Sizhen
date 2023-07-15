<?php global $post, $wp_query; ?>
<section class="breadcrumbs">
    <div class="container">
        <ol>
            <li><a href="<?php echo HOME; ?>">TOP</a></li>
            <?php
				if (is_archive() && !is_tax() && !is_category() && !is_tag()) {
					echo '<li>' . post_type_archive_title() . '</li>';
				} else if (is_archive() && is_tax() && !is_category() && !is_tag()) {
					$post_type = get_post_type();
					if($post_type != 'post') {
						$post_type_object = get_post_type_object($post_type);
						$post_type_archive = get_post_type_archive_link($post_type);
						echo '<li><a href="' . $post_type_archive . '">' . $post_type_object->labels->name . '</a></li>';
					}
					$custom_tax_name = get_queried_object()->name;
					echo '<li>' . $custom_tax_name . '</li>';
				} else if ( is_single() ) {
					$post_type = get_post_type();
					if($post_type != 'post') {
						$post_type_object = get_post_type_object($post_type);
						$post_type_archive = get_post_type_archive_link($post_type);
						echo '<li><a href="' . $post_type_archive . '">' . $post_type_object->labels->name . '</a></li>';
					}
					$category = get_the_category();
					if(!empty($category)) {
						$last_category = $category[0];
						$get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
						$cat_parents = explode(',',$get_cat_parents);
						$cat_display = '';
						foreach($cat_parents as $parents) {
						  $cat_display .= '<li>'.$parents.'</li>';
						}
					}

					$taxonomy_exists = taxonomy_exists($custom_taxonomy);
					if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
						$taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
						$cat_id         = $taxonomy_terms[0]->term_id;
						$cat_nicename   = $taxonomy_terms[0]->slug;
						$cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
						$cat_name       = $taxonomy_terms[0]->name;
					}

					if(!empty($last_category)) {
						echo $cat_display;
						echo '<li>' . get_the_title() . '</li>';
					} else if(!empty($cat_id)) {
						echo '<li><a href="' . $cat_link . '">' . $cat_name . '</a></li>';
						echo '<li>' . get_the_title() . '</li>';
					} else {
						echo '<li>' . get_the_title() . '</li>';
					}
				} else if ( is_category() ) {
					echo '<li>' . single_cat_title('', false) . '</li>';
				} else if ( is_page() ) {
					if( $post->post_parent ){
						$anc = get_post_ancestors( $post->ID );
						$anc = array_reverse($anc);
					if ( !isset( $parents ) ) $parents = null;
						foreach ( $anc as $ancestor ) {
						  $parents .= '<li><a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
						}
						echo $parents;
						echo '<li>' . get_the_title() . '</li>';
					} else {
						echo '<li>' . get_the_title() . '</li>';     
					}  
				} else if ( is_tag() ) {
					$term_id        = get_query_var('tag_id');
					$taxonomy       = 'post_tag';
					$args           = 'include=' . $term_id;
					$terms          = get_terms( $taxonomy, $args );
					$get_term_id    = $terms[0]->term_id;
					$get_term_slug  = $terms[0]->slug;
					$get_term_name  = $terms[0]->name;
					echo '<li>' . $get_term_name . '</li>';
				} else if ( is_search() ) {
					echo '<li>' . get_search_query() . '</li>';
				} elseif ( is_404() ) {
					echo '<li>' . '404' . '</li>';
				}
      		?>
        </ol>
    </div>
</section>