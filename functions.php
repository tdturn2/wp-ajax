<?php
  add_action('wp_enqueue_scripts','add_scripts');	
	
	function load_scripts() {
  	wp_enqueue_script('ajax', '/wp-content/themes/cpi/js/ajax.js', array('jquery'), NULL, true);
    wp_localize_script('ajax' , 'wp_ajax', array('ajax_url' => admin_url('admin-ajax.php')) );

	}
	
	
	add_action('wp_ajax_nopriv_filter', 'filter_ajax');
  add_action('wp_ajax_filter','filter_ajax');
 
  function filter_ajax() {
        $category = $_POST['category'];
    
     $args = array(
				'post_type' => 'post',
				'posts_per_page' => -1
    );
    
    if (isset($category)) {
      $args['category__in'] = array($category);
    }
    
    $query = new WP_Query($args);
    
    ?>
    <div class="articles">
      <?php
      if ($query->have_posts()) :
        while($query->have_posts()) : $query->the_post();
      ?>        
        <a class="article" href="<?php the_permalink(); ?>">
  						<div class="article-image" style="background: url(<?php the_post_thumbnail_url(); ?>);background-size: cover; "></div>
  						<div class="article-description">
  							<h2><?php the_title(); ?></h2>
  							<h3><?php the_author_meta( 'first_name');?> <?php the_author_meta( 'last_name');?></h3>
  							<p><?php the_excerpt(); ?></p>
  						</div>
             </a>
        
        <?php 
      endwhile;
    endif;
    ?> </div><?php 
  wp_reset_postdata();
    
    
    die();
    

  }
  
  
  
?>