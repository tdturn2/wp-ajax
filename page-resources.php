  <a class="js-filter-item" href="/resources">All</a>
		<?php 
  		$cat_args = array(
    		'exclude' =>array(1),
    		'option_all' => 'All'
  		);
  		
  		$categories = get_categories($cat_args);
  		
  		foreach($categories as $cat) :?>
  		
  		<a data-category="<?=$cat->term_id;?>" class="js-filter-item" href="<?= get_category_link($cat->term_id);?>"><?= $cat->name; ?></a>
  		
  		<?php endforeach;	?>
		
		
		
      <div class="articles js-filter">
  		<?php
    $args = array(
				'post_type' => 'post',
				'posts_per_page' => -1
    );

    $query = new WP_Query($args);
    
    if($query->have_posts() ) {
        while($query->have_posts() ) {
            $query->the_post();
            ?>

  				   <a class="article" href="<?php echo get_permalink(); ?>">
  						<div class="article-image" style="background: url(<?php the_post_thumbnail_url(); ?>);background-size: cover; "></div>
  						<div class="article-description">
  							<h2><?php the_title(); ?></h2>
  							<h3><?php the_author_meta( 'first_name');?> <?php the_author_meta( 'last_name');?></h3>
  							<p><?php the_excerpt(); ?></p>
  						</div>
             </a>
            <?php
						 }
        }       
      ?>

    <?php endwhile; ?>
    <?php endif; 
    
 </div>