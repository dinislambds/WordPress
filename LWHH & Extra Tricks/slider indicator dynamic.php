<!-- Begin #carousel-section -->
    <section id="carousel-section" class="section-global-wrapper"> 
        <div class="container-fluid-kamn">
            <div class="row">
                <div id="carousel-1" class="carousel slide">

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        

                    <?php

                    $slider_query = null;
                    $slider_query = new WP_Query( array(
                        'post_type'         => 'slider',
                        'posts_per_page'    => -1,
                        ) );

                        $pre = '_office_master_';
                        $x = 0;
                        while ( $slider_query->have_posts() ) {
                            $x++;
                            $slider_query->the_post();
                            
                            $slider_caption = get_post_meta( get_the_ID(), $pre.'slider_caption', true );
                            ?> 

                        <!-- Begin Slide 1 -->
                        <div class="item <?php if ( $x == 1 ) {
                            echo 'active';
                        } ?>">
                            <?php the_post_thumbnail('slider-pic'); ?>
                            <div class="carousel-caption">
                                <h3 class="carousel-title hidden-xs"> <?php the_title(); ?> </h3>
                                <p class="carousel-body"> <?php echo $slider_caption; ?>  </p>
                            </div>
                        </div>
                        <!-- End Slide 1 -->

                        <?php }  ?>


                      


                    </div>
        


                    <!-- Indicators -->
                    <ol class="carousel-indicators visible-lg">

                        <?php for ($i=0; $i < $x ; $i++) { ?>
                            
                        <li data-target="#carousel-1" data-slide-to="<?php echo $i; ?>" class="<?php if ($i==0) { echo 'active'; } ?>"> </li>
                       
                        <?php } ?>
                    </ol>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-1" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-1" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End #carousel-section -->