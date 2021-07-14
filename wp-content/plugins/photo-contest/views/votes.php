<?php

//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
die;
}

  global $wpdb;

  //Clear log
  if (isset($_GET['clear_log']) and current_user_can( 'manage_options')){
   $table  = $wpdb->prefix . 'photo_contest_votes';
   $delete = $wpdb->query("TRUNCATE TABLE $table");
  }
  //Delete item from log
  if(isset($_POST['delete_log']) and current_user_can( 'manage_options')){//to run PHP script on submit
   if(!empty($_POST['checked_items'])){
     // Loop
     foreach($_POST['checked_items'] as $item_id){
		$wpdb->delete( $wpdb->prefix.'photo_contest_votes', array( 'id' => $item_id ) );
     }
   }
  }

  //Romove the vote
  if (isset($_GET['remove_vote']) and current_user_can( 'manage_options')){

    $voteID = $_GET['remove_vote'];
    $removed_from = $_GET['removed_from'];
    $removed_value = $_GET['removed_value'];

    include_once (plugin_dir_path( __DIR__ ) ."includes/admin/pc-remove-the-vote.php");

    //Remove vote
    if ($removed_value=='v1') {
        remove_the_vote($voteID,$removed_from,$removed_value);
    }
    //Remove 5star rating
    if (in_array($removed_value, array('r1','r2','r3','r4','r5'))) {
        remove_the_rate_5($voteID,$removed_from,$removed_value);
    }
    //Remove 10star rating
    if (in_array($removed_value, array('d1','d2','d3','d4','d5','d6','d7','d8','d9','d10'))) {
        remove_the_rate_10($voteID,$removed_from,$removed_value);
    }

    wp_redirect(admin_url( 'admin.php?page=photo-contest-votes'));
  }


  //Update Items Per Page
  if (isset($_POST['results-per-page']) and current_user_can( 'manage_options')){
	$results_per_page = update_option( 'pcplugin-items-number', $_POST['results-per-page'] );
  }

  //Items Per Page
  $results_per_page = get_option( 'pcplugin-items-number' );
  if (empty($results_per_page)){
	$results_per_page = 15;
  }
  //Country
  if (isset($_GET['orderby_country'])){
  $country_code_get =$_GET['orderby_country'];
  }else{
  $country_code_get = "AF";
  }

  include_once (plugin_dir_path( __DIR__ ) ."includes/pc-upload-functions.php");

  $current_page = (isset($_GET['pagination']) ? (int) $_GET['pagination'] : 1); // current page in pagination
  if($current_page < 1)
  $current_page = 1;
  $current_page -= 1; // first page have to be 0

  $limit = ($current_page * $results_per_page).",".$results_per_page;
  $next_page = $current_page + 2;
  $prev_page = ($current_page == 1 ? "" : $current_page);



   //Set Query
   if(isset($_GET['orderby_ip'])){
	 $query = "WHERE ip_address = '".$_GET['orderby_ip']."' ORDER BY id DESC";
   }elseif(isset($_GET['orderby_contest']) and $_GET['orderby_contest']!=0){
      $query = "WHERE contest_id = '".$_GET['orderby_contest']."' ORDER BY id DESC";
   }elseif(isset($_GET['orderby_item'])){
      $query = "WHERE item_id = '".$_GET['orderby_item']."' ORDER BY id DESC";
   }elseif(isset($_GET['orderby_user'])){
      $query = "WHERE user_id = '".$_GET['orderby_user']."' ORDER BY id DESC";
   }elseif(isset($_GET['orderby_category']) and $_GET['orderby_category']!=0){
      $query = "WHERE category_id = '".$_GET['orderby_category']."' ORDER BY id DESC";
   }elseif(isset($_GET['orderby_email'])){
      $query = "WHERE email = '".$_GET['orderby_email']."' ORDER BY id DESC";
   }elseif(isset($_GET['orderby_country'])){
      $query = "WHERE country_code = '".$_GET['orderby_country']."' ORDER BY id DESC";
   }else{
      $query = "ORDER BY id DESC";
   }

  $votes = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_votes ".$query." LIMIT $limit");

  $results_count = $wpdb->get_var( "SELECT COUNT(*) FROM ".$wpdb->prefix."photo_contest_votes ".$query);
  $pages = $results_count / $results_per_page; // all pages count, we can use it in HTML pagination

  //Export log
  if (isset($_POST['export-votes']) and current_user_can( 'manage_options')){
   include_once (plugin_dir_path( __DIR__ ) ."includes/admin/pc-export-data.php");
   $votes_export = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_votes ".$query);
   pc_export_votes($votes_export);
  }


  $blogurl = home_url();
?>

</script>
<div class="wrap">

<div class="modern-p-form p-form-modern-steelBlue">

    <div data-base-class="p-form" class="p-form p-bordered">



            <div class="p-title">
                        <span class="p-title-line"><?php echo esc_html( get_admin_page_title() ); ?>&nbsp;&nbsp;<i class="fa fa-bars"></i></span>
            </div>

       <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php echo __('Filters','photo-contest'); ?></span></div>

        <!--//First ROW// -->
        <div class="row">
            <div class="col-sm-6">
            <div class="form-group">
            <form method="post">
            <label for="aresults-per-page"><?php _e('Maximum Items per page','photo-contest'); ?></label>
            <div class="p-form-cg pt-form-inline">
                <div class="radio">
                <label>
                <input type="radio" <?php if($results_per_page == 15){echo 'checked="checked"';} ?> name="results-per-page" value="15" onchange="this.form.submit()">
                <span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">15</span></label>
                </div>
                <div class="radio">
                <label>
                <input type="radio" <?php if($results_per_page == 25){echo 'checked="checked"';} ?> name="results-per-page" value="25" onchange="this.form.submit()">
                <span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">25</span></label>
                </div>
                <div class="radio">
                <label>
                <input type="radio" <?php if($results_per_page == 50){echo 'checked="checked"';} ?> name="results-per-page" value="50" onchange="this.form.submit()">
                <span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">50</span></label>
                </div>
                <div class="radio">
                <label>
                <input type="radio" <?php if($results_per_page == 75){echo 'checked="checked"';} ?> name="results-per-page" value="75" onchange="this.form.submit()">
                <span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">75</span></label>
                </div>
                <div class="radio">
                <label>
                <input type="radio" <?php if($results_per_page == 100){echo 'checked="checked"';} ?> name="results-per-page" value="100" onchange="this.form.submit()">
                <span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">100</span></label>
                </div>
                <div class="radio">
                <label>
                <input type="radio" <?php if($results_per_page == 150){echo 'checked="checked"';} ?> name="results-per-page" value="150" onchange="this.form.submit()">
                <span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">150</span></label>
                </div>
                <div class="radio">
                <label>
                <input type="radio" <?php if($results_per_page == 200){echo 'checked="checked"';} ?> name="results-per-page" value="200" onchange="this.form.submit()">
                <span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">200</span></label>
                </div>
                <div class="radio">
                <label>
                <input type="radio" <?php if($results_per_page == 500){echo 'checked="checked"';} ?> name="results-per-page" value="500" onchange="this.form.submit()">
                <span class="p-check-icon"><span class="p-check-block"></span></span> <span class="p-label">500</span></label>
                </div>
            </div>
            </form>
            </div>
            </div><!--end col 6-->

            <div class="col-sm-3">
            <div class="form-group">
            <form method="get" action="" >
             <label for="orderby_country"><?php _e('Select a Country','photo-contest'); ?></label>
                <input type="hidden" name="page" value="photo-contest-votes" />
            	<label class="input-group p-custom-arrow">
                <div class="input-group p-has-icon">
                <select name="orderby_country" id="orderby_country" class="form-control" onchange="this.form.submit()">
                <?php echo pcplugin_countries_for_votes_filter($country_code_get); ?>
                </select>
                <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="p-select-arrow"><i class="fa fa-caret-down"></i></span><span class="input-group-icon"><i class="fa fa-globe" aria-hidden="true"></i></span>
                </div>
                </label>
            </form>
            </div>
            </div><!--end col 3-->

            <div class="col-sm-3">
            <div class="form-group">
            <form method="get">
            <label for="orderby_email"><?php _e('Search by email','photo-contest'); ?></label>
            <input type="hidden" name="page" value="photo-contest-votes" />
            <div class="input-group">
            <input type="search" id="orderby_email" name="orderby_email" class="form-control" placeholder="<?php _e('Example: info@domain.com','photo-contest'); ?>">
            <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-btn">
            <button type="submit" class="pc-btn"><i class="fa fa-search"></i></button>
            </span></div>
            </form>
            </div>
            </div><!--end col 3-->

        </div><!--end row-->

        <div class="row">
            <div class="col-sm-3">
            <div class="form-group">
            <form method="get" action="" >
             <label for="orderby_contest"><?php _e('Select a Contest','photo-contest'); ?></label>
                <input type="hidden" name="page" value="photo-contest-votes" />
            	<label class="input-group p-custom-arrow">
                <div class="input-group p-has-icon">
                <select name="orderby_contest" id="orderby_contest" class="form-control" onchange="this.form.submit()">

                <option value="0"><?php _e('Select a Contest','photo-contest'); ?></option>

                <?php
				if (isset( $_GET['orderby_contest'])){
				$ctid= $_GET['orderby_contest'];
				}else{
				$ctid= 0;
				}
				$contests= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_list");
				if(!empty($contests)){
                  foreach($contests as $contest){
	                 echo '<option '. (($contest->id==$ctid)?'selected="selected"':"").' value="'.$contest->id.'">'.stripslashes($contest->contest_name).'</option>';
                  }
                }

                ?>
                </select>
                <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="p-select-arrow"><i class="fa fa-caret-down"></i></span><span class="input-group-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                </div>
                </label>
            </form>
            </div>
            </div><!--end col 3-->

            <div class="col-sm-3">
            <div class="form-group">
            <form method="get" action="" >
             <label for="orderby_category"><?php _e('Select a Category','photo-contest'); ?></label>
                <input type="hidden" name="page" value="photo-contest-votes" />
            	<label class="input-group p-custom-arrow">
                <div class="input-group p-has-icon">
                <select name="orderby_category" id="orderby_category" class="form-control" onchange="this.form.submit()">

                <option value="0"><?php _e('Select a Category','photo-contest'); ?></option>

                <?php
				if (isset( $_GET['orderby_category'])){
				$ctid= $_GET['orderby_category'];
				}else{
				$ctid= 0;
				}
				$categories_sql= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_cat");
				if(!empty($categories_sql)){
                  foreach($categories_sql as $category){
	                 echo '<option '. (($category->id==$ctid)?'selected="selected"':"").' value="'.$category->id.'">'.stripslashes($category->name).'</option>';
                  }
                }

                ?>
                </select>
                <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-required-text"><i class="fa fa-star"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="p-select-arrow"><i class="fa fa-caret-down"></i></span><span class="input-group-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                </div>
                </label>
            </form>
            </div>
            </div><!--end col 3-->

            <div class="col-sm-3">
            <div class="form-group">
            <form method="get">
            <label for="orderby_ip"><?php _e('Search by IP address','photo-contest'); ?></label>
            <input type="hidden" name="page" value="photo-contest-votes" />
            <div class="input-group">
            <input type="search" id="orderby_ip" name="orderby_ip" class="form-control" placeholder="<?php _e('Example: 176.192.159.215','photo-contest'); ?>">
            <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-btn">
            <button type="submit" class="pc-btn"><i class="fa fa-search"></i></button>
            </span></div>
            </form>
            </div>
            </div><!--end col 3-->

            <div class="col-sm-3">
            <div class="form-group">
            <form method="get">
            <label for="orderby_item"><?php _e('Search by photo ID','photo-contest'); ?></label>
            <input type="hidden" name="page" value="photo-contest-votes" />
            <div class="input-group">
            <input type="search" id="orderby_item" name="orderby_item" class="form-control" placeholder="<?php _e('Example: 314','photo-contest'); ?>">
            <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-btn">
            <button type="submit" class="pc-btn"><i class="fa fa-search"></i></button>
            </span></div>
            </form>
            </div>
            </div><!--end col 3-->

        </div><!--end row-->

        <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php echo __('Tools','photo-contest'); ?></span></div>

        <div class="row">


         <div class="col-sm-6">
             <div class="preview-btn text-left">
                 <div class="form-group">
                 <form method="post">
                 <div class="pc-btn" onclick="javascript:location.href='admin.php?page=photo-contest-votes'"><i class="fa fa-times"></i>&nbsp;<?php echo __('Reset Filters','photo-contest'); ?></div>
                 <input type="hidden" name="page" value="photo-contest-votes" />
                 <input type="hidden" name="export-votes" value="1" />
                 <button class="pc-btn" type="submit"></i><i class="fa fa-download" aria-hidden="true"></i>&nbsp;<?php echo __('Export Results to CSV','photo-contest'); ?>
                 <?php
				 if($results_count > 1000)
				 echo "<small>(".sprintf(__( 'Too much results for export: %s!', 'photo-contest'),  $results_count).")</small> ***";
				  ?>
                 </button>
                 </form>

                 </div>
             </div>
         </div>

         <div class="col-sm-6">
             <div class="preview-btn text-right">
                 <div class="form-group">
                 <form method="get">
                 <input type="hidden" name="page" value="photo-contest-votes" />
                 <input type="hidden" name="clear_log" value="1" />
                 <button class="pc-btn" type="submit" onclick="if (!confirm('<?php echo __('Do you want to cleare whole log? Are you sure!!?','photo-contest');?>')) return false;"><i class="fa fa-trash"></i>&nbsp;<?php echo __('Delete the whole Log','photo-contest'); ?> *</button>
                 </form>
                 </div>
             </div>
         </div>


        </div><!--end row-->
    <?php if (!empty($votes)) { ?>
    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php echo esc_html( get_admin_page_title() ); ?> [<?php echo $results_count; ?> <?php echo __('Result(s)','photo-contest'); ?>]</span></div>
    <?php } ?>

    <?php if (empty($votes)) { ?>
    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php echo esc_html( get_admin_page_title() ); ?></span></div>
    <?php } ?>


    <?php if (empty($votes)) { ?>
    <div class="alert alert-valid"><strong><i class="fa fa-times"></i> <?php echo __('Notice:','photo-contest');?></strong> <?php echo __('There are no records yet!','photo-contest'); ?></div>
    <?php } ?>

    <?php if (!empty($votes)) { ?>
    <form method="post" action="admin.php?page=photo-contest-votes">
    <table class="pc-responisve">
    <thead>
      <tr>
        <th scope="col"><div class="checkbox lowmargin">
                <label>
                <input type="checkbox" id="ckbCheckAll">
                <span class="p-check-icon"><span class="p-check-block"></span></span>
                </label>
                </div>
</th>
        <th scope="col"><?php echo __('Vote ID','photo-contest'); ?></th>
        <th scope="col"><?php echo __('Photo ID','photo-contest'); ?></th>
        <th scope="col"><?php echo __('Item','photo-contest'); ?></th>
        <th scope="col"><?php echo __('Vote/Rate value','photo-contest'); ?></th>
        <th scope="col"><?php echo __('Voter','photo-contest'); ?></th>
        <th scope="col"><?php echo __('Contest','photo-contest'); ?></th>
        <th scope="col"><?php echo __('Category','photo-contest'); ?></th>
        <th scope="col"><?php echo __('IP Address','photo-contest'); ?></th>
        <th scope="col"><?php echo __('Country','photo-contest'); ?></th>
        <th scope="col"><?php echo __('Date','photo-contest'); ?></th>
        <th scope="col"><?php echo __('Email','photo-contest'); ?></th>

      </tr>
    </thead>
    <tfoot>
      <tr>
        <th scope="col"><div class="checkbox lowmargin">
                <label>
                <input type="checkbox" id="ckbCheckAll2">
                <span class="p-check-icon"><span class="p-check-block"></span></span>
                </label>
                </div>
</th>
        <th scope="col"><?php echo __('Vote ID','photo-contest'); ?></th>
        <th scope="col"><?php echo __('Photo ID','photo-contest'); ?></th>
        <th scope="col"><?php echo __('Item','photo-contest'); ?></th>
        <th scope="col"><?php echo __('Vote/Rate value','photo-contest'); ?></th>
        <th scope="col"><?php echo __('Voter','photo-contest'); ?></th>
        <th scope="col"><?php echo __('Contest','photo-contest'); ?></th>
        <th scope="col"><?php echo __('Category','photo-contest'); ?></th>
        <th scope="col"><?php echo __('IP Address','photo-contest'); ?></th>
        <th scope="col"><?php echo __('Country','photo-contest'); ?></th>
        <th scope="col"><?php echo __('Date','photo-contest'); ?></th>
        <th scope="col"><?php echo __('Email','photo-contest'); ?></th>
      </tr>
    </tfoot>
    <tbody id="the-list">
        <?php
		$blogurl = home_url();

		//Load contests
		$contests= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_list ORDER BY id DESC");
		if (!empty ($contests)){
			$contests_list = array();
			foreach ($contests as $contest) {
			  $contests_list[$contest->id] = stripslashes($contest->contest_name);
			  $contests_page[$contest->id] = $contest->page_id;
			}
		}
		//Load categories
	    $categories= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_cat ORDER BY id DESC");
		if (!empty ($categories)){
			$category_list = array();
			foreach ($categories as $category) {
			  $category_list[$category->id] = stripslashes($category->name);
			}
		}

       if(!empty($votes)){
       foreach($votes as $item){
	   //Author
	   $user = get_user_by( 'id', $item->user_id );
	   if(empty($user)){
	   $author = '<a href=admin.php?page=photo-contest-votes&orderby_user=0>'.__('Guest','photo-contest').'</a>';
	   }else{
	   $author = '<a href=admin.php?page=photo-contest-votes&orderby_user='.$item->user_id.'>'.$user->display_name.'</a>';
	   }

     //Vote value
     if ($item->vote_rating_value=='v1' or empty($item->vote_rating_value)){$rate_value = '<i class="fa fa-thumbs-up" aria-hidden="true"></i> +1';}

     if ($item->vote_rating_value=='r1'){$rate_value = '<i class="fa fa-star" aria-hidden="true"></i> 1/5';}
     if ($item->vote_rating_value=='r2'){$rate_value = '<i class="fa fa-star" aria-hidden="true"></i> 2/5';}
     if ($item->vote_rating_value=='r3'){$rate_value = '<i class="fa fa-star" aria-hidden="true"></i> 3/5';}
     if ($item->vote_rating_value=='r4'){$rate_value = '<i class="fa fa-star" aria-hidden="true"></i> 4/5';}
     if ($item->vote_rating_value=='r5'){$rate_value = '<i class="fa fa-star" aria-hidden="true"></i> 5/5';}

     if ($item->vote_rating_value=='d1'){$rate_value = '<i class="fa fa-star" aria-hidden="true"></i> 1/10';}
     if ($item->vote_rating_value=='d2'){$rate_value = '<i class="fa fa-star" aria-hidden="true"></i> 2/10';}
     if ($item->vote_rating_value=='d3'){$rate_value = '<i class="fa fa-star" aria-hidden="true"></i> 3/10';}
     if ($item->vote_rating_value=='d4'){$rate_value = '<i class="fa fa-star" aria-hidden="true"></i> 4/10';}
     if ($item->vote_rating_value=='d5'){$rate_value = '<i class="fa fa-star" aria-hidden="true"></i> 5/10';}
     if ($item->vote_rating_value=='d6'){$rate_value = '<i class="fa fa-star" aria-hidden="true"></i> 6/10';}
     if ($item->vote_rating_value=='d7'){$rate_value = '<i class="fa fa-star" aria-hidden="true"></i> 7/10';}
     if ($item->vote_rating_value=='d8'){$rate_value = '<i class="fa fa-star" aria-hidden="true"></i> 8/10';}
     if ($item->vote_rating_value=='d9'){$rate_value = '<i class="fa fa-star" aria-hidden="true"></i> 9/10';}
     if ($item->vote_rating_value=='d10'){$rate_value = '<i class="fa fa-star" aria-hidden="true"></i> 10/10';}

		//Date and time
		$timestamp = $item->vote_date;
		$date = date(get_option("date_format"), $timestamp);
		$time = date('H:i:s', $timestamp);

		//Email
		$email = $item->email;
		if (!empty($email)){
		  $email_name = '<a href=admin.php?page=photo-contest-votes&orderby_email='.$email.'>'.$email.'</a>';
        }else{
		  $email_name = '<a href=admin.php?page=photo-contest-votes&orderby_email=0>'.__('No data','photo-contest').'</a>';
        }
		//Flag
		if(!empty($item->country_code)){
		$flag = '<a href=admin.php?page=photo-contest-votes&orderby_country='.urlencode($item->country_code).'><img src='.plugins_url( 'assets/admin/flags/'.strtolower($item->country_code).'.png', dirname(__FILE__) ).' border="0" alt="" width="20" style="margin-bottom:2px; width:auto !important; height:auto !important;"/></a> ';
		$country = $item->country;
		$country_name = '<a href=admin.php?page=photo-contest-votes&orderby_country='.urlencode($item->country_code).'>'.$country.'</a>';
		}else{
		$flag = '';
		$country_name = __('No data','photo-contest');
		}
		//Contest
		$image_contest= $item->contest_id;
		if (!empty($contests_list[$image_contest])){
		$contest = $contests_list[$image_contest];
		$contest_name = '<a href=admin.php?page=photo-contest-votes&orderby_contest='.$item->contest_id.'>'.$contest.'</a>';
		}else{
		$contest_name= __('Contest was deleted','photo-contest'); //Means the contest was deleted
		}
		//Category
		$image_category= $item->category_id;
		if ($image_category!=900000 and $image_category!=0 and !empty($category_list[$image_category])){
		    $category = $category_list[$image_category];
		  $category_name = '<a href=admin.php?page=photo-contest-votes&orderby_category='.$item->category_id.'>'.$category.'</a>';
		}else{
		    $category_name= __('Uncategorized','photo-contest');
		}
		//IP ADDRESS
		$ip_address = '<a href=admin.php?page=photo-contest-votes&orderby_ip='.$item->ip_address.'>'.$item->ip_address.'</a>';
		//Item ID
		$item_id = '<a href=admin.php?page=photo-contest-votes&orderby_item='.$item->item_id.'>'.$item->item_id.'</a>';

    //Remove vote URL
    if ($item->remove_vote==1){
      $remove_vote = '</br><a href=admin.php?page=photo-contest-votes&remove_vote='.$item->id.'&removed_from='.$item->item_id.'&removed_value='.$item->vote_rating_value.' style="color:red"><i class="fa fa-trash"></i> '. __('Remove this vote/rate','photo-contest').'</a>';
    }else{
      $remove_vote = '</br>'. __('This vote/rate was removed','photo-contest').'';
    }


    ?>
        <tr>

        <td scope="row" data-label="<?php echo __('Select','photo-contest'); ?>"><div class="checkbox">
        <label>
        <input type="checkbox" class="checkBoxClass" name="checked_items[]" value="<?php echo $item->id; ?>">
        <span class="p-check-icon"><span class="p-check-block"></span></span></label>
        </div>
       </td>

        <td scope="row" data-label="<?php echo __('Vote ID','photo-contest'); ?>"><?php echo $item->id;  ?></td>
        <td data-label="<?php echo __('Photo ID','photo-contest'); ?>"><?php echo $item_id; ?></td>
        <td data-label="<?php echo __('Item','photo-contest'); ?>"><a href="<?php echo $blogurl.'/wp-admin/post.php?post='.$item->item_id.'&action=edit'; ?>"><?php echo wp_get_attachment_image( $item->item_id, 'thumbnail' ); ?></a></td>
        <td data-label="<?php echo __('Vote/Rate value','photo-contest'); ?>">
          <?php echo $rate_value;?></br>
          <?php echo $remove_vote; ?>
        </td>
        <td data-label="<?php echo __('Voter','photo-contest'); ?>"><?php echo $author; ?></td>
        <td data-label="<?php echo __('Contest','photo-contest'); ?>"><?php echo $contest_name; ?></td>
        <td data-label="<?php echo __('Category','photo-contest'); ?>"><?php echo $category_name; ?></td>
        <td data-label="<?php echo __('IP Address','photo-contest'); ?>"><?php echo $ip_address; ?></td>
        <td data-label="<?php echo __('Country','photo-contest'); ?>"><?php echo $flag; ?><?php echo $country_name; ?></td>
        <td data-label="<?php echo __('Date','photo-contest'); ?>"><?php echo $date ?> <?php echo $time; ?></td>
        <td data-label="<?php echo __('Email','photo-contest'); ?>"><?php echo $email_name; ?></td>
      </tr>

      <?php
        }
      }
    ?>



    </tbody>
   </table>

 <div style="margin-top:20px; margin-bottom:20px; font-weight:bold;">

 <?php  if($current_page >= 1){ ?>

<a href="admin.php?page=photo-contest-votes&pagination=<?php echo $prev_page ?>" class="btn btn-info"> < </a>

<?php }  if ($results_per_page < $results_count and !isset($_GET['pagination']) ){?>
<a href="admin.php?page=photo-contest-votes&pagination=<?php echo $next_page ?>" class="btn btn-info" style="float:right;"> > </a>
<?php }
         if ($results_per_page < $results_count and isset($_GET['pagination']) and $_GET['pagination'] < $pages  ){?>
<a href="admin.php?page=photo-contest-votes&pagination=<?php echo $next_page ?>" class="btn btn-info" style="float:right;"> > </a>

<?php } ?>



  </div>

    <div class="row ml-1">

         <div class="col-sm-12">
             <div class="preview-btn text-left">
                 <div class="form-group">
                 <button class="pc-btn" type="submit" name="delete_log"><i class="fa fa-trash"></i>&nbsp;<?php _e('Delete selected records from the log','photo-contest'); ?> **</button>
                 </div>
             </div>
         </div>

    </div>

   </form>



   <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php echo __('Info','photo-contest'); ?></span></div>

   <p>* - <?php echo sprintf(__( 'Delete the whole Log: If you press the button "Delete the whole Log" you will delete all log records. However, it will be deleted only the log, not votes. If you want to reset (clear) votes just use <a href="%s">the special tool for that</a>.', 'photo-contest'),  'admin.php?page=photo-contest-tools'); ?></p>
   <p>** - <?php _e('Delete selected records from the log: It will delete only records from the log not votes itself','photo-contest'); ?></p>
   <p>*** - <?php _e('Too much results for export: The max. recommended limit for an export is 1000','photo-contest'); ?></p>

  <?php } ?>

   </div></div>



</div>
