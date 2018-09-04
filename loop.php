<?php

   if(have_posts()){
   	while(have_posts(){
   		the_post();

   		// Loop codes
   	}
   } else{
   	echo 'No post found!'
   }

   wp_reset_postdata();



   // Easy way by WordPress

   if ( have_posts() ) : 
   	 while ( have_posts() ) : the_post();  

/* the rest of your theme's main loop */

 endwhile; ?>

 /*Add the pagination functions here. */

<div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>
<div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>

<?php else : ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>