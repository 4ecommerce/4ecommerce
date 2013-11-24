<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/header-big.jpg');">	
	<?php the_content(); ?>
	</div>
<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<?php get_footer(); ?>
