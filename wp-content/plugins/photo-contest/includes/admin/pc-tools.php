<div class="wrap">

	<div class="modern-p-form p-form-modern-steelBlue">
     <div data-base-class="p-form" class="p-form p-bordered" style="max-width:1200px">


			<?php if (empty($contests)) { ?>
            <div class="p-form-sg pt-form-panel">
            <div><?php echo __('There are no contests at this time!','photo-contest');?></div>
            <div><?php echo __('Create contest first!','photo-contest');?></div>
            </div>
            <?php } ?>

            <?php if (!empty($contests)) { ?>
            <div class="pc-clear"></div>

						<?php if (isset ($_GET['edit-user']) and !empty( $user )) {?>

					    <div class="p-title">
					                <span class="p-title-line"><?php echo __('Edit User','photo-contest');?>: <?php echo $user->display_name; ?>&nbsp;&nbsp;<i class="fa fa-user"></i></span>
					    </div>

					    <?php if (isset ($_POST['city'])) {?>
					    <div class="alert alert-valid"><strong><i class="fa fa-times"></i> <?php echo __('Success:','photo-contest');?></strong> <?php echo __('User data was saved!','photo-contest');?></div>
					    <?php  } ?>

					    <div class="clearfix">
					    <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php echo __('WordPress data','photo-contest');?></span></div>

					    <p><?php echo __('Every contest user is a WordPress user. If you wanna change basic data like Nickname, email or password you must use basic WordPress user editor. Edit:','photo-contest');?> <a href="<?php echo admin_url(); ?>user-edit.php?user_id=<?php echo $user->ID; ?>"><?php echo $user->display_name; ?></a></p>

					    </div>


					    <form method="post">
					      <div class="clearfix">
					      <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php echo __('Contest Personal data','photo-contest');?></span></div>

					      <div class="vc-edit-user"><?php echo pc_edit_user($user->ID) ?></div>
					      <div class="preview-btn text-right p-buttons"><button class="pc-btn" type="submit"><?php echo __('Edit','photo-contest');?></button></div>

					     </div>
					    </form>

					    <form method="get">
					      <div class="clearfix">
					      <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php echo __('Contest data','photo-contest');?></span></div>



					      <div class="form-group">
					      <label for="contest_id"><?php echo __('Select the Contest','photo-contest');?></label>
					      <label class="input-group p-custom-arrow">
					      <input type="hidden" name="page" value="photo-contest-tools">
					      <input type="hidden" name="edit-user" value="<?php echo $user->ID; ?>">
					      <select name="contest_id" id="contest_id" class="form-control">
					      <?php
					     $photo_contests= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_list");
					     foreach ( $photo_contests as $item ){
					      ?>
					      <option value="<?php echo $item->id;?>"><?php echo $item->contest_name;?></option>
					      <?php } ?>

					     </select>
					     <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span><span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span><span class="p-field-cb"></span><span class="p-select-arrow"><i class="fa fa-caret-down"></i></span>
					      </label>
					      </div>

					      <div class="preview-btn text-right p-buttons"><button class="pc-btn" type="submit"><?php echo __('Select','photo-contest');?></button></div>

					     </div>
					    </form>

					     <?php if (isset ($_GET['contest_id']) and !empty( $user )) {
					      $contest= $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."photo_contest_list WHERE id = ".$_GET['contest_id']);


					  if (!empty ($contest)){
					         ?>

					        <form method="post">
					        <div class="clearfix">
					        <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php echo __('Edit user contest data','photo-contest');?></span></div>

					     <?php echo pc_edit_user_contest($contest,$user->ID); ?>



					      <div class="preview-btn text-right p-buttons"><button class="pc-btn" type="submit"><?php echo __('Edit','photo-contest');?></button></div>

					        </div>
					        </form>

					    <?php } }?>




					  <?php  }else { ?>

							<div class="p-title">
			 									 <span class="p-title-line"><?php echo __('Tools','photo-contest');?>&nbsp;&nbsp;<i class="fa fa-wrench"></i></span>
			 			 </div>

						<form method="get">
				      <div class="clearfix">
				      <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php echo __('Edit User','photo-contest');?></span></div>

				      <?php if (isset ($_GET['edit-user']) and current_user_can( 'manage_options') and empty( $user )) {?>
				        <div class="alert alert-error"><strong><i class="fa fa-times"></i><?php echo __('Notice:','photo-contest');?> </strong> <?php echo __('User was not found!','photo-contest');?></div>
				      <?php  } ?>

				      <input type="hidden" name="page" value="photo-contest-tools">

				      <div class="form-group">
				      <label for="text"><?php echo __('This tool will help you find and edit user by ID, Username or Email','photo-contest');?></label>
				      <div class="input-group p-has-icon"><input type="text" id="edit-user" name="edit-user" placeholder="<?php echo __('State user ID, Username or Email','photo-contest');?>" value="<?php if (isset ($_GET['edit-user']) and current_user_can( 'manage_options') and !empty( $user )) {echo $user->display_name;} ?>" class="form-control"> <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span> <span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span> <span class="p-field-cb"></span> <span class="input-group-icon"><i class="fa fa-user"></i></span></div>
				      </div>

				      <div class="preview-btn text-right p-buttons"><button class="pc-btn" type="submit"><?php echo __('Search','photo-contest');?></button></div>

				      </div><!--clearfix-->
				    </form>

            <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php echo __('Add images to the contest (Bulk upload)','photo-contest');?></span></div>


            <div class="form-group-width">

            <form method="get" id="insert_images">
                <label for="reset-id"><?php echo __('Select the Contest','photo-contest');?></label>
                <div class="form-group">
                    <label class="input-group p-custom-arrow">
                        <select name="contest-id" id="contest-id" class="form-control  bulk-show">
                        <option value=""><?php echo __('Select the Contest','photo-contest');?></option>
                        <?php
                        foreach ( $photo_contests as $item ){
                        ?>
                        <option value="<?php echo $item->id;?>"><?php echo stripslashes($item->contest_name) ;?></option>
                        <?php } ?>
                        </select>
                        <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span><span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span><span class="p-field-cb"></span><span class="p-select-arrow"><i class="fa fa-caret-down"></i></span>
                    </label>
                </div>
                <div class="pc_select_images bulk-hide">
                    <input type="hidden" name="page" id="page" value="photo-contest-tools"/>
                    <input type="hidden" name="items" id="myprefix_image_id" value=""/>
                    <h3><?php echo __('Select images to upload','photo-contest');?></h3>
                    <button type='button' class="pc-s-button" value="0" id="myprefix_media_manager"/><?php esc_attr_e( 'Select a images', 'photo-contest' ); ?> *</button>
                    <p class="pc-max-upload-size">* <?php echo __('For choosing more images at once hold CTRL or Shift key','photo-contest');?></p>
                    <p class="pc-max-upload-size"><strong><?php echo __('Recommended maximum for bulk upload is 20 images at once','photo-contest');?></strong></p>
                </div>
            </form>


            </div><!--form-group-width-->


            <form method="post">
                <div class="clearfix">
                <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php echo __('Export Users Data','photo-contest');?></span></div>
                <label for="name"><?php echo __('Select the Contest','photo-contest');?></label>
                <div class="form-group">
                <label class="input-group p-custom-arrow">
                <select name="selected_contest" id="selected_contest" class="form-control">
                <?php
                foreach ( $photo_contests as $item ){
                ?>
                <option value="<?php echo $item->id;?>"><?php echo stripslashes($item->contest_name);?></option>
                <?php } ?>

                </select>
                <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span><span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span><span class="p-field-cb"></span><span class="p-select-arrow"><i class="fa fa-caret-down"></i></span>
                </label>
                </div>

                <div class="pc-clear"></div>


                <div class="form-group">
                <input name="send" value="1" type="hidden">
                <div class="preview-btn text-right p-buttons"><button class="pc-btn" type="submit"><?php echo __('Export','photo-contest');?></button></div>
                </div>
                </div><!--clearfix-->
            </form>


			<?php
				//Email filter
				if (isset($_POST['filter']) and current_user_can( 'manage_options')){
					if(isset($_POST['email-filter'])){
						update_option('pcplugin-email-filter', "2");
					}else{
						update_option('pcplugin-email-filter', "1");
					}
				}
				$email_filter = get_option('pcplugin-email-filter');
            ?>

            <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php _e('Email filter','photo-contest'); ?></span></div>

            <form method="post">
                <div class="clearfix">
                    <label for="name"><?php _e('Allow email filter','photo-contest'); ?></label>
                    <div class="form-group">
                    <div class="p-form-sg pt-form-panel">
                    <div class="p-switch">
                    <label>
                    <input name="filter" value="1" type="hidden">
                    <input type="checkbox" name="email-filter" value="ch" <?php if($email_filter == 2){echo 'checked="checked"';} ?>>
                    <span class="p-switch-icon" data-checked="yes" data-unchecked="no"></span><small>(<?php _e('This filter allows you to control registration in your contest and protect vote confirmation against disposable email services. The filter contains several thousands domains and it is developed by the community on Github. Full list of domains you can find here:','photo-contest'); ?>
                    <a href="https://github.com/martenson/disposable-email-domains/blob/master/disposable_email_blocklist.conf" target="_blank">Disposable email domains</a>)</small></label>

                    </div>
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="preview-btn text-right p-buttons"><button class="pc-btn" type="submit"><?php echo __('Save','photo-contest');?></button></div>
                    </div>
                </div><!--clearfix-->
            </form>

            <form method="post">
                <div class="clearfix">
                <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php echo __('Reset the Contest','photo-contest');?></span></div>

                <div class="alert alert-error"><strong><i class="fa fa-times"></i><?php echo __('Notice:','photo-contest');?> </strong> <?php echo __('After you select the option "Reset the Contest" the action cannot be taken back.','photo-contest');?></div>

                <div class="form-group form-group-width">
                <label for="allow-custom-welcome-mail"><?php _e('Set reset mode', 'photo-contest'); ?></label>
                <div class="p-form-cg pt-form-panel">
                <div class="radio">
                <label>
                <input type="radio" name="reset-mode" checked="checked" value="1">
                <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                <?php _e('Only votes and views count', 'photo-contest'); ?>
                </span> </label>
                </div>
                <div class="radio">
                <label>
                <input type="radio" name="reset-mode" value="2">
                <span class="p-check-icon"> <span class="p-check-block"></span> </span> <span class="p-label">
                <?php _e('Everything (Images, data, votes, views count)', 'photo-contest'); ?>
                </span> </label>
                </div>

                </div>
                </div>

                <label for="reset-id"><?php echo __('Select the Contest','photo-contest');?></label>
                <div class="form-group">
                <label class="input-group p-custom-arrow">
                <select name="reset-id" id="reset-id" class="form-control">
                <?php
                $photo_contests= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_list");
                foreach ( $photo_contests as $item ){
                ?>
                <option value="<?php echo $item->id;?>"><?php echo stripslashes($item->contest_name);?></option>
                <?php } ?>

                </select>

                <span class="input-group-state"><span class="p-position"><span class="p-text"><span class="p-valid-text"><i class="fa fa-check"></i></span><span class="p-error-text"><i class="fa fa-times"></i></span></span></span></span><span class="p-field-cb"></span><span class="p-select-arrow"><i class="fa fa-caret-down"></i></span>
                </label>
                </div>

                <div class="pc-clear"></div>

                </div><!--clearfix-->
                <div class="form-group">
                <input name="send" value="1" type="hidden">
                <div class="preview-btn text-right p-buttons"><button class="pc-btn" type="submit" onclick="return confirm('<?php echo __('Are you sure that you want to reset those data?!!!!','photo-contest');?>')"><?php echo __('Reset','photo-contest');?></button></div>
                </div>
            </form>

					<?php  }//if not edit user ?>
				<?php  }//if not empty contest ?>

	 </div><!--p-form bordered-->
	</div><!--modern-p-form-->
</div><!--wrap end-->
