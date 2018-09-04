<?php
add_shortcode( 'feature_box', 'feature_box_callback' );

function feature_box_callback( $attr, $content = null ) {
	$params = wp_parse_args( $attr, array(
		'title' => 'Your Feature',
		'icon'  => 'flaticon-vector-design',
        'shadow' => 'true'
	) );
	ob_start();
	?>
    <div class="services">
        <div class="service-part <?php echo $params['shadow'] !== 'true'?'no-shadow': '';?>"><i class="<?php echo $params['icon']; ?> animate fadeInLeft" data-wow-delay="0.4s"></i>
			<?php
			if ( ! empty( $params['title'] ) ) {
				echo '<h4>' . $params['title'] . '</h4>';
			}

			echo $content;
			?>

        </div>
    </div>
	<?php
	$output = ob_get_contents();
	ob_get_clean();

	return $output;
}


//[portfolio category="true"]
function portfolio_callback( $attr ){
	$params = wp_parse_args ( $attr, array('nav' => true) );
	ob_start();
	?>
            <!-- Portfolio -->
            <section id="wrk" class="portfolio">
                <div class="container">
                    <!-- Heading Block -->
                    <div class="heading-block text-center margin-bottom-100">
                        <h2>Our Works</h2>
                        <hr>
                    </div>
                </div>
                <div class="container-fluid no-padding">
                	<?php
                	$terms = get_terms( 'portflio-cat', array('hide_empty' => false));
                	?>
                    <!-- PORTOFLIO ITEMS FILTER -->
                    <div class="text-center">
                        <div id="js-filters-awesome-work" class="cbp-l-filters-buttonCenter filter-style-3">
                            <div data-filter="*" class="cbp-filter-item-active cbp-filter-item"> All
                                <div class="cbp-filter-counter"></div>
                            </div>
                            <div data-filter=".brand" class="cbp-filter-item"> DESIGN
                                <div class="cbp-filter-counter"></div>
                            </div>
                            <div data-filter=".web" class="cbp-filter-item"> DEVELOPMENT
                                <div class="cbp-filter-counter"></div>
                            </div>
                            <div data-filter=".mob-app" class="cbp-filter-item">ART
                                <div class="cbp-filter-counter"></div>
                            </div>
                            <div data-filter=".photo" class="cbp-filter-item"> VIDEO
                                <div class="cbp-filter-counter"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Item Start -->
                    <div id="js-grid-awesome-work" class="no-space col-4 text-left">


						<?php
						$args = array( 
							'posts_per_page' => 20, 
							'post_type' => 'portflio'
							);
						$portflios = get_posts( $args );


						foreach ( $portflios as $portflio ) : setup_postdata( $portflio ); ?>
							
  						 <!-- Item -->
                        <div class="cbp-item col-md-6 web mob-app photo ui">
                            <div class="port-item">
                                <!-- article img -->
                                <article>
                                	<?php
                                	 $featured_img_url = get_the_post_thumbnail_url( $portflio->ID, 'full' ); 

                                	 ?>
                                	<img src="<?php echo $featured_img_url; ?>" alt="">
                                    <!-- Portfolio Hover -->
                                    <div class="port-hover">
                                        <div class="position-bottom">
                                            <div class="animated fadeInUp">
                                                <h6>
                                                	<a href="ajax-work/project1.html" class="cbp-singlePage">
                                                		<?php echo get_the_title( $portflio->ID ) ;?>
                                                	</a>
                                                	<a href="images/portfolio/img-1.jpg" 
                                                	class="cbp-lightbox"
                                                    data-title="">
                                                    <i class="icon-magnifier"></i></a> <a
                                                            href="ajax-work/project1.html" class="cbp-singlePage link"
                                                            rel="nofollow"><i class="icon-link"></i> </a></h6>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>

						<?php endforeach; 
						wp_reset_postdata();?>


                    </div>

                    <!-- LOAD MORE -->
                    <div class="text-center margin-top-50 animate fadeInUp" data-wow-delay="0.4s">
                        <div id="js-loadMore-awesome-work"><a href="ajax-work/loadMore-portfolio-1.html"
                                                              class="cbp-l-loadMore-link btn" rel="nofollow"> <span
                                        class="cbp-l-loadMore-defaultText">SHOW MORE</span> <span
                                        class="cbp-l-loadMore-loadingText">LOADING...</span> <span
                                        class="cbp-l-loadMore-noMoreLoading">NO MORE WORKS</span> </a></div>
                    </div>
                </div>
            </section>


	<?php
	$output = ob_get_contents();
	ob_get_clean();
	return $output;

}
add_shortcode('portfolio', 'portfolio_callback');
function accordion_callback($attr, $content = null ){
    $html =  "<div class='panel-group accordion padding-top-20'>";
    $html .= do_shortcode( $content );
    $html .= '</div>';
    return $html;
}
add_shortcode('accordion', 'accordion_callback');

function accordion_item_callback( $attr, $content = null ){
    $default = array('title' => 'Here is the title');
    $params = wp_parse_args( $attr, $default );

    $id = sanitize_title( $params['title'] );

    $html = '<div class="panel panel-default">';
    $html .= ' <div class="panel-heading">';
    $html .= '<h4 class="panel-title"><a data-toggle="collapse" aria-expanded="false" data-parent="#accordion" href="#'.$id.'">'.$params['title'].'</a></h4>';
    $html .= '</div><!--panel heading-->';
    $html .= '<div class="panel-collapse collapse" aria-expanded="false" id="'.$id.'">';
    $html .= '<div class="panel-body">';
    $html .= $content;
    $html .= '</div><!--panel body-->';
    $html .= '</div><!--panel-collapse-->';
    $html .= '</div>';

    return $html;
}
add_shortcode('accordion_item', 'accordion_item_callback');

function counter_callback( $attr ){
    $default = array( 
        'icon' => 'icon-target',
        'number' => '1500+',
        'text' => 'Creative Template'
    );
    $params = wp_parse_args ( $attr, $default );

    $html = '<span class="milestone counters">';
    $html .= '<i class="'.$params['icon'].' animate fadeInDown animated" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s;"></i>';
    $html .= '<span class="counter">'.$params['number'].'</span>';
    $html .= '<p>'.$params['text'].'</p>';
    $html .= '</span>';

    return $html;
}
add_shortcode('counter', 'counter_callback');
