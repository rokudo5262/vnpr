<?php
/**
 * @package   Photo Contest WordPress Plugin
 * @author    Zbyněk Hovorka
 * @link      http://www.contest.w4y.cz/
 * @copyright 2014 Zbyněk Hovorka
 */
 
 //Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
	die;
}
//Redirect if is user not admin
if ( !current_user_can( 'manage_options') ) {
	wp_redirect(admin_url().'admin.php?page=photo-contest-tools');
}
 
global $wpdb;
$user_ID = get_current_user_id();

$contest_id = $_GET['contest-id'];
//Redirect if the contest is not set
if (empty ($contest_id)) {
	wp_redirect(admin_url().'admin.php?page=photo-contest-tools');
}

$items = $_GET['items'];
//Redirect if items are not select
if (empty ($items)) {
	wp_redirect(admin_url().'admin.php?page=photo-contest-tools');
}
//Get the selected items to array
$items_array=explode(',',$items);

//Check the contest
$related_contest= $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."photo_contest_list WHERE id = ".$contest_id);

//If contest not exist redirection
if (empty ($related_contest)) {
	wp_redirect(admin_url().'admin.php?page=photo-contest-tools');
}

$categories  = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_cat WHERE related_to_contest = " . $contest_id . "");

//If exist categries
if (!empty ($categories)) {
	$category_options ='';

	foreach($categories as $item){
	    $category_options .= '<option value="'.$item->id.'">'.$item->name.'</option>';
    }
}


//Submit images
if (isset($_POST['submit_items']) and current_user_can( 'manage_options')){
	//Include functions
	include_once (plugin_dir_path( __DIR__ ) ."pc-upload-functions.php");
	//Get user info
	$current_user = wp_get_current_user();
	//Get location
    $country = pc_getLocationInfoByIp($_SERVER['REMOTE_ADDR']);
	
	$contest_user_images = 'contest_user_images_' . $contest_id;
	$number_images = get_user_meta($user_ID, $contest_user_images, true);
	
	
	foreach ($items_array as $image){
		if(!empty($image)){ 
		  if ( FALSE === get_post_status($image) ) {
			  // The post does not exist
			}else {
				if(!isset($_POST['error_'.$image])){
					update_post_meta($image, 'photo-upload-ip', $_SERVER['REMOTE_ADDR']);
					update_post_meta($image, 'contest-active', 1);
					update_post_meta($image, 'photo-related-to-contest', $contest_id);
					update_post_meta($image, 'contest-photo-points', 0);
					update_post_meta($image, 'contest-photo-author', $user_ID);
					update_post_meta($image, 'contest-user-name', $current_user->display_name);
					update_post_meta($image, 'contest-user-email', $current_user->user_email);
					update_post_meta($image, 'image-country', $country);
					
					//Category
					if (isset($_POST['category_'.$image]) and !empty($_POST['category_'.$image])) {
							$im_category = $_POST['category_'.$image];
							update_post_meta($image, 'contest-photo-category', $im_category);
					} else {
							update_post_meta($image, 'contest-photo-category', 900000);
					}
					
					//Update Title
					$my_post = array(
					'ID'           => $image,
					'post_title'   => $_POST['title_'.$image],
					'post_content' => $_POST['description_'.$image],
					);
					wp_update_post( $my_post );
					$number_images++;
			  }	
			}
		}
	}
	
	//update user image count

	$number_images = $number_images;
	
	update_user_meta($user_ID, $contest_user_images, $number_images);
	
	wp_redirect(admin_url().'admin.php?page=photo-contest-tools&upload=success');
}


?>
<form method="post" id="submitform" action=""></form>


<div class="wrap">
  <div class="modern-p-form p-form-modern-steelBlue">
    <div data-base-class="p-form" class="p-form p-bordered">
    
        <div class="p-title"><span class="p-title-line"><?php echo __('Bulk image upload','photo-contest');?>&nbsp;&nbsp;<i class="fa fa-upload"></i></span></div>
        
        <p>* <?php echo __('Titles of images are taken from the WordPress Media Library. You can change them or not','photo-contest');?></p>
        
        <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side">(<?php echo count($items_array);?>) <?php echo __('Selected item(s) will be added to the contest:','photo-contest');?> <?php echo $related_contest->contest_name;?></span></div> 
        <div class="row">
        
        <?php foreach ($items_array as $image){ 
		 if(!empty($image)){ 
		  if ( FALSE === get_post_status( $image ) ) {
          // The post does not exist
          } else {
			$image_attributes = wp_get_attachment_image_src( $image, 'thumbnail' );
			$attachment_title = get_the_title($image);
			$checkimage= get_post_meta($image,'photo-related-to-contest',true);
			$metadata = get_post_meta($image,'_wp_attachment_metadata',true);
			
			$metadata_error=false;
			if($metadata["width"] < 350 or $metadata["height"] < 350){
             $metadata_error=true;
            }
			
		
		if(empty($checkimage) and $metadata_error==false){
        ?>
        
            <div class="pc-box-image">
            
             <div class="col-sm-8">         
             <div class="form-group">
                <label for="title_<?php echo $image?>" class="p-label-required"><?php echo __('Title','photo-contest');?></label>
                <div class="input-group p-has-icon">
                <input form="submitform" type="text" id="title_<?php echo $image?>" name="title_<?php echo $image?>" placeholder="<?php echo __('Title','photo-contest');?>" required class="form-control" value="<?php echo $attachment_title;?>">
                <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-pencil-square-o"></i></span></div>
             </div>
             
             <?php if (!empty ($categories)) { ?>
               <div class="form-group">
               <label for="category_<?php echo $image?>"><?php echo __('Category','photo-contest');?> <small>(<?php echo __('Optional','photo-contest');?>)</small></label>
               <div class="input-group p-has-icon">
                <label class="input-group p-custom-arrow">
                <select id="category_<?php echo $image?>" name="category_<?php echo $image?>" class="form-control" form="submitform">
                <option value=""><?php echo __('Select a Category','photo-contest');?></option>
                <?php echo $category_options;?>
                </select>
                <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="p-select-arrow"><i class="fa fa-caret-down"></i></span></label>
                <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-pencil-square-o"></i></span>
               </div>
               </div>
               <?php }?>
    
            
             </div><!--col-sm-8 End-->
             
             <div class="col-md-4">
                <img src="<?php echo $image_attributes[0];?>">
             </div><!--col-sm-4 End-->
             
             <div class="col-sm-12">
             <div class="form-group"><label for="description_<?php echo $image?>"><?php echo __('Description','photo-contest');?>  <small>(<?php echo __('Optional','photo-contest');?>)</small></label><div class="input-group p-has-icon"><textarea id="description_<?php echo $image?>" form="submitform" name="description_<?php echo $image?>" class="form-control" style="z-index: 2; position: relative; line-height: 20px; font-size: 14px; transition: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0);"></textarea><span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-file-text-o"></i></span></div></div>
             </div><!--col-sm-12 End-->
            
            <div class="pc-clear"></div>
            </div><!--pc-box-image-->
            
            <?php }else{ //if is image already in the contest
              if($metadata_error==true){	
			  		$title= __('Min width or height for the contest is 350px!','photo-contest');	
			  }else{	
			  		$title= __('This image already is in the some contest','photo-contest');	
			  }
			?>
            
            <div class="pc-box-image" style="background-color: #ececec;">
            
             <div class="col-sm-8">
                      
                 <div class="form-group">
                    <label for="" class="p-label-required" style="color:#F00"><?php echo $title ;?></label>
                    <div class="input-group p-has-icon">
                    <input disabled="disabled" type="text" id="text_error" placeholder="xxxxxxxx" class="form-control" value="xxxxxxxx">
                    <input type="hidden" form="submitform" id="error_<?php echo $image?>" name="error_<?php echo $image?>" value="error_<?php echo $image?>">
                    <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-pencil-square-o"></i></span></div>
                 </div>
                 
                  <?php if (!empty ($categories)) { ?>
                    <div class="form-group">
                    <label for=""><?php echo __('Category','photo-contest');?> <small>(<?php echo __('Optional','photo-contest');?>)</small></label>
                    <div class="input-group p-has-icon">
                    <label class="input-group p-custom-arrow">
                    <select disabled="disabled" id="category_<?php echo $image?>"  class="form-control">
                    <option value="">xxxxxxxx</option>
    
                    </select>
                    <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="p-select-arrow"><i class="fa fa-caret-down"></i></span></label>
                    <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-pencil-square-o"></i></span>
                    </div>
                    </div>
                   <?php }?>
    
             </div><!--col-sm-8 End-->
             
             <div class="col-md-4">
                <img src="<?php echo $image_attributes[0];?>">
             </div><!--col-sm-4 End-->
             
             <div class="col-sm-12">
             <div class="form-group"><label for="description_<?php echo $image?>"><?php echo __('Description','photo-contest');?>  <small>(<?php echo __('Optional','photo-contest');?>)</small></label><div class="input-group p-has-icon"><textarea disabled="disabled" id="description_<?php echo $image?>" name="description_<?php echo $image?>" class="form-control" style="color:#F00;z-index: 2; position: relative; line-height: 20px; font-size:16px; transition: none; background: none 0% 0% / auto repeat scroll padding-box border-box rgba(0, 0, 0, 0);"><?php echo __('This image will be not added to the contest!','photo-contest');?></textarea><span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-file-text-o"></i></span></div></div>
             </div><!--col-sm-12 End-->
            
            <div class="pc-clear"></div>
            </div><!--pc-box-image-->
            
            

	         <?php } }}} ?>
             
            <div class="col-sm-12">
                <div class="form-group">
                     <button class="pc-btn" type="submit" form="submitform" name="submit_items"><i class="fa fa-toggle-on"></i>&nbsp;<?php echo __('Submit all photos to the contest!','photo-contest');?></button>
                </div>
            </div>
             
             </div><!--Row End-->
        
    </div><!--p-form End-->
  </div><!--modern-p-form End-->
</div><!--Wrap End-->