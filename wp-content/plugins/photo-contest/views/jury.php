<?php

 //Secure file from direct access
 if ( ! defined( 'WPINC' ) ) {
	die;
 }
 global $wpdb;

 if(isset($_POST['activate_jury']) and current_user_can( 'manage_options')){
		   if(isset($_POST['activate'])){
			$wpdb->update(
				   $wpdb->prefix.'photo_contest_list',
					array(
						'jury' => "2",	// string
						 ),
					array( 'id' => $_POST['activate_jury'] )
						 );

		   }else{
			$wpdb->update(
				   $wpdb->prefix.'photo_contest_list',
					array(
						'jury' => "1",	// string
						 ),
					array( 'id' => $_POST['activate_jury'] )
						 );
			}
      //Update vote type
      if ($_POST['vote-type']==1) {
         $wpdb->update(
         $wpdb->prefix.'photo_contest_list',
         array(
         'vote_frequency' => 1,	// string
         ),
         array( 'id' => $_POST['activate_jury'] )
         );
      }
      if ($_POST['vote-type']==2) {
         $wpdb->update(
         $wpdb->prefix.'photo_contest_list',
         array(
         'vote_frequency' => 7,	// string
         ),
         array( 'id' => $_POST['activate_jury'] )
         );
      }
 }

 if(isset($_POST['edit_jury']) and current_user_can( 'manage_options')){
		   if(isset($_POST['activate'])){
			$wpdb->update(
				   $wpdb->prefix.'photo_contest_list',
					array(
						'jury' => "2",	// string
						 ),
					array( 'id' => $_POST['edit_jury'] )
						 );

		   }else{
			$wpdb->update(
				   $wpdb->prefix.'photo_contest_list',
					array(
						'jury' => "1",	// string
						 ),
					array( 'id' => $_POST['edit_jury'] )
						 );
		   }
		   //Jury Votes
		   if (!empty($_POST['jury-votes'])) {
				if (is_numeric($_POST['jury-votes'])) {
			       $wpdb->update(
				   $wpdb->prefix.'photo_contest_list',
					array(
						'jury_votes' => $_POST['jury-votes'],	// string
						 ),
					array( 'id' => $_POST['edit_jury'] )
						 );
				}
           }
		   //Hide votes
		   if(isset($_POST['hide_votes'])){
		   $wpdb->update(
				   $wpdb->prefix.'photo_contest_list',
					array(
						'hide_votes' => "2",	// string
						 ),
					array( 'id' => $_GET["edit"] )
						 );
			}else{
		   $wpdb->update(
				   $wpdb->prefix.'photo_contest_list',
					array(
						'hide_votes' => "1",	// string
						 ),
					array( 'id' => $_GET["edit"] )
						 );
			}
      //Jury Vote Type
      if (!empty($_POST['vote-type'])) {
       if (is_numeric($_POST['vote-type'])) {
            $wpdb->update(
          $wpdb->prefix.'photo_contest_list',
         array(
           'jury_vote_type' => $_POST['vote-type'],	// string
            ),
         array( 'id' => $_POST['edit_jury'] )
            );
       }
       if ($_POST['vote-type']==1) {
          $wpdb->update(
          $wpdb->prefix.'photo_contest_list',
          array(
          'vote_frequency' => 1,	// string
          ),
          array( 'id' => $_POST['edit_jury'] )
          );
       }
       if ($_POST['vote-type']==2) {
          $wpdb->update(
          $wpdb->prefix.'photo_contest_list',
          array(
          'vote_frequency' => 7,	// string
          ),
          array( 'id' => $_POST['edit_jury'] )
          );
       }
      }
		   //Members of the jury
		   $post_jury_members = str_replace(' ', '', $_POST['jury_members']);
		   $only_numbers=preg_replace('/[a-zA-Z]/', '', $post_jury_members);
		   $nocommas =str_replace(',,', ',', $only_numbers);
		   $nocommas = rtrim($nocommas, ',');
		   $wpdb->update(
				   $wpdb->prefix.'photo_contest_list',
					array(
						'jury_members' => $nocommas,	// string
						 ),
					array( 'id' => $_POST['edit_jury'] )
						 );

 }

 //Main page
 if (!isset($_GET["edit"])){
  //Update Activation

 $sql= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_list ORDER BY id ASC");
 $blogurl = home_url();


 ?>
  <div class="wrap">
<form method="post" class="modern-p-form p-form-modern-steelBlue">

    <div data-base-class="p-form" class="p-form p-bordered" style="max-width:1200px">
            <div class="p-title">
                        <span class="p-title-line"><?php echo esc_html( get_admin_page_title() ); ?>&nbsp;&nbsp;<i class="fa fa-list"></i></span>
            </div>

            <div class="alert alert-valid"><strong><i class="fa fa-times"></i> <?php echo __('Notice:','photo-contest');?></strong> <?php echo __('If you will allow Jury for the contest, You must understand that some of previous settings for voting will be ignored.','photo-contest');?></div>

    <table class="pc-responisve">
    <thead>
      <tr>
        <th scope="col"><?php echo __('Active','photo-contest');?></th>
        <th scope="col"><?php echo __('Jury for','photo-contest');?></th>
        <th scope="col"><?php echo __('Allow the Jury','photo-contest');?></th>
        <th scope="col"><?php echo __('Jury members','photo-contest');?></th>
        <th scope="col"><i class="fa fa-pencil" aria-hidden="true"></i> <?php echo __('Settings','photo-contest');?></th>

      </tr>
    </thead>
    <tfoot>
      <tr>
        <th scope="col"><?php echo __('Active','photo-contest');?></th>
        <th scope="col"><?php echo __('Jury for','photo-contest');?></th>
        <th scope="col"><?php echo __('Allow the Jury','photo-contest');?></th>
        <th scope="col"><?php echo __('Jury members','photo-contest');?></th>
        <th scope="col"><i class="fa fa-pencil" aria-hidden="true"></i> <?php echo __('Settings','photo-contest');?></th>
      </tr>
    </tfoot>
    <tbody id="the-list">
       <?php
       if(!empty($sql)){
       foreach($sql as $item){
	   $start = $item->contest_start;
       $end = $item->contest_end;
	   $jury_active = $item->jury;
       $jury_members = $item->jury_members;
       $jury_votes = $item->jury_votes;
       $date = StrFTime('%m/%d/%Y', current_time( 'timestamp', 0 ));

		//Count Jury Members
       $jury_members_array = explode(',', $jury_members);
	   $jury_members_number = count(array_filter($jury_members_array, 'strlen'));
     $vote_type = $item->jury_vote_type;

    ?>
      <tr>
       <?php
        if($jury_active == "2"){
	   ?>
      <td scope="row" data-label="<?php _e('Active','photo-contest'); ?>"><img src="<?php echo plugins_url( 'assets/admin/ok.png', dirname(__FILE__) ); ?>" width="24" style="width:24px; height:24px;"/></td>
      <?php  }else{?>
      <td scope="row" data-label="<?php _e('Active','photo-contest'); ?>"><img src="<?php echo plugins_url( 'assets/admin/ko.png', dirname(__FILE__) ); ?>" width="24" style="width:24px; height:24px;"/></td>
      <?php  }?>
        <td data-label="<?php _e('Jury for','photo-contest'); ?>"><a href="<?php echo admin_url(); ?>admin.php?page=photo-contest-contests&edit=<?php echo  $item->id; ?>"><?php echo stripslashes($item->contest_name); ?></a></td>
        <td data-label="<?php _e('Allow the Jury','photo-contest'); ?>">
        <form method="POST" action="" id="activate_<?php echo $item->id; ?>">
        <input type="hidden" name="activate_jury" value="<?php echo $item->id; ?>" />
        <input type="hidden" name="vote-type" value="<?php echo $vote_type; ?>" />
        <div class="p-switch"><label><input type="checkbox" value="ch" name="activate" <?php if($jury_active==2){echo 'checked="checked"';}?> onchange="this.form.submit()"> <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span></label></div>
        </form>
        </td>
        <td data-label="<?php _e('Jury members','photo-contest'); ?>"><?php echo  $jury_members_number; ?></td>
        <td data-label="<?php _e('Settings','photo-contest'); ?>">
        <a href="<?php echo admin_url(); ?>admin.php?page=photo-contest-jury&edit=<?php echo  $item->id; ?>" class="jury_setup"><i class="fa fa-pencil" aria-hidden="true"></i> <?php echo __('Settings','photo-contest');?></a></td>
      </tr>
    <?php
        }
     }
    ?>

    </tbody>
   </table>

   </div>
  </form>
</div>

<?php
     }//END if not iset edit

 if (isset($_GET["edit"])){

	 $related_contest= $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."photo_contest_list WHERE id = ".$_GET["edit"]);

	 $page_id = $related_contest->page_id;
	 $contest_name = stripslashes($related_contest->contest_name);
	 $jury_active = $related_contest->jury;
	 $jury_votes = $related_contest->jury_votes;
	 $jury_members = str_replace(',,', ',', $related_contest->jury_members);
	 $hide_votes = $related_contest->hide_votes;
   $vote_type = $related_contest->jury_vote_type;

	   ?>
	 <div class="wrap">

     <div class="modern-p-form p-form-modern-steelBlue">
     <div data-base-class="p-form" class="p-form p-bordered" style="max-width:1200px">
	 <form method="post" id="juryform">

            <div class="p-title">
                        <span class="p-title-line"><?php _e('Jury for the contest:', 'photo-contest'); ?> <a href="<?php echo get_permalink( $page_id ); ?>" style="color:#FFFFFF"><?php echo $contest_name; ?></a>&nbsp;&nbsp;<i class="fa fa-list"></i></span>
            </div>

            <div class="alert alert-valid"><strong><i class="fa fa-times"></i> <?php echo __('Notice:','photo-contest');?></strong> <?php echo __('If you will allow Jury for the contest, You must understand that some of previous settings for voting will be ignored.','photo-contest');?></div>

          <div class="clearfix">
            <div class="p-subtitle text-left" data-base-class="p-subtitle">
            <span data-p-role="subtitle" class="p-title-side"><?php _e('Basic Settings', 'photo-contest'); ?></span></div>

            <input type="hidden" name="edit_jury" value="<?php echo $_GET["edit"]; ?>" />

                <div class="form-group">
                 <label for="allow_buddy_votes"><?php  _e('Allow the Jury', 'photo-contest'); ?></label>
                 <div class="p-form-cg pt-form-panel">
                   <div class="p-form-cg">
                     <div class="p-switch">
        				<label><input type="checkbox" value="ch" name="activate" <?php if($jury_active==2){echo 'checked="checked"';}?>> <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span></label>
                     </div>
                   </div>
                </div>
                </div>

                <div class="form-group form-group-width">
                <label for="font-size"><?php _e('Select type of judging','photo-contest'); ?></label>
                <div class="p-form-cg pt-form-panel">
                          <div class="radio">
                            <label>
                              <input <?php if($vote_type == "1" or empty($vote_type)){echo 'checked';} ?> type="radio" name="vote-type" value="1">
                              <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                              <?php _e('Vote','photo-contest'); ?>
                              </span> </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input <?php if($vote_type == "2"){echo 'checked';} ?> type="radio" name="vote-type" value="2">
                              <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                              <?php _e('10 Star rating','photo-contest'); ?>
                              </span> </label>
                          </div>
                        </div>
                </div>

                <div class="form-group">
                <label for="allow_buddy_votes"><?php  _e('Number of votes for each jury member', 'photo-contest'); ?><br /><small><?php  _e('(This number give votes to your jury members. Example if you set 3 votes, each member of the jury can vote 3 times (total) for 3 different images. If you set 1 vote, users can vote only once. One vote is the minimum.)', 'photo-contest'); ?></small></label>
                  <div class="input-group p-has-icon">
                    <input type="text" id="jury-votes" name="jury-votes" value="<?php echo $jury_votes; ?>" placeholder="<?php  _e('Numbers of votes (minimum is one)', 'photo-contest'); ?>" class="form-control">
                    <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-thumbs-up"></i></span></div>
                </div>

                <div class="form-group">
                <label for="textarea"><?php  _e('Add new members to Jury', 'photo-contest'); ?><br /><small><?php  _e('(Add ID of the users separated by comma. Example 1,29,33,55)', 'photo-contest'); ?> <a href="#TB_inline?width=600&height=550&inlineId=jury-popup" class="thickbox"><?php  _e('Show users with their ID´s', 'photo-contest'); ?></a></small></label>
                  <div class="input-group p-has-icon">
                    <textarea id="jury_members" name="jury_members" class="form-control resizenone"><?php echo $jury_members; ?></textarea>
                <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-file-text-o"></i></span></div>
                </div>


                <div class="form-group">
                 <label for="allow_buddy_votes"><?php  _e('Hide votes', 'photo-contest'); ?></label>
                 <div class="p-form-cg pt-form-panel">
                   <div class="p-form-cg">
                     <div class="p-switch">
                  <label>
                    <input type="checkbox" name="hide_votes" value="ch" <?php if($hide_votes == 2){echo 'checked="checked"';} ?>>
                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span> <span class="p-label"><?php _e('Hide Votes','photo-contest'); ?> <small><?php _e('(Votes, Top 10 and order by votes in Gallery will be hidden but still visible for Admins)','photo-contest'); ?></small></span></label>
                    </div>
                  </div>
                 </div>
                </div>

                <div class="form-group">
                <div class="preview-btn text-right p-buttons">
                  <button class="pc-btn" type="submit"><?php  _e('Save', 'photo-contest'); ?></button>
                </div>
                </div>

     </div><!--End Clearfix-->


     <div class="clearfix">
         <div class="p-subtitle text-left" data-base-class="p-subtitle">
                <span data-p-role="subtitle" class="p-title-side"><?php _e('Members of the Jury', 'photo-contest'); ?></span></div>
              <div class="p-form-cg pt-form-panel"> <?php
			  if (!empty ($jury_members)){
				  $jury_members_array = explode(',', $jury_members);
				  foreach ($jury_members_array as $member_id) {

					   if (is_numeric($member_id)) {

						   $user = get_userdata( $member_id );
						   if ( $user === false ) {
						   echo '<span style="color:red">'.__('Invalid ID', 'photo-contest').'('.$member_id.')</span>, ';
						   } else {
						   $member = get_user_by( 'ID', $member_id );

						   echo '<span><strong>'.$member->display_name.'</strong> ('.$member_id.')</span>, ';
						  }
					   }
				 }
			  }else{
				  echo '<span><strong>'.__('There are no members yet', 'photo-contest').'</strong></span>, ';
			  }



             ?> </div>
     </div><!--End Clearfix-->

     <div id="jury-popup" style="display:none;">
     <p>
		<?php
              $blogusers = get_users();
        // Array of stdClass objects.
        foreach ( $blogusers as $user ) {
        echo '<span class="pc_uselist">' . $user->display_name . ' (' . $user->ID . ')</span>';
        }?>
     </div><!--End my-content-id-->
   </form>
   </div><!--End P-Form-->
  </div>


<?php add_thickbox(); ?>


</div>

	<?php
	   }//END if iset edit
