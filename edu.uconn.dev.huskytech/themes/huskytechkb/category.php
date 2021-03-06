<?php
/**
* Huskytech Category Template
*/
?> 
<p> <?php $title=single_cat_title("",false);?> </p> 
<?php $term = get_term_by('name', $title, 'category');?>

  <div class="wrapper">
      <?php 
      get_header();
	  $current_url=get_stylesheet_directory_uri();
	  $main_url=$current_url.'/img/services.gif'; ?>
    <div class="category-temp topcategoryrow1 row-fluid">
    	<img class="category-temp category-image" src="<?php echo $main_url ?>" alt="software/accounts icon">
    	<h2 class="category-temp category-title"> <?php echo $title; ?> </h2>
    </div>
    <div class="rowbottom category-temp topcategoryrow2 row-fluid">
            <div class="span2">
            <form class="category-temp" action="<?php bloginfo('url'); ?>/" method="get">
            <?php 
			  $term = get_term_by('name', $title, 'category');
			  $id = $term->term_id;
			?>
				<?php
				  $catargs = array(
					  'show_count' => 0,
					  'orderby' => 'name',
					  'echo' => 0,
					  'child_of' => $id,
				  );
				  $select = wp_dropdown_categories($catargs);
				  $select = preg_replace("#<select([^>]*)>#", "<select$1 onchange='return this.form.submit()'>", $select);
				  echo $select;
				?>
              <noscript><input type="submit" value="View" /></noscript>
              </form>
        </div>
    </div>
    <div class="rowbottom topcategoryrow3 category-temp row-fluid">
		  <?php $software_query = new WP_Query( array( 'posts_per_page' => '10', 'cat' => $id, 'orderby' => 'date', 'include_children'=>true) ); ?>
			<?php if ( $software_query->have_posts() ) : ?>
  				<?php while ( $software_query->have_posts() ) : $software_query->the_post(); ?>
               				<?php get_template_part('content','search'); ?>
              	<?php endwhile; ?>
     		<?php endif; ?>
     		<?php wp_reset_postdata();
			wp_reset_query(); ?>
    </div>

<?php get_template_part('content','categories'); ?>
        
<?php get_footer(); ?>
</div>