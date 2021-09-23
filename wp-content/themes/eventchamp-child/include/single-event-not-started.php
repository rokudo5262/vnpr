<?php
global $hardcode_options;
$hardcode_options['header_layout_select'] = 'header-style-4';
$hardcode_options['default_footer_style'] = 'footer-style-1';
$hardcode_options['footer_gap'] = 'off';

get_header();

?>
	<div>
	<?php 
	$event_start_date = get_post_meta( get_the_ID(), 'event_start_date', true );
	$event_start_time = get_post_meta( get_the_ID(), 'event_start_time', true );
	$photoGallery = get_post_meta( get_the_ID(), 'event_media_tab_images', true );

	$header = '[vc_row full_width="stretch_row_content_no_spaces"][vc_column][eventchamp_event_counter_slider detail-button-status="true" ticket-button-status="true" style="style-1" separator="False" opacity="true" opacity-value="0.1" slider-column="1" slider-space="0" autoplay="true" loopstatus="true" slider-centered-slides="false" slider-direction="horizontal" slider-effect="fade" bgtext="" slider-free-mode="false" navbuttons="false" navigation-style="style-1" dots="false" titleone="' . get_field('name_event_banner_one') . '" titletwo="' .get_field('name_event_banner_two'). '" addressdate="' .get_field('time_place'). '" excerpt="' .get_field('excerpt_event'). '" detaillink="url:%23About|title:Chi%20tiết||" detaillinkicon="" ticketlink="url:%23Tickets|title:Đăng%20ký%20ngay ||" ticketlinkicon="" eventdate="'. $event_start_date . $event_start_time .'" datebgtext="" day-text="" hour-text="" minute-text="" second-text="" bgimages="' .get_field('img_banner'). '" separator-color="" sliderheight="" opacity-color="" slider-autoplay-delay="" slider-slide-speed="" detail-button-svg-icon="" ticket-button-svg-icon=""][/vc_column][/vc_row]';
	echo do_shortcode($header);
	?>

	<div style="background-color:#ffffff;">
	
		<?php
		echo do_shortcode('[vc_empty_space height="35px"]');
		//COnference + New topic + Workshops + Speakers Talks
		$about='[vc_row full_width="stretch_row_content_no_spaces" el_id="About"][vc_column][eventchamp_content_title title="dark" size="size1" align="center" separator="true" titleone="'.get_field('name_event_one').'" titletwo="'.get_field('name_event_two').'" icon="" svg-icon="JTNDc3ZnJTIweG1sbnMlM0QlMjJodHRwJTNBJTJGJTJGd3d3LnczLm9yZyUyRjIwMDAlMkZzdmclMjIlMjB2aWV3Qm94JTNEJTIyMCUyMDAlMjAyNCUyMDI0JTIyJTIwZmlsbCUzRCUyMm5vbmUlMjIlMjBzdHJva2UlM0QlMjJjdXJyZW50Q29sb3IlMjIlMjBzdHJva2Utd2lkdGglM0QlMjIyJTIyJTIwc3Ryb2tlLWxpbmVjYXAlM0QlMjJyb3VuZCUyMiUyMHN0cm9rZS1saW5lam9pbiUzRCUyMnJvdW5kJTIyJTNFJTNDbGluZSUyMHgxJTNEJTIyMTYuNSUyMiUyMHkxJTNEJTIyOS40JTIyJTIweDIlM0QlMjI3LjUlMjIlMjB5MiUzRCUyMjQuMjElMjIlM0UlM0MlMkZsaW5lJTNFJTNDcGF0aCUyMGQlM0QlMjJNMjElMjAxNlY4YTIlMjAyJTIwMCUyMDAlMjAwLTEtMS43M2wtNy00YTIlMjAyJTIwMCUyMDAlMjAwLTIlMjAwbC03JTIwNEEyJTIwMiUyMDAlMjAwJTIwMCUyMDMlMjA4djhhMiUyMDIlMjAwJTIwMCUyMDAlMjAxJTIwMS43M2w3JTIwNGEyJTIwMiUyMDAlMjAwJTIwMCUyMDIlMjAwbDctNEEyJTIwMiUyMDAlMjAwJTIwMCUyMDIxJTIwMTZ6JTIyJTNFJTNDJTJGcGF0aCUzRSUzQ3BvbHlsaW5lJTIwcG9pbnRzJTNEJTIyMy4yNyUyMDYuOTYlMjAxMiUyMDEyLjAxJTIwMjAuNzMlMjA2Ljk2JTIyJTNFJTNDJTJGcG9seWxpbmUlM0UlM0NsaW5lJTIweDElM0QlMjIxMiUyMiUyMHkxJTNEJTIyMjIuMDglMjIlMjB4MiUzRCUyMjEyJTIyJTIweTIlM0QlMjIxMiUyMiUzRSUzQyUyRmxpbmUlM0UlM0MlMkZzdmclM0U="][vc_empty_space height="105px"]
		[vc_row_inner]<div class="container" style="margin:auto;background-color:#ffffff;">[vc_column_inner width="3/12" offset="vc_col-lg-3 vc_col-md-3 vc_col-xs-12"]
		<a class="event-about-link" href="#mapEvent" target="_parent">[eventchamp_service_box style="style-1" align="center" title="Địa điểm" text="'.get_field('info_colum_one').'" icon="fas fa-map-marker-alt" servicelink=""]</a>[vc_empty_space height="30px"][/vc_column_inner][vc_column_inner width="3/12" offset="vc_col-lg-3 vc_col-md-3 vc_col-xs-12"]
		<a class="event-about-link" href="#topicEvent" target="_parent">[eventchamp_service_box style="style-1" align="center" title="Chủ đề" text="'.get_field('info_colum_two').'" icon="" servicelink="" svg-icon="JTNDc3ZnJTIweG1sbnMlM0QlMjJodHRwJTNBJTJGJTJGd3d3LnczLm9yZyUyRjIwMDAlMkZzdmclMjIlMjB2aWV3Qm94JTNEJTIyMCUyMDAlMjAyNCUyMDI0JTIyJTIwZmlsbCUzRCUyMm5vbmUlMjIlMjBzdHJva2UlM0QlMjJjdXJyZW50Q29sb3IlMjIlMjBzdHJva2Utd2lkdGglM0QlMjIyJTIyJTIwc3Ryb2tlLWxpbmVjYXAlM0QlMjJyb3VuZCUyMiUyMHN0cm9rZS1saW5lam9pbiUzRCUyMnJvdW5kJTIyJTNFJTNDbGluZSUyMHgxJTNEJTIyOCUyMiUyMHkxJTNEJTIyNiUyMiUyMHgyJTNEJTIyMjElMjIlMjB5MiUzRCUyMjYlMjIlM0UlM0MlMkZsaW5lJTNFJTNDbGluZSUyMHgxJTNEJTIyOCUyMiUyMHkxJTNEJTIyMTIlMjIlMjB4MiUzRCUyMjIxJTIyJTIweTIlM0QlMjIxMiUyMiUzRSUzQyUyRmxpbmUlM0UlM0NsaW5lJTIweDElM0QlMjI4JTIyJTIweTElM0QlMjIxOCUyMiUyMHgyJTNEJTIyMjElMjIlMjB5MiUzRCUyMjE4JTIyJTNFJTNDJTJGbGluZSUzRSUzQ2xpbmUlMjB4MSUzRCUyMjMlMjIlMjB5MSUzRCUyMjYlMjIlMjB4MiUzRCUyMjMuMDElMjIlMjB5MiUzRCUyMjYlMjIlM0UlM0MlMkZsaW5lJTNFJTNDbGluZSUyMHgxJTNEJTIyMyUyMiUyMHkxJTNEJTIyMTIlMjIlMjB4MiUzRCUyMjMuMDElMjIlMjB5MiUzRCUyMjEyJTIyJTNFJTNDJTJGbGluZSUzRSUzQ2xpbmUlMjB4MSUzRCUyMjMlMjIlMjB5MSUzRCUyMjE4JTIyJTIweDIlM0QlMjIzLjAxJTIyJTIweTIlM0QlMjIxOCUyMiUzRSUzQyUyRmxpbmUlM0UlM0MlMkZzdmclM0U="]</a>
		[/vc_column_inner]
		[vc_column_inner width="3/12" offset="vc_col-lg-3 vc_col-md-3 vc_col-xs-12"]
		<a class="event-about-link" href="#speakerEvent" target="_parent">[eventchamp_service_box style="style-1" align="center" title="Diễn giả" text="'.get_field('info_colum_three').'" icon="fas fa-street-view" servicelink=""]</a>
		[vc_empty_space height="30px"][/vc_column_inner][vc_column_inner width="3/12" offset="vc_col-lg-3 vc_col-md-3 vc_col-xs-12"]
		<a class="event-about-link" href="#scheduleEvent" target="_parent">[eventchamp_service_box style="style-1" align="center" title="Lịch trình" text="'.get_field('info_colum_four').'" icon="far fa-calendar-alt" servicelink=""]</a>
		[vc_empty_space height="30px"][/vc_column_inner]</div>[/vc_row_inner][vc_column][/vc_row]';
		
		echo do_shortcode($about);
		?>
		<?php echo eventchamp_content_area_before(); ?>
		<div class="gt-page-content container">

								<div class="gt-content">
									<?php the_content(); ?>
								</div>

								
		</div>
		<?php echo eventchamp_content_area_after(); ?>
	
	</div>

	<?php
	echo do_shortcode('[vc_empty_space height="35px"]');
	?>

	<div style="background-color:#f6f6f6;">
	
		<?php 
		//List Speaker ( Dien gia )
		$speaker = '[vc_row full_width="stretch_row_content_no_spaces"][vc_column][vc_row_inner el_id="speakerEvent"][vc_column_inner][eventchamp_content_title title="dark" size="size1" align="center" separator="true" titleone="Chuyên gia" titletwo="Diễn giả" icon="" svg-icon="JTNDc3ZnJTIweG1sbnMlM0QlMjJodHRwJTNBJTJGJTJGd3d3LnczLm9yZyUyRjIwMDAlMkZzdmclMjIlMjB2aWV3Qm94JTNEJTIyMCUyMDAlMjAyNCUyMDI0JTIyJTIwZmlsbCUzRCUyMm5vbmUlMjIlMjBzdHJva2UlM0QlMjJjdXJyZW50Q29sb3IlMjIlMjBzdHJva2Utd2lkdGglM0QlMjIyJTIyJTIwc3Ryb2tlLWxpbmVjYXAlM0QlMjJyb3VuZCUyMiUyMHN0cm9rZS1saW5lam9pbiUzRCUyMnJvdW5kJTIyJTNFJTNDcGF0aCUyMGQlM0QlMjJNMTclMjAyMXYtMmE0JTIwNCUyMDAlMjAwJTIwMC00LTRINWE0JTIwNCUyMDAlMjAwJTIwMC00JTIwNHYyJTIyJTNFJTNDJTJGcGF0aCUzRSUzQ2NpcmNsZSUyMGN4JTNEJTIyOSUyMiUyMGN5JTNEJTIyNyUyMiUyMHIlM0QlMjI0JTIyJTNFJTNDJTJGY2lyY2xlJTNFJTNDcGF0aCUyMGQlM0QlMjJNMjMlMjAyMXYtMmE0JTIwNCUyMDAlMjAwJTIwMC0zLTMuODclMjIlM0UlM0MlMkZwYXRoJTNFJTNDcGF0aCUyMGQlM0QlMjJNMTYlMjAzLjEzYTQlMjA0JTIwMCUyMDAlMjAxJTIwMCUyMDcuNzUlMjIlM0UlM0MlMkZwYXRoJTNFJTNDJTJGc3ZnJTNF"][vc_empty_space height="80px"]<div class="container" style="background-color:#f6f6f6;">[eventchamp_event_content contenttype="speaker" speaker-style="6" speaker-column="2" speaker-column-space="30" speaker-profession="true" speaker-summary="true" speaker-social-links="true" schedule-style="1" schedule-collapsed="true" ticket-style="1" price-list-column="1" ticket-column-space="0" sponsor-style="1" sponsor-column="1" sponsor-column-space="0" photo-column="1" photo-column-space="0" map-style="1" eventid="'.get_the_ID().'" map-height="" map-zoom=""]</div>[vc_empty_space height="120px"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]';
		echo do_shortcode($speaker) ?>
	
	</div>

	<div style="background-color:#ffffff;">
	
		<?php 
		//Noi dung Huan Luyen
		$schedule = '[vc_row full_width="stretch_row_content_no_spaces" el_id="scheduleEvent"][vc_column][vc_empty_space height="35px"][eventchamp_content_title title="dark" size="size1" align="center" separator="true" titleone="Nội dung" titletwo="Huấn luyện" icon="" svg-icon="JTNDc3ZnJTIweG1sbnMlM0QlMjJodHRwJTNBJTJGJTJGd3d3LnczLm9yZyUyRjIwMDAlMkZzdmclMjIlMjB2aWV3Qm94JTNEJTIyMCUyMDAlMjAyNCUyMDI0JTIyJTIwZmlsbCUzRCUyMm5vbmUlMjIlMjBzdHJva2UlM0QlMjJjdXJyZW50Q29sb3IlMjIlMjBzdHJva2Utd2lkdGglM0QlMjIyJTIyJTIwc3Ryb2tlLWxpbmVjYXAlM0QlMjJyb3VuZCUyMiUyMHN0cm9rZS1saW5lam9pbiUzRCUyMnJvdW5kJTIyJTNFJTNDcGF0aCUyMGQlM0QlMjJNMjIlMjAxOWEyJTIwMiUyMDAlMjAwJTIwMS0yJTIwMkg0YTIlMjAyJTIwMCUyMDAlMjAxLTItMlY1YTIlMjAyJTIwMCUyMDAlMjAxJTIwMi0yaDVsMiUyMDNoOWEyJTIwMiUyMDAlMjAwJTIwMSUyMDIlMjAyeiUyMiUzRSUzQyUyRnBhdGglM0UlM0MlMkZzdmclM0U="][vc_empty_space height="115px"]<div class="container" style="background-color:#ffffff;">[eventchamp_event_content contenttype="schedule" speaker-style="1" speaker-column="1" speaker-column-space="0" speaker-profession="true" speaker-summary="true" speaker-social-links="true" schedule-style="5" schedule-collapsed="true" ticket-style="1" price-list-column="1" ticket-column-space="0" sponsor-style="1" sponsor-column="1" sponsor-column-space="0" photo-column="1" photo-column-space="0" map-style="1" eventid="'.get_the_ID().'" map-height="" map-zoom=""]</div>[vc_empty_space height="120px"][/vc_column][/vc_row]';
		echo do_shortcode($schedule); ?>
	
	</div>

	<?php 
		//Map
		$mapEv='[vc_row full_width="stretch_row_content_no_spaces" row-text-align="center" background-position="center-center" background-attachment="fixed" css=".vc_custom_1560530611972{background: #121219 url(https://demo.gloriathemes.com/eventchamp/demo/wp-content/uploads/2018/11/section-2.jpg?id=699) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" el_id="mapEvent"][vc_column][vc_empty_space height="35px"][eventchamp_content_title title="white" size="size1" align="center" separator="true" titleone="Địa điểm" titletwo="Diễn ra" icon="" svg-icon="JTNDc3ZnJTIweG1sbnMlM0QlMjJodHRwJTNBJTJGJTJGd3d3LnczLm9yZyUyRjIwMDAlMkZzdmclMjIlMjB2aWV3Qm94JTNEJTIyMCUyMDAlMjAyNCUyMDI0JTIyJTIwZmlsbCUzRCUyMm5vbmUlMjIlMjBzdHJva2UlM0QlMjJjdXJyZW50Q29sb3IlMjIlMjBzdHJva2Utd2lkdGglM0QlMjIyJTIyJTIwc3Ryb2tlLWxpbmVjYXAlM0QlMjJyb3VuZCUyMiUyMHN0cm9rZS1saW5lam9pbiUzRCUyMnJvdW5kJTIyJTNFJTNDcGF0aCUyMGQlM0QlMjJNMjElMjAxMGMwJTIwNy05JTIwMTMtOSUyMDEzcy05LTYtOS0xM2E5JTIwOSUyMDAlMjAwJTIwMSUyMDE4JTIwMHolMjIlM0UlM0MlMkZwYXRoJTNFJTNDY2lyY2xlJTIwY3glM0QlMjIxMiUyMiUyMGN5JTNEJTIyMTAlMjIlMjByJTNEJTIyMyUyMiUzRSUzQyUyRmNpcmNsZSUzRSUzQyUyRnN2ZyUzRQ==" description="'.get_field('address_map').'"][vc_empty_space height="15px"][vc_empty_space height="120px"][/vc_column][/vc_row]';
		echo do_shortcode($mapEv);
		echo get_field('map_event');
	?>

	<div style="background-color:#ffffff;">
	
	<?php 
		//Tickets
		$ticket='[vc_empty_space height="35px"][vc_row full_width="stretch_row_content_no_spaces" el_id="Tickets"][vc_column][eventchamp_content_title title="dark" size="size1" align="center" separator="true" titleone="Thông tin" titletwo="Đăng ký" icon="" svg-icon="JTNDc3ZnJTIwZmlsbCUzRCUyMmN1cnJlbnRDb2xvciUyMiUyMHZpZXdCb3glM0QlMjIwJTIwLTk4JTIwNTEyJTIwNTEyJTIyJTIweG1sbnMlM0QlMjJodHRwJTNBJTJGJTJGd3d3LnczLm9yZyUyRjIwMDAlMkZzdmclMjIlM0UlM0NwYXRoJTIwZCUzRCUyMm00OTIlMjAwaC00NzJjLTExLjA0Njg3NSUyMDAtMjAlMjA4Ljk1MzEyNS0yMCUyMDIwdjI3NS4zMzU5MzhjMCUyMDExLjA0Mjk2OCUyMDguOTUzMTI1JTIwMjAlMjAyMCUyMDIwaDQ3MmMxMS4wNDY4NzUlMjAwJTIwMjAtOC45NTcwMzIlMjAyMC0yMHYtMjc1LjMzNTkzOGMwLTExLjA0Njg3NS04Ljk1MzEyNS0yMC0yMC0yMHptLTExOC4zMjQyMTklMjAyNzUuMzM1OTM4aC0yMzUuMzUxNTYyYy04LjQ1MzEyNS01MC4xNzU3ODItNDguMTQ4NDM4LTg5Ljg3MTA5NC05OC4zMjQyMTktOTguMzI0MjE5di0zOC42ODc1YzUwLjE3NTc4MS04LjQ1MzEyNSUyMDg5Ljg3MTA5NC00OC4xNDg0MzglMjA5OC4zMjQyMTktOTguMzI0MjE5aDIzNS4zNTE1NjJjOC40NTMxMjUlMjA1MC4xNzU3ODElMjA0OC4xNDg0MzglMjA4OS44NzEwOTQlMjA5OC4zMjQyMTklMjA5OC4zMjQyMTl2MzguNjg3NWMtNTAuMTc1NzgxJTIwOC40NTMxMjUtODkuODcxMDk0JTIwNDguMTQ4NDM3LTk4LjMyNDIxOSUyMDk4LjMyNDIxOXptOTguMzI0MjE5LTE3Ny44NjcxODhjLTI4LjA3MDMxMi03LjI1LTUwLjIxODc1LTI5LjM5ODQzOC01Ny40Njg3NS01Ny40Njg3NWg1Ny40Njg3NXptLTM3NC41MzEyNS01Ny40Njg3NWMtNy4yNSUyMDI4LjA3MDMxMi0yOS4zOTg0MzglMjA1MC4yMTg3NS01Ny40Njg3NSUyMDU3LjQ2ODc1di01Ny40Njg3NXptLTU3LjQ2ODc1JTIwMTc3Ljg2NzE4OGMyOC4wNzAzMTIlMjA3LjI1JTIwNTAuMjE4NzUlMjAyOS4zOTQ1MzElMjA1Ny40Njg3NSUyMDU3LjQ2ODc1aC01Ny40Njg3NXptMzc0LjUzMTI1JTIwNTcuNDY4NzVjNy4yNS0yOC4wNzQyMTklMjAyOS4zOTg0MzgtNTAuMjE4NzUlMjA1Ny40Njg3NS01Ny40Njg3NXY1Ny40Njg3NXptLTE1OC41MzEyNS0yMTYuMzM1OTM4Yy01NC40MDYyNSUyMDAtOTguNjY3OTY5JTIwNDQuMjYxNzE5LTk4LjY2Nzk2OSUyMDk4LjY2Nzk2OSUyMDAlMjA1NC40MDIzNDMlMjA0NC4yNjE3MTklMjA5OC42Njc5NjklMjA5OC42Njc5NjklMjA5OC42Njc5NjlzOTguNjY3OTY5LTQ0LjI2NTYyNiUyMDk4LjY2Nzk2OS05OC42Njc5NjljMC01NC40MDYyNS00NC4yNjE3MTktOTguNjY3OTY5LTk4LjY2Nzk2OS05OC42Njc5Njl6bTAlMjAxNTcuMzM1OTM4Yy0zMi4zNDc2NTYlMjAwLTU4LjY2Nzk2OS0yNi4zMjAzMTMtNTguNjY3OTY5LTU4LjY2Nzk2OSUyMDAtMzIuMzUxNTYzJTIwMjYuMzIwMzEzLTU4LjY2Nzk2OSUyMDU4LjY2Nzk2OS01OC42Njc5NjlzNTguNjY3OTY5JTIwMjYuMzE2NDA2JTIwNTguNjY3OTY5JTIwNTguNjY3OTY5YzAlMjAzMi4zNDc2NTYtMjYuMzIwMzEzJTIwNTguNjY3OTY5LTU4LjY2Nzk2OSUyMDU4LjY2Nzk2OXptMCUyMDAlMjIlM0UlM0MlMkZwYXRoJTNFJTNDJTJGc3ZnJTNF"][vc_empty_space height="115px"]<div class="container" style="background-color:#ffffff;">[eventchamp_event_content contenttype="ticket" speaker-style="1" speaker-column="1" speaker-column-space="0" speaker-profession="true" speaker-summary="true" speaker-social-links="true" schedule-style="1" schedule-collapsed="true" ticket-style="1" price-list-column="4" ticket-column-space="30" sponsor-style="1" sponsor-column="1" sponsor-column-space="0" photo-column="1" photo-column-space="0" map-style="1" eventid="'.get_the_ID().'" map-height="" map-zoom=""]</div>[vc_empty_space height="120px"][/vc_column][/vc_row]';
		echo do_shortcode($ticket);
	?>
	
	</div>
	
	<div >
	<?php
		//NewsLetter
		echo do_shortcode('[vc_row full_width="stretch_row_content_no_spaces" background-position="center-center" background-attachment="fixed" css=".vc_custom_1560530621560{background: #121219 url(https://demo.gloriathemes.com/eventchamp/demo/wp-content/uploads/2018/11/section-1.jpg?id=308) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" el_id="Newsletter"][vc_column][vc_empty_space height="75px"][eventchamp_content_title title="white" size="size1" align="center" separator="true" titleone="ĐĂNG KÝ NHẬN THÔNG TIN" titletwo="" description="Tham gia danh sách bản tin điện tử của chúng tôi để theo dõi chặt chẽ tất cả các tin tức." icon="" svg-icon="JTNDc3ZnJTIweG1sbnMlM0QlMjJodHRwJTNBJTJGJTJGd3d3LnczLm9yZyUyRjIwMDAlMkZzdmclMjIlMjB2aWV3Qm94JTNEJTIyMCUyMDAlMjAyNCUyMDI0JTIyJTIwZmlsbCUzRCUyMm5vbmUlMjIlMjBzdHJva2UlM0QlMjJjdXJyZW50Q29sb3IlMjIlMjBzdHJva2Utd2lkdGglM0QlMjIyJTIyJTIwc3Ryb2tlLWxpbmVjYXAlM0QlMjJyb3VuZCUyMiUyMHN0cm9rZS1saW5lam9pbiUzRCUyMnJvdW5kJTIyJTNFJTNDcGF0aCUyMGQlM0QlMjJNNCUyMDRoMTZjMS4xJTIwMCUyMDIlMjAuOSUyMDIlMjAydjEyYzAlMjAxLjEtLjklMjAyLTIlMjAySDRjLTEuMSUyMDAtMi0uOS0yLTJWNmMwLTEuMS45LTIlMjAyLTJ6JTIyJTNFJTNDJTJGcGF0aCUzRSUzQ3BvbHlsaW5lJTIwcG9pbnRzJTNEJTIyMjIlMkM2JTIwMTIlMkMxMyUyMDIlMkM2JTIyJTNFJTNDJTJGcG9seWxpbmUlM0UlM0MlMkZzdmclM0U="][vc_empty_space height="110px"][vc_row_inner]<div class="container">[vc_column_inner offset="vc_col-lg-1 vc_col-md-1 vc_hidden-sm vc_hidden-xs"][/vc_column_inner][vc_column_inner offset="vc_col-lg-10 vc_col-md-10 vc_col-xs-12"][newsletter_signup_form id=1][/vc_column_inner][vc_column_inner offset="vc_col-lg-1 vc_col-md-1 vc_hidden-sm vc_hidden-xs"][/vc_column_inner]</div>[/vc_row_inner][vc_empty_space height="120px"][/vc_column][/vc_row]');
		
	?>
	</div>
	
	<div style="background:#ffffff">
	<?php
	//Media Gallery
	echo do_shortcode('[vc_row full_width="stretch_row_content_no_spaces"][vc_column][vc_empty_space height="75px"][eventchamp_content_title title="dark" size="size1" align="center" separator="true" titleone="Hình ảnh" titletwo="Sự kiện" icon="" svg-icon="JTNDc3ZnJTIweG1sbnMlM0QlMjJodHRwJTNBJTJGJTJGd3d3LnczLm9yZyUyRjIwMDAlMkZzdmclMjIlMjB2aWV3Qm94JTNEJTIyMCUyMDAlMjAyNCUyMDI0JTIyJTIwZmlsbCUzRCUyMm5vbmUlMjIlMjBzdHJva2UlM0QlMjJjdXJyZW50Q29sb3IlMjIlMjBzdHJva2Utd2lkdGglM0QlMjIyJTIyJTIwc3Ryb2tlLWxpbmVjYXAlM0QlMjJyb3VuZCUyMiUyMHN0cm9rZS1saW5lam9pbiUzRCUyMnJvdW5kJTIyJTNFJTNDcmVjdCUyMHglM0QlMjIzJTIyJTIweSUzRCUyMjMlMjIlMjB3aWR0aCUzRCUyMjE4JTIyJTIwaGVpZ2h0JTNEJTIyMTglMjIlMjByeCUzRCUyMjIlMjIlMjByeSUzRCUyMjIlMjIlM0UlM0MlMkZyZWN0JTNFJTNDY2lyY2xlJTIwY3glM0QlMjI4LjUlMjIlMjBjeSUzRCUyMjguNSUyMiUyMHIlM0QlMjIxLjUlMjIlM0UlM0MlMkZjaXJjbGUlM0UlM0Nwb2x5bGluZSUyMHBvaW50cyUzRCUyMjIxJTIwMTUlMjAxNiUyMDEwJTIwNSUyMDIxJTIyJTNFJTNDJTJGcG9seWxpbmUlM0UlM0MlMkZzdmclM0U="][vc_empty_space height="115px"][eventchamp_image_gallery_element caption="true" column="6" column-space="0" images="'.$photoGallery.'"][/vc_column][/vc_row]');
	?>
	</div>

<?php get_footer(); ?>

<style>
/* Count */
.vc_custom_1560530634753{
	background: #121219 url(https://demo.gloriathemes.com/eventchamp/demo/wp-content/uploads/2018/11/section-3.jpg?id=695) !important
	;background-position: center !important
	;background-repeat: no-repeat !important
	;background-size: cover !important;
}

/* Newsletter */
.vc_custom_1560530621560{
	background: #121219 url(https://demo.gloriathemes.com/eventchamp/demo/wp-content/uploads/2018/11/section-1.jpg?id=308) !important;
	background-position: center !important;
	background-repeat: no-repeat !important;
	background-size: cover !important;
}
/* Venue */
.vc_custom_1560530611972{
	background: #121219 url(https://demo.gloriathemes.com/eventchamp/demo/wp-content/uploads/2018/11/section-2.jpg?id=699) !important;
	background-position: center !important;
	background-repeat: no-repeat !important;
	background-size: cover !important;
}

.containerEvent{margin:0% 17% 0% 17%;}

iframe{
	width:100% !important;
}

.gt-countdown-slider.gt-style-1>.gt-slider-content {
    margin: auto;
    left: 0;
    right: 0;
    position: absolute;
    max-width: 1020px;
    text-align: center;
    z-index: 10;
    color: #fff;
    margin-top: -50px;
    padding: 0 15px;
}

.gt-slider-content {
    margin-top: 0px!important;
}

.gt-countdown-slider.gt-style-1>.gt-counter:before {
    content: '';
    display: block;
    width: 100%;
    height: 100%;
    opacity: .65;
    position: absolute;
    top: 0;
    left: 0;
}

.gt-countdown-slider.gt-style-1>.gt-slider-content .gt-buttons a, .gt-countdown-slider.gt-style-1>.gt-slider-content .gt-buttons a:visited {
    background: 0 0;
    border: 2px solid #fff;
    color: #fff;
    text-transform: uppercase;
    font-weight: 500;
    font-size: .9231rem;
    padding: 11px 40px;
    margin: 0 22.5px 22.5px;
    display: inline-flex;
    border-radius: 25px;
    align-items: center;
}

*, ::after, ::before {
    box-sizing: border-box;
}

a.event-about-link:hover{
	color:#333333;
}
</style>