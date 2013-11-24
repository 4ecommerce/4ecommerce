<?php get_header(); ?>
<div style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/header-sun.png');width:100%;background-repeat:repeat-x;background-color:#E9F0F8;">
<div class="container" style="padding-top:10px;">	

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
 <h1 class="text-center" style="font-size: 45px;font-weight: 300; margin-bottom: 20px;color: #3a6697;"><?php echo get_the_title($post->post_parent!=0?$post->post_parent:get_the_ID()); ?></h1>
 <?php get_breadcrumbs(); ?>
  <div class="row">	
	  <div style="color:#666; line-height: 180%; margin-bottom: 20px;padding-top:10px;"><?php the_content(); ?></div>
  </div>
	<?php endwhile; else: ?>
		<p><?php _e('Sorry, this page does not exist.'); ?></p>
	<?php endif; ?>
 

</div>
</div>
<div style="background-color:#EBF0F6;">
<div class="container text-center" style="padding-top:30px;">
     <img src="/wp-content/themes/4ecommerce/img/turbo.png"><p></p>
<h1 style="font-size: 40px; font-weight: bold; text-align: center; margin-bottom: 20px;color: #3a6697;">A JAK MOŻEMY WESPRZEĆ TWÓJ BIZNES?</h1>
<p><a class="btn btn-success btn-lg" data-spy="scroll" href="/kontakt">Skontaktuj się z nami! »</a>
  </p></div>
  </div>
<?php get_footer(); ?>