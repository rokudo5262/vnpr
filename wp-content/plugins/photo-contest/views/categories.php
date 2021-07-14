<?php

 //Secure file from direct access
 if ( ! defined( 'WPINC' ) ) {
	die;
 }

 global $wpdb;
 $istheresomecontest = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_list ORDER BY id ASC");
 $nameErr ="";
 if (empty ($istheresomecontest)) {
	 ?>
     <div class="wrap">
     <div class="modern-p-form p-form-modern-steelBlue">
     <div data-base-class="p-form" class="p-form p-bordered" style="max-width:1200px">
            <div class="p-title">
                        <span class="p-title-line"><?php echo __('Categories','photo-contest');?>&nbsp;&nbsp;<i class="fa fa-fw fa-list"></i></span>
            </div>

            <div class="alert alert-error"><strong><i class="fa fa-fw fa-times"></i> <?php echo __('Error:','photo-contest');?></strong> <?php echo __('Create contest first!','photo-contest');?> - <a href="admin.php?page=photo-contest-info#contest-create"><?php echo __('Create!','photo-contest');?></a></div>


     </div>
     </div>
     </div>
     <?php
	 }else{


 $sql= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_cat ORDER BY id DESC");


 if (isset ($_POST["send"]) and current_user_can( 'manage_options')) {
	if (empty($_POST["name"])) {
    $nameErr = '<div class="alert alert-error"><strong><i class="fa fa-fw fa-times"></i> <?php '. __('Error:','photo-contest').'</strong> '. __('"Category name" is required field!','photo-contest').'</div>';
    }else{
	$wpdb->insert( $wpdb->prefix."photo_contest_cat", array( 'name' => $_POST['name'], 'related_to_contest' => $_POST['related_to_contest'] ) );
	wp_redirect(admin_url().'admin.php?page=photo-contest-categories');
    }
	}


 if (isset ($_GET["delete"]) and current_user_can( 'manage_options')) {
	$wpdb->query("DELETE FROM ".$wpdb->prefix."photo_contest_cat WHERE id = ".$_GET["delete"]);
	//Delete connections between category and images
	$args = array(
        'post_type'      => 'attachment',
        'post_status'    => 'any',
		'posts_per_page'=> -1,
        'post_parent'    => null,
        'meta_key'       => 'contest-photo-category',
		'meta_value'     => $_GET["delete"],

        );
	$attachments = get_posts( $args );

	foreach ( $attachments as $post ) {
		update_post_meta($post->ID,'contest-photo-category',900000);
		}

	wp_redirect(admin_url().'admin.php?page=photo-contest-categories&success=delete');

    }
 if (isset ($_POST["sendto"]) and current_user_can( 'manage_options')) {
	 if (empty($_POST["newname"])) {
    $nameErr = '<div class="alert alert-error"><strong><i class="fa fa-fw fa-times"></i> <?php '. __('Error:','photo-contest').'</strong> '. __('"Category name" is required field!','photo-contest').'</div>';
    }else{
	$wpdb->update(
	   $wpdb->prefix.'photo_contest_cat',
	array(
		'name' => $_POST["newname"],	// string
	),
	array( 'id' => $_GET["edit"] )
	);
	wp_redirect(admin_url().'admin.php?page=photo-contest-categories&success=edit');
    }

    }
     ?>
 <div class="wrap">

     <div class="modern-p-form p-form-modern-steelBlue">
     <div data-base-class="p-form" class="p-form p-bordered" style="max-width:1200px">
            <div class="p-title">
                        <span class="p-title-line"><?php echo __('Categories','photo-contest');?>&nbsp;&nbsp;<i class="fa fa-fw fa-list"></i></span>
            </div>

<?php  if (isset ($_GET["success"]) and $_GET["success"]=="delete") {?>
  <div class="alert alert-valid"><strong><i class="fa fa-times"></i> <?php echo __('Success:','photo-contest');?></strong> <?php echo __('Category was successfuly deleted','photo-contest');?></div>
<?php } ?>

<?php  if (isset ($_GET["success"]) and $_GET["success"]=="edit") {?>
  <div class="alert alert-valid"><strong><i class="fa fa-times"></i> <?php echo __('Success:','photo-contest');?></strong> <?php echo __('Category was successfuly edited','photo-contest');?></div>
<?php } ?>



<?php if (!isset ($_GET["edit"])) { ?>

<div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php echo __('Create a new Category','photo-contest');?></span></div>

    <?php echo $nameErr; ?>


   <form method='post'>
   <div class="row">

    <div class="col-sm-6">
     <div class="form-group">
    <label for="name"><?php echo __('Category name','photo-contest');?></label>
   <div class="input-group p-has-icon"><input type="text" id="text" name="name" placeholder="<?php echo __('Category name','photo-contest');?>" class="form-control"> <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-fw fa-check"></i></span> <span class="p-error-text"><i class="fa fa-fw fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-fw fa-pencil-square-o"></i></span></div>
    </div>
   </div>

   <div class="col-sm-6">
    <div class="form-group">
   <label for="name"><?php echo __('Category related to the contest','photo-contest');?></label>

                         <label class="input-group p-custom-arrow">
   <select name="related_to_contest" id="related_to_contest" class="form-control">
   <?php
   $photo_contests= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_list");
   foreach ( $photo_contests as $item ){

    ?>
    <option value="<?php echo $item->id;?>"><?php echo stripslashes($item->contest_name);?></option>
    <?php } ?>
   </select>

   <span class="input-group-state">
                                    <span class="p-position">
                                        <span class="p-text">
                                            <span class="p-valid-text"><i class="fa fa-fw fa-check"></i></span>
                                            <span class="p-error-text"><i class="fa fa-fw fa-times"></i></span>
                                        </span>
                                    </span>
                                </span>
                                <span class="p-field-cb"></span>
                                <span class="p-select-arrow"><i class="fa fa-fw fa-caret-down"></i></span>
                            </label>
                        </div>

   </div>

   </div>
   <input name='send' value='1' type='hidden'>

   <div class="preview-btn text-right p-buttons">
   <button class="pc-btn" type="submit"><?php echo __('Create!','photo-contest');?></button>
   </div>

   <div class="pc-clear"></div>


   <div class="pc-tab-text"></div>

   </form>


<?php }else{
	$sql2= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_cat WHERE id = ".$_GET["edit"]);
	foreach ( $sql2 as $item )
?>
<div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php echo __('Edit Category','photo-contest');?></span></div>
    <?php echo $nameErr; ?>
    <form method='post'>
    <div class="row">
    <div class="col-sm-6">
    <div class="form-group">
    <label for="newname"><?php echo __('Category name','photo-contest');?></label>
   <div class="input-group p-has-icon"><input type="text" id="text" name="newname" value="<?php echo stripslashes($item->name);?>" class="form-control"> <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-fw fa-check"></i></span> <span class="p-error-text"><i class="fa fa-fw fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-fw fa-pencil-square-o"></i></span></div>
   </div>
   </div>
   <?php
   $photo_contests= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_list WHERE id = ".$item->related_to_contest );

   foreach ( $photo_contests as $item_cat ){

    ?>
    <div class="col-sm-6">
    <div class="form-group">
    <label for="name"><?php echo __('Category related to the contest *','photo-contest');?></label>
   <div class="input-group p-has-icon"><input type="text"  value="<?php echo stripslashes($item_cat->contest_name);?>" readonly="readonly" class="form-control"> <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-fw fa-check"></i></span> <span class="p-error-text"><i class="fa fa-fw fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-fw fa-camera"></i></span></div>

    </div>
    </div>
    </div>
    <?php } ?>

   <input name='sendto' value='1' type='hidden'>
    <div class="preview-btn text-right p-buttons">
    <button class="pc-btn" type="submit"><?php echo __('Edit!','photo-contest');?></button>
    </div>

    <div class="pc-clear"></div>
   </form>

   <div class="pc-tab-text"><small><?php echo __('* Field "Category related to the contest" can not be edited for several technical reasons. If you did mistake, delete the category and create a new one.','photo-contest');?></small></div>

<?php } if(!empty($sql)){	?>
   <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php echo __('List of Categories','photo-contest');?></span></div>

    <table class="pc-responisve">
    <thead>
      <tr>
        <th scope="col"><?php echo __('ID','photo-contest');?></th>
        <th scope="col"><?php echo __('Name','photo-contest');?></th>
        <th scope="col"><?php echo __('Related to contest','photo-contest');?></th>
        <th scope="col"><i class="fa fa-fw fa-pencil" aria-hidden="true"></i> <?php echo __('Edit','photo-contest');?></th>
        <th scope="col"><i class="fa fa-fw fa-trash-o" aria-hidden="true"></i> <?php echo __('Delete','photo-contest');?></th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th scope="col"><?php echo __('ID','photo-contest');?></th>
        <th scope="col"><?php echo __('Name','photo-contest');?></th>
        <th scope="col"><?php echo __('Related to contest','photo-contest');?></th>
        <th scope="col"><i class="fa fa-fw fa-pencil" aria-hidden="true"></i> <?php echo __('Edit','photo-contest');?></th>
        <th scope="col"><i class="fa fa-fw fa-trash-o" aria-hidden="true"></i> <?php echo __('Delete','photo-contest');?></th>
      </tr>
    </tfoot>
    <tbody id="the-list">
       <?php
       foreach($sql as $item){

		   $related_contest = $wpdb->get_row( "SELECT * FROM ".$wpdb->prefix."photo_contest_list WHERE id = ".$item->related_to_contest);
    ?>
      <tr>
        <td scope="row" data-label="<?php _e('ID','photo-contest'); ?>"><?php echo $item->id;  ?></td>
        <td data-label="<?php _e('Name','photo-contest'); ?>"><?php echo stripslashes($item->name); ?></td>
        <td data-label="<?php _e('Related to contest','photo-contest'); ?>"><?php echo stripslashes($related_contest->contest_name); ?></td>
        <td data-label="<?php _e('Edit','photo-contest'); ?>"><a href="<?php echo admin_url(); ?>admin.php?page=photo-contest-categories&edit=<?php echo  $item->id; ?>"><i class="fa fa-fw fa-pencil" aria-hidden="true"></i> <?php _e('Edit','photo-contest'); ?></a></td>
        <td data-label="<?php _e('Delete','photo-contest'); ?>">
        <a href="<?php echo admin_url(); ?>admin.php?page=photo-contest-categories&delete=<?php echo  $item->id; ?>" class="photo_delete" data-item="<?php echo $item->id; ?>"><i class="fa fa-fw fa-trash-o" aria-hidden="true"></i> <?php _e('Delete','photo-contest'); ?></a></td>
      </tr>
    <?php } ?>


    </tbody>
   </table>

   <?php } //end of if empty sql ?>

     </div></div>
</div>
<?php
 }
?>
