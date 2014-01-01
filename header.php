<?php
if (is_404()) {
	$redirectHome = get_option('home');
	echo $redirectHome;
}
?>
 <!DOCTYPE html>
 <html lang="en">
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php bloginfo('name'); ?></title>
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Le styles -->
    <link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">    
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,800&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->  
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-43901710-1']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();	
	</script>
    <?php wp_enqueue_script("jquery"); ?>
    <?php wp_head(); ?>

  </head>
  <body>
  
  <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo home_url( '/' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/logo-small.png" align="top"/></a>
        </div>
        <div class="navbar-collapse collapse" style="font-size:14px;padding-top:3px;">
          <ul class="nav navbar-nav">
            <?php wp_list_pages(array('title_li' => '', 'exclude' => 4,'depth' => 1)); ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <?php  if(!isset($_COOKIE['accept_cookie'])): ?>
    <div class="container">
    	<div class="alert alert-warning alert-dismissable">
  			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  			<strong>Warning!</strong> Best check yo self, you're not looking too good.
		</div>
    </div>    
    <?php endif; ?>
  
