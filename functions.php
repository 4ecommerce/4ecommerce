<?php
function wpbootstrap_scripts_with_jquery()
{
	// Register the script like this for a theme:
	wp_register_script( 'custom-script', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ) );
	// For either a plugin or a theme, you can then enqueue the script:
	wp_enqueue_script( 'custom-script' );
}

function the_sidebar($args = '') {
	$defaults = array(
		'depth' => 0, 'show_date' => '',
		'date_format' => get_option('date_format'),
		'child_of' => 0, 
		'echo' => 1,
		'authors' => '', 'sort_column' => 'menu_order, post_title',
		'link_before' => '', 'link_after' => '', 'walker' => '',
	);
	
	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );

	$output = '<div class="list-group">';
	$current_page = 0;
	
	$pages = get_pages($r);

	global $wp_query;
	if ( is_page() || is_attachment() || $wp_query->is_posts_page ){
		$current_page = $wp_query->get_queried_object_id();
		array_unshift($pages,$wp_query->get_queried_object());
					
	}
	
	
	if ( !empty($pages) ) {
		foreach($pages as $page){
			if($current_page == $page->ID){
					$output .= '<a href="'.get_permalink($page->ID).'" class="list-group-item active">'.$page->post_title.'</a>';
			}else{
				$output .= '<a href="'.get_permalink($page->ID).'" class="list-group-item">'.$page->post_title.'</a>';
			}
		}
	}
	$output .= '</div>';
	
	if ( $r['echo'] )
		echo $output;
	else
		return $output;
}

function get_breadcrumbs()
{
    global $wp_query;

    if ( !is_home() ){

        // Start the UL
        echo '<ol id="crumbs" class="breadcrumb" style="background-color:transparent;">';
        // Add the Home link
        echo '<li><a href="'. get_settings('home') .'">'. get_bloginfo('name') .'</a></li>';

        if ( is_category() )
        {
            $catTitle = single_cat_title( "", false );
            $cat = get_cat_ID( $catTitle );
            echo "<li>  ". get_category_parents( $cat, TRUE, "  " ) ."</li>";
        }
        elseif ( is_archive() && !is_category() )
        {
            echo "<li>  Archives</li>";
        }
        elseif ( is_search() ) {

            echo "<li>  Search Results</li>";
        }
        elseif ( is_404() )
        {
            echo "<li>  404 Not Found</li>";
        }
        elseif ( is_single() )
        {
            $category = get_the_category();
            $category_id = get_cat_ID( $category[0]->cat_name );

            echo '<li>  '. get_category_parents( $category_id, TRUE, "  " );
            echo the_title('','', FALSE) ."</li>";
        }
        elseif ( is_page() )
        {
            $post = $wp_query->get_queried_object();

            if ( $post->post_parent == 0 ){

                echo "<li>  ".the_title('','', FALSE)."</li>";

            } else {
                $title = the_title('','', FALSE);
                $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
                array_push($ancestors, $post->ID);

                foreach ( $ancestors as $ancestor ){
                    if( $ancestor != end($ancestors) ){
                        echo '<li>  <a href="'. get_permalink($ancestor) .'">'. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</a></li>';
                    } else {
                        echo '<li>  '. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</li>';
                    }
                }
            }
        }

        // End the UL
        echo "</ol>";
    }
}

function the_breadcrumb() {
    echo '<ol id="crumbs" class="breadcrumb" style="background-color:transparent;">';
    if (!is_home()) {
        echo '<li><a href="';
        echo get_option('home');
        echo '">';
        echo '4ecommerce.pl';
        echo "</a></li>";
        
        if (is_category() || is_single()) {
            echo '<li>';
            the_category(' </li><li> ');
            if (is_single()) {
                echo "</li><li>";
                the_title();
                echo '</li>';
            }
        } elseif (is_page()) {
            echo '<li class="active">';
            echo the_title();
            echo '</ol>';
        }
    }
    elseif (is_tag()) {single_tag_title();}/*
    elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
    elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
    elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
    elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog                 Archives"; echo'</li>';}
    elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}*/
    echo '</ol>';
}

function isEmail($email){
    return preg_match('/^[a-z0-9!#$%&\'*+\/=?^`{}|~_-]+[.a-z0-9!#$%&\'*+\/=?^`{}|~_-]*@[a-z0-9]+[._a-z0-9-]*\.[a-z0-9]+$/ui', $email);
}

function isName($name){
	return preg_match('/^[^0-9!<>,;?=+()@#"°{}_$%:]*$/ui', stripslashes($name));
}

function isUrl($url){
	return filter_var($url, FILTER_VALIDATE_URL);
 	return (bool)parse_url($url); 
}

function valid_contact_form(){
	$errors = array();
	if(!isset($_POST['firstname']) || strlen($_POST['firstname'])<3){
		$errors['firstname'] = 'Podaj swoje imię - jest wymagane.';
	}
	
	if(!isset($_POST['lastname']) || strlen($_POST['lastname'])<3){
		$errors['lastname'] = 'Podaj swoje nazwisko - jest wymagane.';
	}
	if(!isset($_POST['email']) || strlen($_POST['email'])<3){
		$errors['email'] = 'Podaj swój adres e-mail - jest wymagane.';
	}
	if(!isset($_POST['companyname'])  || strlen($_POST['companyname'])<3){
		$errors['companyname'] = 'Podaj nazwę firmy którą reprezentujesz - jest wymagana.';
	}
	if(!isset($_POST['shop_url']) || strlen($_POST['shop_url'])<10){
		$errors['shop_url'] = 'Podaj adres URL sklepu internetowego - jest wymagany';
	}
	
	if(!isset($errors['firstname']) && !isName($_POST['firstname'])){
		$errors['firstname'] = 'Twoję imię zawiera niedozwolone znaki - proszę popraw.';
	}

	if(!isset($errors['lastname']) && !isName($_POST['lastname'])){
		$errors['lastname'] = 'Twoję nazwisko zawiera niedozwolone znaki - proszę popraw.';
	}
	
	if(!isset($errors['email']) && !isEmail($_POST['email'])){
		$errors['email'] = 'Twój adres e-mail jest niepoprawny - proszę popraw.';
	}

	if(!isset($errors['companyname']) && !isName($_POST['companyname'])){
		$errors['companyname'] = 'Nazwa Twojej firmy zawiera niedozwolone - proszę popraw.';
	}

	/*if(!isset($errors['companyname']) && !isName($_POST['companyname'])){
		$errors['companyname'] = 'Nazwa Twojej firmy zawiera niedozwolone - proszę popraw.';
	}*/
		
	if(!isset($errors['shop_url']) && !isUrl($_POST['shop_url'])){
		$errors['shop_url'] = 'Adres URL sklepu internetowego jest nie poprawny - proszę popraw.';
	}

	return $errors;
}

function send_contact_email(){
	$content = "Formularz kontaktowy.\n";
	$content .= "Osoba kontaktowa: ".$_POST['firstname']." ".$_POST['lastname']."\n";
	$content .= "Firma: ".$_POST['companyname']."\n";
	$content .= "Adres e-mail kontaktowy: ".$_POST['email']."\n";
	if(isset($_POST['person_status'])){
		$content .= "Stanowisko osoby: ".$_POST['person_status']."\n";
	}
	$content .= "Url sklepu internetowego: ".$_POST['shop_url']."\n";
	$content .= "Plan abonamentowy: ".$_POST['plan']."\n";
	try{
	return wp_mail('info@4ecommerce.pl','Formularz kontaktowy 4ecommerce',$content);
	}catch(Exception $e){
		var_dump($e);
	}
}

add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );
?>