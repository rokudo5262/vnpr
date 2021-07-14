<?php

//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
	die;
 }
 $plugin_version = get_option('pcplugin-version');
 global $wp_version;
?>

<div class="wrap">
     <div class="modern-p-form p-form-modern-steelBlue">
     <div data-base-class="p-form" class="p-form p-bordered" style="max-width:1200px">

            <div class="p-title">
                        <span class="p-title-line"><?php echo _e('Info & Help','photo-contest');?>&nbsp;&nbsp;<i class="fa fa-info-circle"></i></span>
            </div>

            <div>
           <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php echo _e('Index','photo-contest');?></span></div>

           <a name="contest-index"></a>
           <ol>
           <a href="#basic-info"><li><?php echo _e('Basic Info','photo-contest');?></li></a>
           <a href="#contest-create-video"><li><?php echo _e('Create a Contest','photo-contest');?></li></a>
           <a href="#disqus-comments-video"><li><?php echo _e('Disqus Comments - Video','photo-contest');?></li></a>
           <a href="#disqus-comments"><li><?php echo _e('Disqus Comments - Step by Step','photo-contest');?></li></a>
					 <a href="http://galleryplugins.com/photo-contest/" target="_blank"><li><?php echo _e('Online documentation & Demo','photo-contest');?></li></a>
					 <a href="http://goo.gl/9LxVbI" target="_blank"><li><?php echo _e('Official page on Codecanyon','photo-contest');?></li></a>
					 <a href="https://codecanyon.net/item/photo-contest-wordpress-plugin/8320636/support" target="_blank"><li><?php echo _e('Official Support Form','photo-contest');?></li></a>
           </ol>
           </div>

					 <div>
           <a name="basic-info"></a>
           <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php echo _e('Basic system info','photo-contest');?></span></div>
           <ol>
           <li><?php echo _e('PHP version','photo-contest');?> - <?php echo phpversion();?></li>
           <li><?php echo _e('Plugin version','photo-contest');?> - <?php echo $plugin_version;?></li>
           <li><?php echo _e('WordPress version','photo-contest');?> - <?php echo $wp_version;?></li>
           </ol>
           </div>


            <div>
         <a name="contest-create-video"></a>
           <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php echo _e('Create a Contest - Step by step','photo-contest');?></span></div>

							<h4><?php echo _e('Create a contest in the new WordPress Editor (Gutenberg)','photo-contest');?></li></h4>
							<ol>
							<li><?php echo _e('Create a new page for the contest.','photo-contest');?></li>
							<li><?php echo _e('Hit "Add block" (it is the Plus symbol in the Circle)','photo-contest');?></li>
							<li><?php echo _e('In the field "Search for a block" type Photo Contest','photo-contest');?></li>
							<li><?php echo _e('Pick the block "Photo Contest"','photo-contest');?></li>
							<li><?php echo _e('Done!','photo-contest');?></li>
							</ol>

							<h4><?php echo _e('Create a contest in the old WordPress editor','photo-contest');?></li></h4>
							<ol>
							<li><?php echo _e('Create a new page for the contest.','photo-contest');?></li>
							<li><?php echo _e('Hit button "Add Photo Contest" or add these two shortcodes to the text area <strong><code>[</code><code>contest-menu</code><code>]</code><code>[</code><code>contest-page</code><code>]</code></strong>.','photo-contest');?></li>
							<li><?php echo _e('Save the page and visit the page.','photo-contest');?></li>
							<li><?php echo _e('On the page you will find a form for creating a new contest, so fill the form.','photo-contest');?></li>
							<li><?php echo _e('Done!','photo-contest');?></li>
							</ol>

							<h4><?php echo _e('Create a contest in the Contests section','photo-contest');?></li></h4>
							<ol>
							<li><?php echo _e('Go to admin area Photo Contest -> Contests section.','photo-contest');?></li>
							<li><?php echo _e('Set contest name in the "Create a new contest" form and fill the rest of the form.','photo-contest');?></li>
							<li><?php echo _e('Hit "Create a contest" buton.','photo-contest');?></li>
							<li><?php echo _e('Done!','photo-contest');?></li>
							</ol>
           </div>

            <div>


           <div>
         <a name="disqus-comments-video"></a>
           <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php echo _e('Disqus Comments - Video','photo-contest');?></span></div>

           <div style="max-width:653px"><div class="video-container"><iframe src="https://www.youtube.com/embed/S2k5KCndjOI?rel=0" frameborder="0" allowfullscreen></iframe></div></div>

           </div>

            <div>
         <a name="disqus-comments"></a>
           <div class="p-subtitle text-left" data-base-class="p-subtitle"><span data-p-role="subtitle" class="p-title-side"><?php echo _e('Disqus Comments - Step by Step','photo-contest');?></span></div>

           <ol>
            <li><?php echo _e('Create account on','photo-contest');?> <a href="http://disqus.com">Disqus.com</a></li>
            <li><?php echo _e('After register and login click Setting icon in top right corner and select "Add Disqus To Site"','photo-contest');?></li>
            <li><?php echo _e('Click button "Install on Your Site" in top right corner','photo-contest');?></li>
            <li><?php echo _e('Fill the Form and click "Next" button','photo-contest');?></li>
            <li><?php echo _e('Pick one option "My site is part of larger organization" or "My site is just a personal site"','photo-contest');?></li>
            <li><?php echo _e('In this step just click "Skip" button','photo-contest');?></li>
            <li><?php echo _e('On page "Choose your Platform" select first option Universal Code','photo-contest');?></li>
            <li><?php echo _e('First select and after copy the code (Select CTRL+A and Copy CTRL+V)','photo-contest');?></li>
            <li><?php echo _e('Go to your site to Photo Contest General setting page and put code to textarea "Disqus Code" and click "Save changes"</li>','photo-contest');?>
           </ol>
           </div>
     </div>
     </div>
</div>  <!--Wrap end-->
