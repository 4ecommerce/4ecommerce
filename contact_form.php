<?php /* Template Name: ContactForm */ ?>
<?php get_header(); ?>
<div style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/header-sun.png');background-repeat:repeat-x;width:100%;background-color:#E9F0F8;">
<div class="container" style="padding-top:10px;">	

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
 <?php
 $msg = null;
 $errors = array();  
 if(isset($_POST) && count($_POST)>0){
 	$errors = valid_contact_form(); 
 	if(count($errors)==0){
 		if(send_contact_email()){
 			unset($_POST);
 			wp_redirect('/kontakt?sent=ok'); 			 			
 		}else{
 			$errors[] = 'Wystąpił błąd podczas wysyłania wiadomości!';
 		}
 		
 	}
 }
 if(isset($_GET['sent'])){
 	$msg = 'Dziękujemy za zainteresowanie produktem - skontaktujemy się z Tobą wkrótce!';
 }
 ?>
 <h1 class="text-center" style="font-size: 45px;font-weight: 300; margin-bottom: 20px;color: #3a6697;"><?php echo get_the_title($post->post_parent!=0?$post->post_parent:get_the_ID()); ?></h1>
 <?php get_breadcrumbs(); ?>
  <div class="row">	
	  <div style="color:#666; line-height: 180%; margin-bottom: 20px;padding:30px;background-color: #fff; border-radius: 4px;">
	 <?php the_content(); ?>	
	 	<?php echo isset($msg)?'<div class="alert alert-success">'.$msg.'</div>':''; ?>  
	   	  <form role="form" method="POST">
	   	  <?php
			if(count($errors)>0){
				echo '<div class="alert alert-danger">';
		    	echo '<ul  style="font-size:12px;">';
				foreach($errors as $e){
					echo '<li>'.$e.'</li>';							    	
				}
		    	echo '</ul></div>';
			}
	   	  ?>
	   	  <div class="row">
			  <div class="col-lg-4">					  			    
			    	<label for="firstname">Imię</label>			    				 
			    	<input type="text" class="form-control" id="firstname" placeholder="Podaj swoje imię" name="firstname" value="<?php echo isset($_POST['firstname'])?$_POST['firstname']:''; ?>">			    				    
			  </div>
			   <div class="col-lg-4">			   					      
			    	<label for="lastname">Nazwisko</label>			    				
			    	<input type="text" class="form-control" id="lastname" placeholder="Podaj swoje nazwisko" name="lastname" value="<?php echo isset($_POST['lastname'])?$_POST['lastname']:''; ?>">			    
			  </div>
		 </div>
		 <div class="row">
			   <div class="col-lg-4">				   				     
			    	<label for="email">Twój e-mail</label>			    				
			    	<input type="text" class="form-control" id="email" placeholder="Podaj swój e-mail" name="email" value="<?php echo isset($_POST['email'])?$_POST['email']:''; ?>">			    
			  </div>
			   <div class="col-lg-4">			   					     
			    	<label for="company">Nazwa firmy</label>			    				
			    	<input type="text" class="form-control" id="company" placeholder="Podaj nazwę firmy" name="companyname" value="<?php echo isset($_POST['companyname'])?$_POST['companyname']:''; ?>">			    
			  </div>
		</div>
		<div class="row">
			   <div class="col-lg-4">			   					     
			    	<label for="email">Czym się zajmujesz w firmie</label>			    				 
			    	<input type="text" class="form-control" id="person_status" placeholder="Twoje stanowisko" name="person_status" value="<?php echo isset($_POST['person_status'])?$_POST['person_status']:''; ?>">			    
			  </div>		
		</div>
		 <div class="row">
			   <div class="col-lg-8">			      
			    	<label for="storeurl">URL sklepu internetowego</label>			
			    	<input type="text" class="form-control" id="storeurl" placeholder="http://www.mojsklep.pl" name="shop_url" value="<?php echo isset($_POST['shop_url'])?$_POST['shop_url']:''; ?>">			    
			  </div>		
		</div>	
				 <div class="row">
			   <div class="col-lg-4">			      
			    	<label for="plan">Interesuje mnie usłga w abonamencie</label>
			    	<select class="form-control" id="plan" name="plan">
			    		<option>START-UP - 250 PLN</option>
			    		<option>SMALL - 500 PLN</option>
			    		<option>MEDIUM - 850 PLN</option>
			    		<option>LARGE - 1500 PLN</option>
			    		<option>ENTERPRISE od 2999</option>
			    	</select>			 			    				    
			  </div>		
			</div><br/>
			<input type="submit" value="Wyślij wiadomość!" class="btn btn-primary btn-lg"/>			  	  
		  </form>
      </div>
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
<p><a class="btn btn-success btn-lg" data-spy="scroll" href="#">Skontaktuj się z nami! »</a>
  </p></div>
  </div>
<?php get_footer(); ?>