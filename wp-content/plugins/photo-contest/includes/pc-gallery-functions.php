<?php

//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
	die;
}
//Remove all possible forced image filters
remove_all_filters( 'pre_get_posts', 10 );
//Vote Gallery Button
function pc_vote_button($photo_id, $contest_id, $icon, $text, $text_after, $hash, $allow_redirect, $vote_frequency, $jury,$who_vote,$confirm_votes,$jury_member_check,$font_size){

	if ($jury==1){
		$vote_url = add_query_arg(array(
			'contest' => 'contest-share',
			'item-id' => $photo_id,
			'action' => 'vote',
			'vhash' => $hash
		), get_permalink());
	}else{
		$vote_url = add_query_arg(array(
		'contest' => 'photo-detail',
		'photo_id' => $photo_id
		), get_permalink());
	}
	if ($who_vote == 2 and $confirm_votes==1 and !is_user_logged_in()) {
		$vote_url = add_query_arg(array(
		'contest' => 'contest-share',
		'item-id' => $photo_id,
		'verify' => 'email'
		), get_permalink());
	}
  if ($who_vote == 1 and !is_user_logged_in() and $jury==1) {
		$html  = '<div class="modern-bottom-box">';
		$html .= '<div class="pc-modern-button">' . __('You must be logged in to vote!', 'photo-contest') . '</div>';
		$html .= '</div>';
	}elseif ($jury==2 and !is_user_logged_in() or $jury==2 and is_user_logged_in() and !$jury_member_check ) {
		$html  = '';
	}else{
		$html  = '<div class="modern-bottom-box">';
		$html .= '<div class="pc-modern-button" style="font-size:'.$font_size.'px" onclick="javascript:location.href=\'' .$vote_url. '\'"><a href="' .$vote_url. '">' . $icon . ' ' . $text . '</a></div>';
		$html .= '</div>';
	}

	return $html;

}

//Gallery pagination
function contest_pagination( $range = 2, $paged, $items = 0, $limit = 20){

     $out = '';

     //Dodělat vzorec

     $page_link = $_SERVER["REQUEST_URI"];

     $pag = explode('&paged',$page_link);
	 $countofpages = count($pag);

	 if($countofpages > 0){
	 	$page_link = $pag[0];
	 }



     if(!empty($_GET['paged'])){

      $paged = $_GET['paged'];

     }else{

      $paged = 1;

     }



     //$items = $this->slot_number();



     if($items == 0){

      $pages = 1;

     }else{

      $pages = ceil($items/$limit);

     }

     $showitems = ($range * 2)+1;



         if(1 != $pages){

            $out .= '<div class="slot_pagination">';



         if($paged > 2 && $paged > $range+1 && $showitems < $pages){

            $out .= '<a href="'.$page_link.'" class="btn btn-info"> << </a>';

         }

         if($paged > 1 && $showitems < $pages){

            $out .= '<a href="'.$page_link.'&paged='.($paged-1).'" class="btn btn-info"> < </a>';

         }



         for ($i=1; $i <= $pages; $i++){

             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){

                 $out .= ($paged == $i)? '<span class="btn btn-current">'.$i.'</span>':'<a href="'.$page_link.'&paged='.$i.'" class="inactive btn btn-info">'.$i.'</a>';

             }

         }



         if ($paged < $pages && $showitems < $pages){

            $out .= '<a href="'.$page_link.'&paged='.($paged+1).'" class="btn btn-info"> > </a>';

         }

         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages){

         $out .= '<a href="'.$page_link.'&paged='.$pages.'" class="btn btn-info"> >> </a>';

        }





         $out .= '</div>';

     }

     return $out;


}

function default_rules() {

$html = '<h2>Rules & Prizes (H2 Heading example)</h2>

<img class="alignright size-full wp-image-161" src="'.home_url().'/wp-content/plugins/photo-contest/assets/admin/image-rules.jpg" alt="soutez-fb-final-ENG-layers" width="200" height="170" />Ipsom Lorem dolor sit amet, consectetuer adipiscing elit. Phasellus faucibus molestie nisl. Nulla non lectus sed nisl molestie malesuada. Fusce dui leo, imperdiet in, aliquam sit amet, feugiat eu, orci. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Duis viverra diam non justo. Aenean placerat. Nulla non arcu lacinia neque faucibus fringilla. Praesent vitae arcu tempor neque lacinia pretium. Integer malesuada. Aenean id metus id velit ullamcorper pulvinar. Nulla non lectus sed nisl molestie malesuada. Sed convallis magna eu sem. Donec vitae arcu. Nullam feugiat, turpis at pulvinar vulputate, erat libero tristique tellus, nec bibendum odio risus sit amet ante. In rutrum. Fusce aliquam vestibulum ipsum. Aliquam ante. Etiam sapien elit, consequat eget, tristique non, venenatis quis, ante. Ipsom Lorem dolor sit amet, consectetuer adipiscing elit. Phasellus faucibus molestie nisl. Nulla non lectus sed nisl molestie malesuada.

<h3>H3 Heading example</h3>

Donec vitae arcu. Nullam feugiat, turpis at pulvinar vulputate, erat libero tristique tellus, nec bibendum odio risus sit amet ante. In rutrum. Fusce aliquam vestibulum ipsum. Aliquam ante. Etiam sapien elit, consequat eget, tristique non, venenatis quis, ante. Nulla quis diam. Maecenas ipsum velit, consectetuer eu lobortis ut, dictum at dui. Fusce tellus odio, dapibus id fermentum quis, suscipit id erat. Nullam faucibus mi quis velit. Aliquam ante. Suspendisse nisl. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla accumsan, elit sit amet varius semper, nulla mauris mollis quam, tempor suscipit diam nulla vel leo.

<h4>H4 Heading example and list example</h4>

<img class="alignright size-full wp-image-293" src="'.home_url().'/wp-content/plugins/photo-contest/assets/admin/image-rules-2.jpg" alt="pc-eng-results" width="400" />

<ul>

 	<li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>

 	<li>Aliquam tincidunt mauris eu risus.</li>

 	<li>Vestibulum auctor dapibus neque.</li>

 	<li>Nunc dignissim risus id metus.</li>

 	<li>Cras ornare tristique elit.</li>

 	<li>Vivamus vestibulum nulla nec ante.</li>

 	<li>Praesent placerat risus quis eros.</li>

 	<li>Fusce pellentesque suscipit nibh.</li>

 	<li>Integer vitae libero ac risus egestas placerat.</li>

 	<li>Vestibulum commodo felis quis tortor.</li>

 	<li>Ut aliquam sollicitudin leo.</li>

 	<li>Cras iaculis ultricies nulla.</li>

 	<li>Donec quis dui at dolor tempor interdum.</li>

 	<li>Vivamus molestie gravida turpis.</li>

 	<li>Fusce lobortis lorem at ipsum semper sagittis.</li>

 	<li>Nam convallis pellentesque nisl.</li>

 	<li>Integer malesuada commodo nulla.</li>

 	<li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>

 	<li>Aliquam tincidunt mauris eu risus.</li>

</ul>';



return $html;

}
