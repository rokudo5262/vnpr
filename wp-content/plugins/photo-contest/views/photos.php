<?php

 //Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
	die;
}

//Remove all possible forced image filters
remove_all_filters( 'pre_get_posts', 10 );

//Admin functions

include_once (plugin_dir_path( __DIR__ ) ."includes/pc-gallery-functions.php");

	global $wpdb;
	$sql= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_cat ORDER BY name ASC");
	$sql2= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_list ORDER BY contest_name ASC");

	//Basic options
	$image_approval_email = get_option( 'pcplugin-image-approval-email' );
	if ($image_approval_email==1){
		include_once (plugin_dir_path( __DIR__ ) ."includes/admin/pc-admin-functions.php");
	}
  //Get some options
	$date_format = get_option('date_format', true);
	$time_format = get_option('time_format', true);
	$allow_GDPR_option = get_option('pcplugin-allow-GDPR');

	//Change category
	if (isset ($_POST['category_selected']) and current_user_can( 'manage_options')) {
		 $category_id = $_POST['category_selected'];
		 if(empty($category_id)){
			 $category_id = 900000;
		 }
		 $item_id = $_POST['item_id'];
		 update_post_meta($item_id, 'contest-photo-category', $category_id);
	}
	//Change activate
	if(isset($_POST['item_id_2']) and current_user_can( 'manage_options')){
    $item_id = $_POST['item_id_2'];
		if(isset($_POST['activate'])){
			update_post_meta($item_id,'contest-active',1);
		  if($image_approval_email==1){
		    pc_approval_notification($item_id);
		  }
		}else{
			update_post_meta($item_id,'contest-active',0);
		}
	}
	//Change votes
	if(isset($_POST['votes']) and current_user_can( 'manage_options') and is_numeric($_POST['votes'])){
		$item_id = $_POST['item_id'];
		update_post_meta($item_id,'contest-photo-points',$_POST['votes']);
	}
	//Update Items Per Page
	if (isset($_POST['results-per-page']) and current_user_can( 'manage_options')){
		$post_per_page = update_option( 'pcplugin-photos-number', $_POST['results-per-page'] );
	}
	//Delete the image
	if(isset($_GET['delete']) and current_user_can( 'manage_options')){
		pc_delete_the_image($_GET['delete']);
		wp_redirect(admin_url().'admin.php?page=photo-contest-photos&paged='.$_GET['paged']);

	}
	//IF - Delete
	if(isset($_POST['delete_items']) and isset($_POST['checked_items']) and !empty($_POST['checked_items']) and current_user_can( 'manage_options')){
		 // Loop
		 foreach($_POST['checked_items'] as $item_id){
			pc_delete_the_image($item_id);
		 }
	}
	//IF - Activate selected
	if(isset($_POST['activate_items']) and isset($_POST['checked_items']) and !empty($_POST['checked_items']) and current_user_can( 'manage_options')){
		 // Loop
		 foreach($_POST['checked_items'] as $item_id){
			update_post_meta($item_id,'contest-active',1);
			if($image_approval_email==1){
				pc_approval_notification($item_id);
			}
		 }
	}
	//IF - Deactivate selected
	if(isset($_POST['deactivate_items']) and isset($_POST['checked_items']) and !empty($_POST['checked_items']) and current_user_can( 'manage_options')){
		 // Loop
		 foreach($_POST['checked_items'] as $item_id){
			update_post_meta($item_id,'contest-active',0);
		 }
	}


	//Set post per page
	//Items Per Page
	$post_per_page = get_option( 'pcplugin-photos-number' );
	if (empty($post_per_page)){
		$post_per_page = 10;
	}
	//Set post per page by export
	if (isset ($_POST['csvgenerate']) and current_user_can( 'manage_options')) {
	$post_per_page = -1;
	}
    //Set acutall page
	if(!isset($_GET['paged'])){
	 $paged = 1;
	}else{
	 $paged = $_GET['paged'];
	}

	//Set Category order
    if (isset ($_GET['order-contest'])){
	if ($_GET['order-contest'] == 0){
		 $contest_id = 0;
	     $compare = ">=";
		}else{
	     $contest_id = $_GET['order-contest'];
	     $compare = "EXISTS";
	}
	}else{
	 $contest_id = 0;
	 $compare = ">=";
	}

	//Set Author
	if(isset($_GET['author-id'])){
	 $author_author = $_GET['author-id'];
	}else
	{
	 $author_author = "any";
	}


	//If all get empty
	$orderby = 'post_date';
	$order = 'DESC';
	$active='-1';
	$active_compare='!=';

	$meta_key = 'contest-photo-author';
	$meta_value = '0';
	$meta_compare = '!=';

	$category_meta = 'contest-photo-category';
	$category_key = '0';
	$category_compare = '>=';

	if(isset($_GET['order-category'])){
	  if($_GET['order-category']!='0'){

		  $category_meta = 'contest-photo-category';
		  $category_key = $_GET['order-category'];
		  $category_compare = '=';
		  $orderby = 'meta_value_num';
		  $meta_key = 'contest-photo-points';
		  $meta_value = '-1';
		  $meta_compare = '>=';

	  }
	}

	if(isset($_POST['contest-search'])){
		  $search_term = $_POST['contest-search'];
	}else{
		  $search_term = "";
	}

	if(isset($_GET['gallery-order'])){
	  $_GET['gallery-order'] = $_GET['gallery-order'];

	  if($_GET['gallery-order']=='date-down'){
	  }
	  if($_GET['gallery-order']=='date-up'){
	   $order = 'ASC';
	  }
	  if($_GET['gallery-order']=='points-down'){
	   $orderby = 'meta_value_num';
	   $meta_key = 'contest-photo-points';
	   $meta_value = '-1';
	   $meta_compare = '>=';
	  }
	  if($_GET['gallery-order']=='points-up'){
	   $orderby = 'meta_value_num';
	   $meta_key = 'contest-photo-points';
	   $meta_value = '-1';
	   $meta_compare = '>=';
	   $order = 'ASC';
	  }
		if($_GET['gallery-order']=='rate5-down'){
	   $orderby = 'meta_value_num';
	   $meta_key = 'contest-photo-rate5-total';
	   $meta_value = '1';
	   $meta_compare = '>=';
	  }
	  if($_GET['gallery-order']=='rate5-up'){
	   $orderby = 'meta_value_num';
	   $meta_key = 'contest-photo-rate5-total';
	   $meta_value = '1';
	   $meta_compare = '>=';
	   $order = 'ASC';
	  }
		if($_GET['gallery-order']=='rate10-down'){
	   $orderby = 'meta_value_num';
	   $meta_key = 'contest-photo-rate10-total';
	   $meta_value = '1';
	   $meta_compare = '>=';
	  }
	  if($_GET['gallery-order']=='rate10-up'){
	   $orderby = 'meta_value_num';
	   $meta_key = 'contest-photo-rate10-total';
	   $meta_value = '1';
	   $meta_compare = '>=';
	   $order = 'ASC';
	  }
	  if($_GET['gallery-order']=='activated'){
	   $active='1';
	   $active_compare='=';
	  }
	  if($_GET['gallery-order']=='not-activated'){
	   $active='0';
	   $active_compare='=';
	  }

	}

  $args = array(
        'post_type'      => 'attachment',
        'posts_per_page' => $post_per_page,
        'post_status'    => 'any',
        'post_parent'    => null,
        'meta_query' => array(
					array(
						'key'     => 'contest-active',
						'value'   => $active,
						'compare'   =>$active_compare),
					array(
						'key'     => $category_meta,
						'value'   => $category_key,
						'compare' => $category_compare),
					array(
						'key' => 'photo-related-to-contest',
						'value' => $contest_id,
						'compare' => $compare,
					)
				),
				'meta_key'       => $meta_key,
				'meta_value'     => $meta_value,
				'meta_compare' => $meta_compare,
				'orderby'        => $orderby,
				'order'          => $order,
				's'          => $search_term,
				'paged' => $paged ,
				'author'    => $author_author,
        );

   $arguments = array(
        'post_type'      => 'attachment',
        'posts_per_page' => -1,
        'post_status'    => 'any',
        'post_parent'    => null,
        'meta_query' => array(
           array(
             'key'     => 'contest-active',
             'value'   => $active,
			 'compare'   =>$active_compare),
		   array(
             'key'     => $category_meta,
             'value'   => $category_key,
			 'compare' => $category_compare),
		   array(
			'key' => 'photo-related-to-contest',
			'value' => $contest_id,
			'compare' => $compare,
			)
           ),

        'meta_key'       => $meta_key,
		'meta_value'     => $meta_value,
		'meta_compare' => $meta_compare,
        'orderby'        => $orderby,
	    'order'          => $order,
		's'          => $search_term,
        'paged' => $paged ,
		'author'    => $author_author,
        );

$attach = get_posts( $arguments );
$attachments = get_posts( $args );
$items = count($attach);

//Generate CSV
if (isset ($_POST['csvgenerate']) and current_user_can( 'manage_options')) {
	include_once (plugin_dir_path( __DIR__ ) ."includes/admin/pc-export-data.php");
	$export_attachments = get_posts( $args );
	pc_export_data($export_attachments);
}


?>

<div class="wrap">


<div class="modern-p-form p-form-modern-steelBlue"><div data-base-class="p-form" class="p-form p-bordered">
  <div class="p-title">
  <span class="p-title-line"><?php _e('Contest Photos','photo-contest'); ?>&nbsp;&nbsp;<i class="fa fa-fw fa-camera"></i></span>
  </div>

  <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php echo __('Filters','photo-contest'); ?></span></div>

  <!--//First ROW// -->
        <div class="row">
            <div class="col-sm-12">
            <div class="form-group">
            <form method="post">
            <label for="aresults-per-page"><?php _e('Maximum Items per page','photo-contest'); ?></label>
            <div class="p-form-cg pt-form-inline">
                <div class="radio">
                <label>
                <input type="radio" <?php if($post_per_page == 10){echo 'checked="checked"';} ?> name="results-per-page" value="10" onchange="this.form.submit()">
                <span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">10</span></label>
                </div>
                <div class="radio">
                <label>
                <input type="radio" <?php if($post_per_page == 15){echo 'checked="checked"';} ?> name="results-per-page" value="15" onchange="this.form.submit()">
                <span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">15</span></label>
                </div>
                <div class="radio">
                <label>
                <input type="radio" <?php if($post_per_page == 25){echo 'checked="checked"';} ?> name="results-per-page" value="25" onchange="this.form.submit()">
                <span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">25</span></label>
                </div>
                <div class="radio">
                <label>
                <input type="radio" <?php if($post_per_page == 50){echo 'checked="checked"';} ?> name="results-per-page" value="50" onchange="this.form.submit()">
                <span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">50</span></label>
                </div>
                <div class="radio">
                <label>
                <input type="radio" <?php if($post_per_page == 75){echo 'checked="checked"';} ?> name="results-per-page" value="75" onchange="this.form.submit()">
                <span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">75</span></label>
                </div>
                <div class="radio">
                <label>
                <input type="radio" <?php if($post_per_page == 100){echo 'checked="checked"';} ?> name="results-per-page" value="100" onchange="this.form.submit()">
                <span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">100</span></label>
                </div>
                <div class="radio">
                <label>
                <input type="radio" <?php if($post_per_page == 150){echo 'checked="checked"';} ?> name="results-per-page" value="150" onchange="this.form.submit()">
                <span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">150</span></label>
                </div>
                <div class="radio">
                <label>
                <input type="radio" <?php if($post_per_page == 200){echo 'checked="checked"';} ?> name="results-per-page" value="200" onchange="this.form.submit()">
                <span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">200</span></label>
                </div>
                <div class="radio">
                <label>
                <input type="radio" <?php if($post_per_page == 500){echo 'checked="checked"';} ?> name="results-per-page" value="500" onchange="this.form.submit()">
                <span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">500</span></label>
                </div>
            </div>
            </form>
            </div>
            </div><!--end col 6-->
     </div><!--end row-->
     <?php

  $html = '<div class="row">';
  $html .= '<div class="col-sm-5">';

  $html .= '<form method="get" action="" id="order-by-form">';
  $html .= '<input type="hidden" name="page" value="photo-contest-photos" />';

  $html .= '<div class="form-group">';
  $html .= '<label class="input-group p-custom-arrow">';
  $html .= '<select name="gallery-order" id="gallery-order" class="form-control" onchange="this.form.submit()">';
  $html .= '<option value="date-down"';
    if(isset($_GET['gallery-order']) && $_GET['gallery-order'] == 'date-down'){
      $html .= ' selected="selected" ';
    }
   $html .= '>'.__('Newest','photo-contest').'</option>';
   $html .= '<option value="date-up" ';
    if(isset($_GET['gallery-order']) && $_GET['gallery-order'] == 'date-up'){
      $html .= ' selected="selected" ';
    }
   $html .= '>'.__('Oldest','photo-contest').'</option>';

   $html .= '<option value="points-down" ';
    if(isset($_GET['gallery-order']) && $_GET['gallery-order'] == 'points-down'){
      $html .= ' selected="selected" ';
    }
   $html .= '>'.__('Most Voted','photo-contest').'</option>';

   $html .= '<option value="points-up" ';
    if(isset($_GET['gallery-order']) && $_GET['gallery-order'] == 'points-up'){
      $html .= ' selected="selected" ';
    }
   $html .= '>'.__('Least Votes','photo-contest').'</option>';
   $html .= '<option value="activated" ';
    if(isset($_GET['gallery-order']) && $_GET['gallery-order'] == 'activated'){
      $html .= ' selected="selected" ';
    }
   $html .= '>'.__('Activated','photo-contest').'</option>';
	 $html .= '<option value="rate5-down" ';
    if(isset($_GET['gallery-order']) && $_GET['gallery-order'] == 'rate5-down'){
      $html .= ' selected="selected" ';
    }
   $html .= '>'.__('Top Rated - 5 Stars','photo-contest').'</option>';

   $html .= '<option value="rate5-up" ';
    if(isset($_GET['gallery-order']) && $_GET['gallery-order'] == 'rate5-up'){
      $html .= ' selected="selected" ';
    }
   $html .= '>'.__('Worst Rated - 5 Stars','photo-contest').'</option>';

	 $html .= '<option value="rate10-down" ';
    if(isset($_GET['gallery-order']) && $_GET['gallery-order'] == 'rate10-down'){
      $html .= ' selected="selected" ';
    }
   $html .= '>'.__('Top Rated - 10 Stars','photo-contest').'</option>';

   $html .= '<option value="rate10-up" ';
    if(isset($_GET['gallery-order']) && $_GET['gallery-order'] == 'rate10-up'){
      $html .= ' selected="selected" ';
    }
   $html .= '>'.__('Worst Rated - 10 Stars','photo-contest').'</option>';
   $html .= '<option value="activated" ';
    if(isset($_GET['gallery-order']) && $_GET['gallery-order'] == 'activated'){
      $html .= ' selected="selected" ';
    }
   $html .= '>'.__('Activated','photo-contest').'</option>';
   $html .= '<option value="not-activated" ';
    if(isset($_GET['gallery-order']) && $_GET['gallery-order'] == 'not-activated'){
      $html .= ' selected="selected" ';
    }
   $html .= '>'.__('Not Activated','photo-contest').'</option>';
   $html .= '</select>';
   $html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-fw fa-check"></i></span> <span class="p-error-text"><i class="fa fa-fw fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="p-select-arrow"><i class="fa fa-fw fa-caret-down"></i></span></label>';
   $html .= '</div>';


   //Contest Select box
    if(!empty($sql2)){
   $html .= '<div class="form-group">';
   $html .= '<label class="input-group p-custom-arrow">';
   $html .= '<select name="order-contest" id="order-contest" class="form-control" onchange="this.form.submit()">';

   if (isset ($_GET['order-contest'])){
	 $contestid =  $_GET['order-contest'];
	 }else{
	 $contestid =  0;
	 }
	  $html .= '<option '. (($contestid==0)?'selected="selected"':"").' value="0">'.__('All Contests','photo-contest').'</option>';
   if(!empty($sql2)){
       foreach($sql2 as $item){
	    $html .= '<option '. (($item->id==$contestid)?'selected="selected"':"").' value="'.$item->id.'">'.stripslashes($item->contest_name).'</option>';
       }
        }

   $html .= '</select>';
   $html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-fw fa-check"></i></span> <span class="p-error-text"><i class="fa fa-fw fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="p-select-arrow"><i class="fa fa-fw fa-caret-down"></i></span></label>';
   $html .= '</div>';
   }
   $html .= '</form>';
   $html .= '</div>';//col-5

   $html .= '<div class="col-sm-5">';
   //Category Select Box
   if(!empty($sql)){
   $html .= '<form method="get" action="" id="order-by-category">';
   $html .= '<div class="form-group">';
   $html .= '<label class="input-group p-custom-arrow">';
   $html .= '<input type="hidden" name="page" value="photo-contest-photos" />';
   $html .= '<select name="order-category" id="order-category" class="form-control" onchange="this.form.submit()">';

   if (isset ($_GET['order-category'])){
	 $catid =  $_GET['order-category'];
	 }else{
	 $catid =  0;
	 }
	  $html .= '<option '. (($catid==0)?'selected="selected"':"").' value="0">'.__('All Categories','photo-contest').'</option>';
   if(!empty($sql)){
       foreach($sql as $item){
	    $html .= '<option '. (($item->id==$catid)?'selected="selected"':"").' value="'.$item->id.'">'.stripslashes($item->name).'</option>';
       }
        }
	 $html .= '<option '. (($catid=="900000")?'selected="selected"':"").' value="900000">'.__('Uncategorized','photo-contest').'</option>';
   $html .= '</select>';
   $html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-fw fa-check"></i></span> <span class="p-error-text"><i class="fa fa-fw fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="p-select-arrow"><i class="fa fa-fw fa-caret-down"></i></span></label>';
   $html .= '</div>';
   $html .= '</form>';
   }


   //Search Box
   $html .= '<form method="post" action="./admin.php?page=photo-contest-photos" id="contest-search-form">';
   $html .= '<div class="form-group">';
   $html .= '<div class="input-group">';
   $html .= '<input type="search" id="contest-search" name="contest-search" class="form-control" placeholder="'.__('Search','photo-contest').'">';
   $html .= '<span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-fw fa-check"></i></span> <span class="p-error-text"><i class="fa fa-fw fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-btn">';
   $html .= '<button type="submit" class="pc-btn" ><i class="fa fa-fw fa-search"></i></button>';
   $html .= '</span></div>';
   $html .= '</div>';
   $html .= '</form>';

   $html .= '</div>';//col-5

   $html .= '<div class="col-sm-2">';
   //CSV button
   if (!empty ($attachments)){
   $html .= '<form method="post" action="" id="csvform"  style="width:100%">';
   $html .= '<div class="form-group">';
   $html .= '<label class="input-group p-custom-arrow">';
   $html .= '<input type="hidden" name="csvgenerate" value="csvgenerate" />';

   $html .= '<input type="submit" value="'.__('Export this to CSV!','photo-contest').'" class="exportcsv">';
   $html .= '</div>';
   $html .= '</form>';
   }
   //Export user data
   if (!empty ($attachments)){
   $html .= '<form method="post" action="admin.php?page=photo-contest-tools" id="csvform_user" style="width:100%">';
   $html .= '<div class="form-group">';
   $html .= '<label class="input-group p-custom-arrow">';
   $html .= '<input type="hidden" name="csvgenerate_user" value="csvgenerate_user" />';

   $html .= '<input type="submit" value="'.__('Export Users data!','photo-contest').'" class="exportcsv">';
   $html .= '</div>';
   $html .= '</form>';
   }

   $html .= '</div>';

   $html .= '<div class="clear"></div>';
   $html .= '</div>';
   echo $html;

  ?>

  <?php if (!empty($attachments)) { ?>
    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php echo __('Photos','photo-contest'); ?> - <?php echo $items; ?> <?php echo __('Result(s)','photo-contest'); ?></span></div>
    <?php } ?>
  <?php if (empty($attachments)) { ?>
    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php echo __('Photos','photo-contest'); ?></span></div>
    <?php } ?>

  <?php if (empty($attachments)) { ?>
    <div class="alert alert-valid"><strong><i class="fa fa-fw fa-times"></i> <?php echo __('Notice:','photo-contest');?></strong> <?php echo __('There are no records yet!','photo-contest'); ?></div>
    <?php } ?>

   <?php add_thickbox(); ?>
   <?php if (!empty($attachments)) { ?>
   <form method="post" id="selected_items" action=""></form>
   <table class="pc-responisve">
    <thead>
      <tr>
      <th scope="col" style="width:49px"><div class="checkbox lowmargin">
                <label>
                <input type="checkbox" id="ckbCheckAll">
                <span class="p-check-icon"><span class="p-check-block"></span></span>
                </label>
                </div>
</th>
        <th scope="col"><?php _e('ID','photo-contest'); ?></th>
        <th scope="col"><?php _e('Image','photo-contest'); ?></th>
        <th scope="col"><?php _e('Info','photo-contest'); ?></th>
        <th scope="col"><?php _e('Author','photo-contest'); ?></th>
        <th scope="col"><?php _e('Contest','photo-contest'); ?></th>
        <?php  if(!empty($sql)){ ?>
        <th scope="col"><?php _e('Category','photo-contest'); ?></th>
        <?php  } ?>
        <th scope="col"><?php _e('Votes','photo-contest'); ?></th>
        <th scope="col"><?php _e('Active','photo-contest'); ?></th>
        <th scope="col"><?php _e('Tools','photo-contest'); ?></th>
      </tr>
    </thead>

    <tfoot>
      <tr>
      <th scope="col" style="width:49px"><div class="checkbox lowmargin">
                <label>
                <input type="checkbox" id="ckbCheckAll2">
                <span class="p-check-icon"><span class="p-check-block"></span></span>
                </label>
                </div>
</th>
        <th scope="col"><?php _e('ID','photo-contest'); ?></th>
        <th scope="col"><?php _e('Image','photo-contest'); ?></th>
        <th scope="col"><?php _e('Info','photo-contest'); ?></th>
        <th scope="col"><?php _e('Author','photo-contest'); ?></th>
        <th scope="col"><?php _e('Contest','photo-contest'); ?></th>
        <?php  if(!empty($sql)){ ?>
        <th scope="col"><?php _e('Category','photo-contest'); ?></th>
        <?php  } ?>
        <th scope="col"><?php _e('Votes','photo-contest'); ?></th>
        <th scope="col"><?php _e('Active','photo-contest'); ?></th>
        <th scope="col"><?php _e('Tools','photo-contest'); ?></th>
      </tr>
    </tfoot>

    <tbody id="the-list">
    <?php

if ( $attachments ) {
	foreach ( $attachments as $post ) {
		setup_postdata( $post );

		$photo_active = get_post_meta($post->ID,'contest-active',true);
		$photo_points = get_post_meta($post->ID,'contest-photo-points',true);
		$photo_upload_ip = get_post_meta($post->ID,'photo-upload-ip',true);
		$photo_country = get_post_meta($post->ID,'image-country',true);
		$camera_model = get_post_meta($post->ID,'camera-model',true);
		$custom_field_image = get_post_meta($post->ID,'custom-field',true);
		$blogurl = home_url();

		$author_id = get_post_meta($post->ID,'contest-photo-author',true);
		$user = get_user_by( 'id', $author_id );

		$photo_date = get_the_date( $date_format, $post->ID );

		//Contest
        $photo_related_to_contest = get_post_meta($post->ID,'photo-related-to-contest',true);
		$sql3= $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."photo_contest_list WHERE id = ".$photo_related_to_contest);

		//About User
		$dateofbirth = get_user_meta($author_id, 'pcplugin-dateofbirth', true);
		$address = get_user_meta($author_id, 'pcplugin-adress', true);
		$city = get_user_meta($author_id, 'pcplugin-city', true);
    $zip_code = get_user_meta($author_id, 'pcplugin-zip_code', true);
		$state = get_user_meta($author_id, 'pcplugin-state', true);
		$country = get_user_meta($author_id, 'pcplugin-country', true);
		$gender = get_user_meta($author_id, 'pcplugin-gender', true);
		$gender_3 = get_user_meta($author_id, 'pcplugin-gender_3', true);
		$www = get_user_meta($author_id, 'pcplugin-www', true);
		$phone = get_user_meta($author_id, 'pcplugin-phone', true);
		$facebook = get_user_meta($author_id, 'pcplugin-facebook', true);
		$twitter = get_user_meta($author_id, 'pcplugin-twitter', true);
		$instagram = get_user_meta($author_id, 'pcplugin-instagram', true);
		$custom_field_personal = get_user_meta($author_id, 'pcplugin-custom_field_personal_'.$photo_related_to_contest, true);
		$custom_field_personal_required = get_user_meta($author_id, 'pcplugin-custom_field_personal_required_'.$photo_related_to_contest, true);
		$agree_GDPR = get_user_meta($author_id, 'agree-GDPR', true);


		if ($gender == "male"){$gender= __('Male', 'photo-contest');}
		if ($gender == "female"){$gender= __('Female', 'photo-contest');}
		if ($gender_3 == "male"){$gender_3= __('Male', 'photo-contest');}
		if ($gender_3 == "female"){$gender_3= __('Female', 'photo-contest');}
		if ($gender_3 == "other"){$gender_3= __('Other', 'photo-contest');}
		if (!empty($agree_GDPR)){$agree_GDPR_date = date( $date_format.' - '.$time_format, $agree_GDPR );}

        //Get contest custom fields
		$dateofbirth_setting = $sql3->date_of_birth;
		$city_setting = $sql3->city;
		$address_setting = $sql3->adress;
		$zip_code_setting = $sql3->zip_code;
		$state_setting = $sql3->state;
		$country_setting = $sql3->country;
		$gender_setting = $sql3->gender;
		$gender_3_setting = $sql3->gender_3;
		$www_setting = $sql3->www;
		$phone_setting = $sql3->phone;
		$facebook_setting = $sql3->fb_page;
		$twitter_setting = $sql3->twitter_page;
		$instagram_setting = $sql3->instagram_page;
		$camera_model_setting = $sql3->camera_model;
		$description_setting = $sql3->description;
		$custom_field_personal_setting = stripslashes($sql3->custom_field_personal);
		$custom_field_personal_name = stripslashes($sql3->custom_field_personal_name);
		$custom_field_personal_setting_required = stripslashes($sql3->custom_field_personal_required);
	  $custom_field_personal_name_required = stripslashes($sql3->custom_field_personal_name_required);
		$custom_field_image_setting = stripslashes($sql3->custom_field_image);
		$custom_field_image_name = stripslashes($sql3->custom_field_image_name);

		//If is custom personal field empty
		if (empty($custom_field_personal_name)) {
			$custom_field_personal_name = __('Custom personal field', 'photo-contest');
		}
		//If is custom required personal field empty
		if (empty($custom_field_personal_name_required)) {
			$custom_field_personal_name_required = __('Custom personal field', 'photo-contest');
		}
		//If is custom image field empty
		if (empty($custom_field_image_name)) {
			$custom_field_image_name = __('Custom image field', 'photo-contest');
		}
		$image_attributes = wp_get_attachment_image_src( $post->ID, 'full' );
		?>
      <tr>
      <td scope="row" data-label="<?php echo __('Select','photo-contest'); ?>">
        <div class="checkbox">
        <label>
        <input form="selected_items" type="checkbox" class="checkBoxClass" name="checked_items[]" value="<?php echo $post->ID; ?>">
        <span class="p-check-icon"><span class="p-check-block"></span></span></label>
        </div>
       </td>
        <td scope="row" data-label="<?php _e('ID','photo-contest'); ?>"><?php echo $post->ID; ?></td>
        <td data-label="<?php _e('Image','photo-contest'); ?>"><a class="thickbox" href="<?php echo $image_attributes[0]; ?>"><?php echo wp_get_attachment_image( $post->ID, 'thumbnail' ); ?></a></td>
        <td data-label="<?php _e('Info','photo-contest'); ?>">
        <i class="fa fa-fw fa-fw fa-tag fa-fw" aria-hidden="true"></i> <?php echo $post->post_title; ?><br />
        <i class="fa fa-fw fa-fw fa-calendar" aria-hidden="true"></i> <?php echo $photo_date ?><br />
        <?php if (!empty($photo_upload_ip)){ ?><i class="fa fa-fw fa-fw fa-laptop" aria-hidden="true"></i> <?php echo $photo_upload_ip ?><br /><?php }?>
        <?php if (!empty($photo_country[0])){ ?>
        <i class="fa fa-fw fa-fw fa-globe" aria-hidden="true"></i>
				<?php if (isset($photo_country[2]) and !empty($photo_country[2])){ ?>
        	<img src="<?php echo plugins_url() . '/photo-contest/assets/admin/flags/'.strtolower($photo_country[2]).'.png'; ?> " border="0" alt="" width="16" style="margin-bottom:2px; width:16px; height:11px;"/>
				<?php }?>
        <?php echo $photo_country[0]; ?>  <?php if (!empty($photo_country[1])) echo '('.$photo_country[1].')'; ?> <br />
				<?php }?>

        <?php if (!empty($camera_model) and $camera_model_setting==2){ ?><i class="fa fa-fw fa-fw fa-camera" aria-hidden="true"></i> <?php echo $camera_model ?><br /><?php }?>
        <?php if (!empty($custom_field_image) and $custom_field_image_setting==2){ ?><i class="fa fa-fw fa-pencil-square-o" aria-hidden="true"></i> <?php echo $custom_field_image_name; ?>:<br /> <?php echo $custom_field_image; ?><?php }?>

        </td>
        <?php
		$photo_username = get_post_meta($post->ID,'contest-user-name',true);
		$photo_email = get_post_meta($post->ID,'contest-user-email',true);
		if (!empty ($user))
		{
		$current_url = admin_url().'admin.php';
		$author_url = add_query_arg( array('page' => 'photo-contest-photos','author-id' => $user->ID), $current_url );
		?>
        <td data-label="<?php _e('Author','photo-contest'); ?>">

        <a href="<?php echo $author_url; ?>"><i class="fa fa-fw fa-user" aria-hidden="true"></i> <?php echo $user->display_name; ?></a> - <a href="<?php echo admin_url(); ?>admin.php?page=photo-contest-tools&edit-user=<?php echo $user->ID; ?>"><?php echo __('Edit user','photo-contest'); ?></a><br />
        <a href="mailto:<?php echo $user->user_email; ?>?subject=<?php echo urlencode($sql3->contest_name); ?>"><i class="fa fa-fw fa-envelope" aria-hidden="true"></i> <?php echo $user->user_email; ?></a><br />

				<?php if (!empty($agree_GDPR) and $allow_GDPR_option == 1){ ?>
				<i class="fa fa-fw fa-info" aria-hidden="true"></i>	GDPR - <?php echo $agree_GDPR_date; ?><br />
				<?php }elseif (empty($agree_GDPR) and $allow_GDPR_option == 1){ ?>
				<i class="fa fa-fw fa-info" aria-hidden="true"></i>	GDPR - N/A<br />
				<?php }?>


        <a href="<?php echo get_edit_user_link($author_id); ?>"><i class="fa fa-fw fa-info-circle" aria-hidden="true"></i> <?php _e('Profile','photo-contest'); ?></a><br />
        <?php if (!empty($gender) and $gender_setting==2){ ?><i class="fa fa-fw fa-venus-mars" aria-hidden="true"></i> <?php echo $gender; ?><br /><?php }?>
        <?php if (!empty($gender_3) and $gender_3_setting==2){ ?><i class="fa fa-fw fa-venus-mars" aria-hidden="true"></i> <?php echo $gender_3; ?><br /><?php }?>
        <?php if (!empty($dateofbirth) and $dateofbirth_setting==2){ ?><i class="fa fa-fw fa-birthday-cake" aria-hidden="true"></i> <?php echo date_i18n($date_format, strtotime($dateofbirth));  ?><br /><?php }?>
        <?php if (!empty($www) and $www_setting==2){ ?><a href="<?php echo $www; ?>"><i class="fa fa-fw fa-link" aria-hidden="true"></i> <?php echo $www; ?></a><br /><?php }?>
        <?php if (!empty($address) and $address_setting==2){ ?><i class="fa fa-fw fa-home" aria-hidden="true"></i> <?php echo $address; ?> <?php }?>
        <?php if (!empty($city) and $city_setting==2){ ?><i class="fa fa-fw fa-building-o" aria-hidden="true"></i> <?php echo $city; ?> <?php }?>
        <?php if (!empty($zip_code) and $zip_code_setting==2){ ?><i class="fa fa-fw fa-bookmark-o" aria-hidden="true"></i> <?php echo $zip_code; ?> <?php }?>
        <?php if (!empty($state) and $state_setting==2){ ?><i class="fa fa-fw fa-map-marker" aria-hidden="true"></i> <?php echo $state; ?> <?php }?>
        <?php if (!empty($country) and $country_setting==2){ ?><i class="fa fa-fw fa-globe" aria-hidden="true"></i> <?php echo $country; ?><br /><?php }?>
        <?php if (!empty($phone) and $phone_setting==2){ ?><i class="fa fa-fw fa-phone" aria-hidden="true"></i> <?php echo $phone; ?><br /><?php }?>
        <?php if (!empty($facebook) and $facebook_setting==2){ ?><a href="<?php echo $facebook; ?>"><i class="fa fa-fw fa-facebook-square" aria-hidden="true"></i> <?php echo $facebook; ?></a><br /><?php }?>
        <?php if (!empty($twitter) and $twitter_setting==2){ ?><a href="<?php echo $twitter; ?>"><i class="fa fa-fw fa-twitter-square" aria-hidden="true"></i> <?php echo $twitter; ?></a><br /><?php }?>
        <?php if (!empty($instagram) and $instagram_setting==2){ ?><a href="<?php echo $instagram; ?>"><i class="fa fa-fw fa-instagram" aria-hidden="true"></i> <?php echo $instagram; ?></a><br /><?php }?>
        <?php if (!empty($custom_field_personal) and $custom_field_personal_setting==2){ ?><i class="fa fa-fw fa-pencil-square-o" aria-hidden="true"></i> <?php echo $custom_field_personal_name; ?>:<br /> <?php echo $custom_field_personal; ?>:<br /><?php }?>
        <?php if (!empty($custom_field_personal_required) and $custom_field_personal_setting_required==2){ ?><i class="fa fa-fw fa-pencil-square-o" aria-hidden="true"></i> <?php echo $custom_field_personal_name_required; ?>:<br /> <?php echo $custom_field_personal_required; ?><?php }?>



        </td>
        <?php
		}elseif (empty ($user) and !empty ($photo_username)){
		?>
        <td data-label="<?php _e('Author','photo-contest'); ?>"><i class="fa fa-fw fa-user" aria-hidden="true"></i> <?php echo $photo_username; ?><br /><i class="fa fa-fw fa-envelope" aria-hidden="true"></i> <a href="mailto:<?php echo $photo_email; ?>?subject=Photo%20rejection"><?php echo $photo_email; ?></a></td>
        <?php
	    }else{
		?>
        <td data-label="<?php _e('Author','photo-contest'); ?>"><?php _e('This autor was deleted','photo-contest'); ?></td>
        <?php
	    }

		  ?>
	       <td data-label="<?php _e('Contest','photo-contest'); ?>"><a href="<?php echo  get_permalink( $sql3->page_id ); ?>"><?php echo stripslashes($sql3->contest_name); ?></a></td>


        <form method="post" id="categoryForm_<?php echo $post->ID; ?>" action=""></form>
				<form method="post" id="activateForm_<?php echo $post->ID; ?>" action=""></form>
        <input type="hidden" name="item_id" form="categoryForm_<?php echo $post->ID; ?>" value="<?php echo $post->ID; ?>" />
				<input type="hidden" name="item_id_2" form="activateForm_<?php echo $post->ID; ?>" value="<?php echo $post->ID; ?>" />

        <?php if(!empty($sql)){ ?>
        <td data-label="<?php _e('Category','photo-contest'); ?>">
       <div class="pc-clear"></div>
       <div class="form-group">
       <label class="input-group p-custom-arrow">
       <select name="category_selected" id="" form="categoryForm_<?php echo $post->ID; ?>" class="form-control" onchange="this.form.submit()">
        <?php
		$ctid= get_post_meta($post->ID,'contest-photo-category',true);
		$sql2= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_cat WHERE related_to_contest=".$photo_related_to_contest."");
		$sql5= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_cat WHERE id=".$ctid."");

		if (empty ($ctid) or empty ($sql2)  or  empty ($sql5)){
		echo '<option selected="selected" value="900000">'. __('Uncatergorized','photo-contest').'</option>';
		}
		if(!empty($sql)){
       foreach($sql2 as $item){
	    echo '
        <option '. (($item->id==$ctid)?'selected="selected"':"").' value="'.$item->id.'">'.stripslashes($item->name).'</option>';
       }
        }
		?>
        </select>
        <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-fw fa-check"></i></span> <span class="p-error-text"><i class="fa fa-fw fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="p-select-arrow"><i class="fa fa-fw fa-caret-down"></i></span></label>
       </div>

        <div class="pc-clear"></div>
        </td>
			<?php }
			//Votes vs Rates
			if ($sql3->vote_frequency ==6){
				$numberofstars=5;
				$rating_total = get_post_meta($post->ID, 'contest-photo-rate5-total', true);
			}
			if ($sql3->vote_frequency ==7){
				$numberofstars=10;
				$rating_total = get_post_meta($post->ID, 'contest-photo-rate10-total', true);
			}
			 ?>

        <td data-label="<?php _e('Votes/rating','photo-contest'); ?>">
        <div class="pc-clear"></div>

				<?php if ($sql3->vote_frequency <=5){ ?>
        <form method="post" action="" id="votes">
        <div class="form-group pc-td-votes">
        <label class="input-group p-custom-arrow">
        <input type="hidden" name="page" value="photo-contest-photos" />
        <div class="input-group"><input type="text" id="votes" name="votes" form="categoryForm_<?php echo $post->ID; ?>"  class="form-control" value="<?php echo $photo_points; ?>"> <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-fw fa-check"></i></span> <span class="p-error-text"><i class="fa fa-fw fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-btn"><button type="submit" form="categoryForm_<?php echo $post->ID; ?>" class="pc-btn"><i class="fa fa-fw fa-check" aria-hidden="true"></i></button></span></div>

        <input type="hidden" name="photo_id" value="<?php echo $post->ID; ?>" />
        </label>
        </div>
        </form>
				<?php } ?>

				<?php if ($sql3->vote_frequency ==6){

					$html = '';
					//Calculate number of stars
					$rating_stars = round($rating_total,2);
					$stars = round( $rating_stars  * 2, 0, PHP_ROUND_HALF_UP);

					// Add full stars:
					$i = 1;
					$d = 0;
					while ($i <= $stars - 1) {
						$html .= '<i class="fa fa-star" aria-hidden="true"></i>';
						$i += 2;
						$d++;
					}
					// Add half star if needed:

					if ( $stars & 1 ) {
						$html .= '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
						$d++;
					}
					//Empty stars
					$a = 5-$d;
					for ($x = 0; $x < $a; $x++) {
						$html .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
					}

					$html .= ' <span><strong>('.$rating_stars.')</strong></span>';

				echo $html;

				} ?>

				<?php if ($sql3->vote_frequency ==7){

					$html = '';
					//Calculate number of stars
					$rating_stars = round($rating_total,2);
					$stars = round( $rating_stars  * 2, 0, PHP_ROUND_HALF_UP);

					// Add full stars:
					$i = 1;
					$d = 0;
					while ($i <= $stars - 1) {
						$html .= '<i class="fa fa-star" aria-hidden="true"></i>';
						$i += 2;
						$d++;
					}
					// Add half star if needed:

					if ( $stars & 1 ) {
						$html .= '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
						$d++;
					}
					//Empty stars
					$a = 10-$d;
					for ($x = 0; $x < $a; $x++) {
						$html .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
					}
					$html .= ' <span><strong>('.$rating_stars.')</strong></span>';

				echo $html;

				} ?>



        </td>
        <td data-label="<?php _e('Active','photo-contest'); ?>">

        <div class="p-switch"><label><input type="checkbox" value="ch" form="activateForm_<?php echo $post->ID; ?>" name="activate" <?php if($photo_active==1){echo 'checked="checked"';}?> onchange="this.form.submit()"> <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span></label></div>
        <div class="pc-clear"></div>
        </td>
        <td data-label="<?php _e('Tools','photo-contest'); ?>">
          <a href="<?php echo admin_url().'post.php?post='.$post->ID.'&action=edit'; ?>"><i class="fa fa-fw fa-pencil" aria-hidden="true"></i> <?php _e('Edit','photo-contest'); ?></a><br />
          <a href="<?php echo $image_attributes[0]; ?>" download="<?php echo $post->post_title; ?>"><i class="fa fa-fw fa-download" aria-hidden="true"></i> <?php _e('Download','photo-contest'); ?></a><br />
          <a href="<?php echo  get_permalink( $sql3->page_id )."?contest=photo-detail&photo_id=".$post->ID; ?>"><i class="fa fa-fw fa-home" aria-hidden="true"></i> <?php _e('Show in contest','photo-contest'); ?></a><br />
          <a href="<?php echo admin_url(); ?>admin.php?page=photo-contest-votes&orderby_item=<?php echo  $post->ID; ?>"><i class="fa fa-fw fa-user" aria-hidden="true"></i> <?php _e('Who voted?','photo-contest'); ?></a><br />
		<a href="<?php echo admin_url(); ?>admin.php?page=photo-contest-photos&delete=<?php echo  $post->ID.'&paged='.$paged; ?>" class="photo_delete pc-margin-pd" data-item="<?php echo $post->ID; ?>" onclick="if (!confirm('<?php _e('Do you want delete this image? Are you sure?','photo-contest'); ?>')) return false;"><i class="fa fa-fw fa-trash-o" aria-hidden="true"></i> <?php _e('Delete','photo-contest'); ?></a><br />
        </td>
      </tr>
      <?php
       //endforeach;
       //endif;
          }
       }
      ?>
    </tbody>

  </table>

  <div class="t-col-12">
    <div class="clear" style="margin-top:20px;">
    <?php echo contest_pagination(4,2,$items,$post_per_page); ?>
    </div>
  </div>

  <div class="row ml-1">

         <div class="col-sm-12">
          <div class="form-group">
                 <button class="pc-btn" type="submit" form="selected_items" name="activate_items"><i class="fa fa-fw fa-toggle-on"></i>&nbsp;<?php _e('Activate selected photos','photo-contest'); ?></button>
                 <button class="pc-btn" type="submit" form="selected_items" name="deactivate_items"><i class="fa fa-fw fa-toggle-off"></i>&nbsp;<?php _e('Deactivate selected photos','photo-contest'); ?></button>
                 <button class="pc-btn" type="submit" form="selected_items" name="delete_items" onclick="if (!confirm('<?php echo __('Do you want to delete selected photos? Are you sure!!?','photo-contest');?>')) return false;"><i class="fa fa-fw fa-trash"></i>&nbsp;<?php _e('Delete selected photos','photo-contest'); ?></button>
          </div>
         </div>

    </div>

     <?php } ?>
     </div>

</div></div>
