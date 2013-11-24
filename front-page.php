<?php get_header(); ?>
<div style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/header-big.jpg');background-repeat:repeat-x;min-height:581px;width:100%;background-color:#EBF0F6;">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>			
			<?php the_content(); ?>
<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>
</div>
<?php get_footer(); ?>
