<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
class mm_wp_photocontest_widget_rank extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Construct
/*-----------------------------------------------------------------------------------*/


function __construct() {
parent::__construct(
// Base ID of your widget
'mm_wp_photocontest_widget_rank',

// Widget name will appear in UI
__('Photo Contest Widget - Rank', 'photo-contest'),

// Widget description
array( 'description' => __( 'Widget displays rank from photo contest.', 'photo-contest' ), )
);
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
	extract( $args );
	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
  $contest_id = $instance['contest_id'];
  $post_per_page = $instance['per_page'];

	// Before widget (defined by theme functions file)
	echo $before_widget;


	// Display the widget title if one was input
  if ( $title )
		echo $before_title . $title . $after_title;

// Display widget


      $args = array(
        'post_type'      => 'attachment',
        'posts_per_page' => $post_per_page,
        'post_status'    => 'any',
        'post_parent'    => null,
        'meta_query' => array(
         array(
         'key'     => 'contest-active',
         'value'   => '1'),
		 array(
			'key' => 'photo-related-to-contest',
			'value' => $contest_id,
			)
         ),
        'meta_key'       => 'contest-photo-points',
        'orderby'        => 'meta_value_num',
	      'order'          => 'DESC'
        );
?>
    <div id="photo-wrap" class="photo-wrap">
<?php

$i = 0;
$attachments = get_posts( $args );
if ( $attachments ) {
	foreach ( $attachments as $post ) {


        $photo_active = get_post_meta($post->ID,'contest-active',true);
        $photo_points = get_post_meta($post->ID,'contest-photo-points',true);
        $blogurl = home_url('url');

   if($photo_active!=0){
   $strg = wp_get_attachment_image_src( $post->ID,'gallery-big' );

    $fileParts = pathinfo($strg[0]);
    if(!isset($fileParts['filename']))
    {$fileParts['filename'] = substr($fileParts['basename'], 0, strrpos($fileParts['basename'], '.'));}
  
   global $wpdb;
   $related_contest = $wpdb->get_row( "SELECT * FROM ".$wpdb->prefix."photo_contest_list WHERE id = ".$contest_id);
   $link = get_permalink($related_contest->page_id);
   $new_query = add_query_arg( array('contest' => 'photo-detail' , 'photo_id' => $post->ID), $link );
   $i++;
   $author_id = get_post_meta($post->ID,'contest-photo-author',true);
   $user = get_user_by( 'id', $author_id );
   if (!empty ($user)){
				   $author = $user->display_name;
                   $author2 = $user->display_name;
				   }else{
				   $author = __('Deleted user','photo-contest');
				   $author2 = __('Deleted user','photo-contest');
				 }

   $author = (strlen($author) > 15) ? substr($author,0,18).'...': $author;
   $title = $post->post_title;
   $title2 = $post->post_title;
   $title = (strlen($title) > 22) ? substr($title,0,25).'...': $title;

   if (empty($instance['fontcolor'])) {
       $fontcolor = "000000";
     }else{
       $fontcolor = $instance['fontcolor'];
     }

   ?>
   <div class="widget-contest-rank" style="color:#<?php echo $instance['fontcolor'] ?>">
     <div class="widget-contest-rank-num" style="color:#<?php echo $instance['fontcolor'] ?>" >
        <div class="widget-contest-rank-pos" ><a href="<?php echo $new_query; ?>" style="color:#<?php echo $fontcolor ?>"><?php echo $i ?></a></div>
     </div>
   <div class="widget-contest-rank-info">
       <div title="<?php echo $author2; ?>"><span><a href="<?php echo $new_query; ?>" style="color:#<?php echo $fontcolor ?>"><?php echo $author; ?></a></span></div>
       <div title="<?php echo $title2; ?>"><?php echo $title; ?></div>
       <div class="widget-contest-votes"><?php _e('Votes:', 'photo-contest') ?> <?php echo $photo_points; ?></div>
   </div>


   <div class="clear"></div>
   </div>
   <div class="clear"></div>
   <?php

    }
  }
}

?>

    </div>
    <div class="clear"></div>
    <?php
  //Display define after widget
	echo $after_widget;

}

/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/

	public function update( $new_instance, $old_instance ) {

	$instance = $old_instance;
    $instance['title']    = strip_tags( $new_instance['title'] );
    $instance['contest_id']  = $new_instance['contest_id'];
    $instance['per_page'] = $new_instance['per_page'];
	$instance['fontcolor'] = strip_tags( $new_instance['fontcolor']);
  	return $instance;
	}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/

		public function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Photo contest';
		if (empty($instance['contest_id'])) {
			$contest_id = "";
		}else{
			$contest_id = $instance['contest_id'];
		}
		if (empty($instance['fontcolor'])) {
			$fontcolor = "000000";
		}else{
			$fontcolor = $instance['fontcolor'];
		}
		$per_page = isset($instance['per_page']) ? absint($instance['per_page']) : '5';
		$per_page_array = array(1,2,3,4,5);

    ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'photo-contest') ?></label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>">
        </p>



        <p>
            <label for="<?php echo $this->get_field_id( 'per_page' ); ?>"><?php _e('Items', 'photo-contest') ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'per_page' ); ?>" name="<?php echo $this->get_field_name( 'per_page' ); ?>">
            <?php
            foreach( $per_page_array as $item ){ ?>
            <option <?php if($item == $per_page){ echo 'selected="selected"'; } ?> value="<?php echo $item; ?>"><?php echo $item; ?></option>
            <?php } ?>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'contest_id' ); ?>"><?php _e('Select Contest', 'photo-contest') ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'contest_id' ); ?>" name="<?php echo $this->get_field_name( 'contest_id' ); ?>">
            <?php
            global $wpdb;
            $sql= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_list ORDER BY id ASC");
            foreach( $sql as $item ){ ?>
            <option <?php if($item->id == $contest_id){ echo 'selected="selected"'; } ?> value="<?php echo $item->id; ?>"><?php echo $item->contest_name; ?></option>
            <?php } ?>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'fontcolor' ); ?>"><?php _e('Font Color', 'photo-contest') ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'fontcolor' ); ?>" name="<?php echo $this->get_field_name( 'fontcolor' ); ?>">
            <option <?php if($fontcolor == "000000"){ echo 'selected="selected"'; } ?> value="000000"><?php _e('Black', 'photo-contest') ?></option>
            <option <?php if($fontcolor == "616161"){ echo 'selected="selected"'; } ?> value="616161"><?php _e('Grey', 'photo-contest') ?></option>
            <option <?php if($fontcolor == "ffffff"){ echo 'selected="selected"'; } ?> value="ffffff"><?php _e('White', 'photo-contest') ?></option>
            </select>
        </p>

	<?php
	}



}//End class
