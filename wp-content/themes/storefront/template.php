<?php
/* Template Name: TestWork647 */
get_header();





       $args = array(
                'post_type'      => 'product',
                'posts_per_page' => 10
            );

            $loop = new WP_Query( $args );

            while ( $loop->have_posts() ) : $loop->the_post();

            echo '<div class="card mb-3" style="max-width: 540px;">
					<div class="row g-0">
    					<div class="col-md-4">
     						<div class="img-fluid rounded-start">'.woocommerce_get_product_thumbnail().'</div>
    					</div>
    					<div class="col-md-8">
    					  <div class="card-body">
    					    <h5 class="card-title">
    					    	<a href="'.get_permalink().'" style="text-decoration:none;color:grey;">'.get_the_title().'</a>
    					    </h5>
    					    <p class="card-text">'.$product->get_short_description().'</p>
    					  </div>
    					</div>
					</div>
				</div>';

            
                $ratting = $product->get_rating_counts();
                for($i = 0 ; $i < count($ratting); $i++) {
                    echo $ratting[i];
                }
            endwhile;

            wp_reset_query();










get_footer();?>