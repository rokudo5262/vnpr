<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
class mm_wp_photocontest_widget_category extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Construct
/*-----------------------------------------------------------------------------------*/

function __construct() {
parent::__construct(
// Base ID of your widget
'mm_wp_photocontest_widget_category',

// Widget name will appear in UI
__('Photo Contest Widget - Category', 'photo-contest'),

// Widget description
array( 'description' => __( 'Widget displays photos from categories.', 'photo-contest' ), )
);
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
	extract( $args );
	// Our variables from the widget settings
  $title = apply_filters('widget_title', $instance['title'] );
  $order = $instance['order'];
  if (empty($instance['category_id'])) {
       $category_id = "";
     }else{
       $category_id = $instance['category_id'];
     }
  $post_per_page = $instance['per_page'];

	// Before widget (defined by theme functions file)
	echo $before_widget;


	// Display the widget title if one was input
  if ( $title )
		echo $before_title . $title . $after_title;

// Display widget


if(empty($order)){

  $args = array(
        'post_type'      => 'attachment',
        'posts_per_page' => $post_per_page,
        'post_status'    => 'any',
        'post_parent'    => null,
        'orderby'        => 'post_date',
	    'order'          => 'DESC',
		'meta_query' => array(
		    array(
			'key' => 'contest-active',
			'value' => '1'
			),
			array(
			'key' => 'contest-photo-category',
			'value' => $category_id,
			)
		)
        );

  }else{
  if($order=='date-down'){
  $args = array(
        'post_type'      => 'attachment',
        'posts_per_page' => $post_per_page,
        'post_status'    => 'any',
        'post_parent'    => null,
        'orderby'        => 'post_date',
	    'order'          => 'DESC',
		'meta_query' => array(
		    array(
			'key' => 'contest-active',
			'value' => '1'
			),
			array(
			'key' => 'contest-photo-category',
			'value' => $category_id,
			)
		)
        );
  }elseif($order=='date-up'){
  $args = array(
        'post_type'      => 'attachment',
        'posts_per_page' => $post_per_page,
        'post_status'    => 'any',
        'post_parent'    => null,
        'orderby'        => 'post_date',
	    'order'          => 'ASC',
		'meta_query' => array(
		    array(
			'key' => 'contest-active',
			'value' => '1'
			),
			array(
			'key' => 'contest-photo-category',
			'value' => $category_id,
			)
		)
        );
  }elseif($order=='points-down'){
  $args = array(
        'post_type'      => 'attachment',
        'posts_per_page' => $post_per_page,
        'post_status'    => 'any',
        'post_parent'    => null,
        'meta_query' => array(
			array(
			'key' => 'contest-active',
			'value' => '1'
			),
			array(
			'key' => 'contest-photo-category',
			'value' => $category_id,
			)
		),
        'meta_key'       => 'contest-photo-points',
        'orderby'        => 'meta_value_num',
	    'order'          => 'DESC',

        );
  }elseif($order=='points-up'){
  $args = array(
        'post_type'      => 'attachment',
        'posts_per_page' => $post_per_page,
        'post_status'    => 'any',
        'post_parent'    => null,
        'meta_query' => array(
			array(
			'key' => 'contest-active',
			'value' => '1'
			),
			array(
			'key' => 'contest-photo-category',
			'value' => $category_id,
			)
		),
        'meta_key'       => 'contest-photo-points',
        'orderby'        => 'meta_value_num',
	    'order'          => 'ASC',

        );
  }elseif($order=='rand'){
  $args = array(
        'post_type'      => 'attachment',
        'posts_per_page' => $post_per_page,
        'post_status'    => 'any',
        'post_parent'    => null,
        'meta_query' => array(
			array(
			'key' => 'contest-active',
			'value' => '1'
			),
			array(
			'key' => 'contest-photo-category',
			'value' => $category_id,
			)
		),
        'orderby'        => 'rand',
        );
  }
}
?>
    <div id="photo-wrap" class="photo-wrap">
<?php

$attachments = get_posts( $args );
if ( $attachments ) {
	foreach ( $attachments as $contestitem ) {

		$photo_active = get_post_meta($contestitem->ID,'contest-active',true);
		$photo_points = get_post_meta($contestitem->ID,'contest-photo-points',true);
		$contest_id   = get_post_meta($contestitem->ID,'photo-related-to-contest',true);
		$blogurl = home_url('url');

   if($photo_active!=0){
   $image_attributes = wp_get_attachment_image_src( $contestitem->ID, 'photo-small' );
   global $wpdb;
   $related_contest = $wpdb->get_row( "SELECT * FROM ".$wpdb->prefix."photo_contest_list WHERE id = ".$contest_id);
   $link = get_permalink($related_contest->page_id);
   $new_query = add_query_arg( array('contest' => 'photo-detail' , 'photo_id' => $contestitem->ID), $link );
   ?>
   <div class="widget-contest-gallery-div"><a data-test="full" class="widget-photo-thumb" href="<?php echo $new_query; ?>"><img class="widget-contest-gallery-img" src="<?php echo $image_attributes[0]; ?>" /></a></div>
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
    $instance['order']    = $new_instance['order'];
    $instance['category_id']  = $new_instance['category_id'];
    $instance['per_page'] = $new_instance['per_page'];
  	return $instance;
	}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/

	public function form( $instance ) {
	$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Photo contest';

	if (empty($instance['order'])) {
       $order = "";
     }else{
       $order = $instance['order'];
    }
	if (empty($instance['category_id'])) {
       $category_id = "";
     }else{
       $category_id = $instance['category_id'];
     }


  $per_page = isset($instance['per_page']) ? absint($instance['per_page']) : '5';

  $order_array = array(
      'date-down'   => __('Newest', 'photo-contest'),
      'date-up'     => __('Oldest', 'photo-contest'),
      'points-down' => __('Most Voted', 'photo-contest'),
      'points-up'   => __('Least Votes', 'photo-contest'),
	  'rand'   => __('Random', 'photo-contest')
  );
  $per_page_array = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,30,40,50);

    ?>
    <p>
	  <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'photo-contest') ?></label>
      <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>">
    </p>

    <p>
      <label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e('Sort By:', 'photo-contest') ?></label>
      <select class="widefat" id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>">
         <?php
         foreach( $order_array as $key => $item ){ ?>
			   <option <?php if($order == $key){ echo 'selected="selected"'; } ?> value="<?php echo $key; ?>"><?php echo $item; ?></option>
        <?php } ?>
      </select>
	</p>

    <p>
	  <label for="<?php echo $this->get_field_id( 'per_page' ); ?>"><?php _e('Number of Photos', 'photo-contest') ?></label>
      <select class="widefat" id="<?php echo $this->get_field_id( 'per_page' ); ?>" name="<?php echo $this->get_field_name( 'per_page' ); ?>">
         <?php
         foreach( $per_page_array as $item ){ ?>
			   <option <?php if($item == $per_page){ echo 'selected="selected"'; } ?> value="<?php echo $item; ?>"><?php echo $item; ?></option>
        <?php } ?>
      </select>
	</p>

    <p>
	  <label for="<?php echo $this->get_field_id( 'category_id' ); ?>"><?php _e('Select Category', 'photo-contest') ?></label>
      <select class="widefat" id="<?php echo $this->get_field_id( 'category_id' ); ?>" name="<?php echo $this->get_field_name( 'category_id' ); ?>">
         <?php
		 global $wpdb;
		 $sql= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."photo_contest_cat ORDER BY id ASC");
         foreach( $sql as $item ){ ?>
			   <option <?php if($item->id == $category_id){ echo 'selected="selected"'; } ?> value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
        <?php } ?>
      </select>
		</p>

	<?php
	}



}//End class
