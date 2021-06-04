<?php
/**
	* The template for displaying single
*/
get_header(); ?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">

	<?php echo eventchamp_sub_content_before(); ?>

		<?php echo eventchamp_page_title_bar(); ?>

		<?php while ( have_posts() ) { ?>

			<?php the_post(); ?>

				<?php
					if( post_password_required() ) {

                        echo eventchamp_container_before();

						if( function_exists( 'eventchamp_password_protected_box' ) ) {

							echo eventchamp_password_protected_box();

						}

					} else {
				?>
                    <?php 
                    global $post;
                    $postcat = get_the_category( $post->ID );
                    
                    if($postcat[0]->slug != 'kien-thuc'){?>

                        <?php echo eventchamp_container_before(); ?>

                            <?php echo eventchamp_row_before(); ?>

                                <?php echo eventchamp_content_area_before(); ?>

                                    <div class="gt-page-content">
                                        <?php echo eventchamp_post_header( $id = get_the_ID() ); ?>

                                        <div class="gt-content">
                                            <?php the_content(); ?>
                                        </div>

                                        <?php
                                            wp_link_pages(
                                                array(
                                                    'before' => '<div class="gt-post-pages"><span class="gt-title">' . esc_html__( 'Pages:', 'eventchamp' ) . '</span>',
                                                    'after' => '</div>',
                                                    'link_before' => '<span>',
                                                    'link_after' => '</span>',
                                                )
                                            );
                                        ?>
                                        

                                        <?php echo eventchamp_post_meta( $id = get_the_ID() ); ?>

                                        <?php 
                                            $post_tags = ot_get_option( 'post_post_tags', 'on' );
                                            $tag_style = ot_get_option( 'post-tags-style', 'style-1' );

                                            if ( $post_tags == 'on' ) {

                                                the_tags( '<div class="gt-tags gt-' . esc_attr( $tag_style ) . '"><ul><li>', '</li><li>', '</li></ul></div>' );

                                            }
                                        ?>

                                        <?php echo eventchamp_post_social_sharing(); ?>
                                    </div>

                                    <?php echo eventchamp_post_navigation(); ?>

                                    <?php echo eventchamp_author_box(); ?>

                                    <?php echo eventchamp_related_posts( $id = get_the_ID() ); ?>

                                    <?php
                                        $post_comments = ot_get_option( 'post_post_comment_area', 'on' );

                                        if( $post_comments == "on" ) {

                                            if ( comments_open() || get_comments_number() ) {

                                                comments_template();

                                            }

                                        }
                                    ?>
                                    
                                <?php echo eventchamp_content_area_after(); ?>
                                
                                <?php get_sidebar(); ?> 

                            <?php echo eventchamp_row_after(); ?>

                        <?php echo eventchamp_container_after(); ?>

                    <?php }else{
                        $check = true?>
                        
                        <!-- Phần Hiển Thị Thứ 1 -->
                        <div class="container">
                            <?php echo get_field('textarea1')?>
                            <div class="VC-custom" id="VC-custom">
                                <div class="col-10 VC-line"></div>
                                <div class="col-2 VC-button">
                                    <a href="#thamgiangay"><?php echo get_field('button_tham_gia_ngay') ?></a>
                                </div>
                            </div>
                        </div>

                        <!-- Phần Hiển Thị Ban Giám Khảo -->
                        <div class="container-fluid py-5 px-0" id="VC-custom-bangk">
                            <?php
                            $image = acf_photo_gallery("gallery", $post->ID);
                            ?>
                            <div class="row mx-auto my-auto" style="display: flex;flex-wrap: nowrap;">
                                <div id="backgroundleft-bgk"></div>
                                <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                                    <!-- list image -->
                                    <div class="carousel-inner w-100" role="listbox">
                                    <?php
                                        foreach($image as $key => $value){
                                            if($key==0){
                                            ?>
                                                    <div class="carousel-item active">
                                                        <div class="col-md-4">
                                                            <img class="img-fluid" src="<?php echo $value['full_image_url']; ?>">
                                                        </div>
                                                    </div>
                                            <?php }else{
                                                ?>
                                                    <div class="carousel-item">
                                                        <div class="col-md-4">
                                                            <img class="img-fluid" src="<?php echo $value['full_image_url']; ?>">
                                                        </div>
                                                    </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                    </div>

                                    <!-- arrow -->
                                    <a class="carousel-control-prev w-auto" href="#recipeCarousel" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle" aria-hidden="true" id="custom-kienthuc"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next w-auto" href="#recipeCarousel" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle" aria-hidden="true" id="custom-kienthuc"></span>
                                        <span class="sr-only">Next</span>
                                    </a>

                                </div>
                                <div id="backgroundright-bgk">
                                    <div id="LINE40" class="ladi-element">
                                        <div class="ladi-line">
                                            <div class="ladi-line-container"></div>
                                        </div>
                                    </div>
                                    <div id="HEADLINE39" class="ladi-element">
                                        <h3 class="ladi-headline ladi-transition">Ban giám khảo</h3>
                                    </div>
                                </div>
                            </div>

                        </div>

                         <!-- Phần Hiển Thị Nhà Tài Trợ -->
                         <div class="container py-5 px-0" id="VC-custom-ntt">
                            <?php
                            $images = acf_photo_gallery("nhataitro", $post->ID);
                            ?>
                            <div class="row mx-auto my-auto">
                                <div class="container banner-ntt">
                                    <h3 class="banner">Nhà Tài Trợ</h3>
                                    <div class="linentt"></div>
                                </div>
                                <div class="recipeCarouselntt my-5" id="recipeCarouselntt" style="position: relative;width: 100%;">
                                    <?php foreach($images as $key => $value){?>
                                            <div><img src="<?php echo $value['full_image_url']; ?>" alt="<?php echo $value['title']; ?>"/></div>
                                    <?php }?>
                                </div>
                            </div>

                        </div>

                        <!-- Phần Hiển Thị Thông Tin Báo Trí -->
                        <div class="container py-5 px-0" id="VC-custom-thongtinbaotri">
                            <?php
                            $imagethongtinbaotri = acf_photo_gallery("thongtinbaotri", $post->ID);
                            ?>
                            <div class="row mx-auto my-auto">
                                <div class="container banner-ntt">
                                    <h3 class="banner">Thông Tin Báo Chí</h3>
                                    <h3 class="xct">Click vào từng mục để xem chi tiết</h3>
                                    <div class="linentt"></div>
                                </div>
                                <div class="Carouselthongtinbaotri my-5" id="Carouselthongtinbaotri" style="position: relative;width: 100%;">
                                    <?php foreach($imagethongtinbaotri as $key => $value){?>
                                            <div><img src="<?php echo $value['full_image_url']; ?>" alt="<?php echo $value['title']; ?>"/></div>
                                    <?php }?>
                                </div>
                            </div>

                        </div>

                        <!-- Phần Hiển Thị Hình Ảnh Dự Thi -->
                        <div class="container py-5 px-0" id="VC-custom-hinhanhduthi">
                            <?php
                            $imagehinhanhduthi = acf_photo_gallery("hinhanhduthi", $post->ID);
                            // echo '<pre>';
                            // print_r($imagehinhanhduthi);
                            // echo '</pre>';
                            ?>
                            <div class="row mx-auto my-auto">
                                <div class="container banner-ntt">
                                    <h3 class="banner">Hình Ảnh Dự Kiến</h3>
                                    <div class="linentt"></div>
                                </div>
                                <div class="Carouselhinhanhduthi my-5" id="Carouselhinhanhduthi" style="position: relative;width: 100%;">
                                    <?php foreach($imagehinhanhduthi as $key => $value){?>
                                            <div><img src="<?php echo $value['full_image_url']; ?>" alt="<?php echo $value['title']; ?>"/></div>
                                    <?php }?>
                                </div>
                            </div>

                        </div>

                        <!-- Phần Hiển Thị Đăng Ký Tham Gia Ngay -->
                        <div class="ladi-section container-fluid pt-5" id="VC-custom-dangky" style="margin-top: 140px;">
                            <div class="ladi-section-background"></div>
                            <div class="ladi-overlay"></div>
                            <div class="container ladi-container">
                                <div id="IMAGE401" class="ladi-element ladi-animation">
                                    <div class="ladi-image">
                                        <div class="ladi-image-background"></div>
                                    </div>
                                </div>
                                <div id="GROUP760" class="ladi-element">
                                    <div class="ladi-group">
                                        <div id="BOX744" class="ladi-element">
                                            <div class="ladi-box"></div>
                                        </div>
                                        <div id="HEADLINE403" class="ladi-element">
                                            <h3 class="ladi-headline">Đăng ký dự thi ngay</h3>
                                        </div>
                                        <a href="mailto:admin@vnpr.vn" id="BUTTON738" class="ladi-element">Gửi qua Email</a>
                                        <div id="HEADLINE759" class="ladi-element">
                                            <h3 class="ladi-headline">
                                            (Tiêu đề email: Bài dự thi_Tên tác giả_Cuộc thi ảnh “Kiên cường Việt Nam - Resilient Vietnam”)
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div id="HEADLINE465" class="ladi-element">
                                    <h3 class="ladi-headline">
                                        <span style="font-weight: bold; color: rgb(255, 236, 0);">Quyền sử dụng ảnh:</span>
                                        Ban Tổ chức có quyền xuất bản và sử dụng các bức ảnh dự thi cho mục đích quảng bá cuộc thi mà không phải trả bất kỳ khoản chi phí phát sinh nào. Việc lựa chọn ảnh đăng cho mục đích quảng bá của cuộc thi không đồng nghĩa với việc những bức ảnh đó sẽ đoạt giải.
                                    </h3>
                                </div>
                                <div id="HEADLINE526" class="ladi-element">
                                    <h3 class="ladi-headline">VIETNAM PUBLIC RELATIONS NETWORK</h3>
                                </div>
                                <div id="HEADLINE525" class="ladi-element">
                                    <h3 class="ladi-headline">
                                    Vietnam Public Relations Network (VNPR) là mạng lưới những người làm nghề Quan hệ Công chúng nhằm hướng tới mục tiêu lâu dài là thành lập một tổ chức xã hội nghề nghiệp. Với tổ chức này, ngành quan hệ công chúng sẽ được phát triển mạnh mẽ hơn, được công nhận và tôn vinh như một nghề nghiệp đúng với ý nghĩa của nó, đáp ứng những thay đổi mô hình PR trong giai đoạn mới, góp phần tích cực hơn vào việc phát triển kinh tế và xã hội.
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <?php if($check){?>
                            <style>
                                footer {
                                    margin-top: 0 !important;
                                }
                            </style>
                        <?php } ?>
                    <?php }?>

				<?php } ?>

		<?php } ?>
		
	<?php echo eventchamp_sub_content_after(); ?>

<?php get_footer();?>

<style>
    @import url("https://use.fontawesome.com/releases/v5.13.0/css/all.css");
    #VC-custom-bangk .col-md-4{
        padding: 0 !important;
    }
    #VC-custom-bangk #backgroundleft-bgk{
        width: 16.5% !important;
        background: rgba(164, 31, 34, 0.3);
        background: -webkit-linear-gradient(90deg, rgba(164, 31, 34, 0.3), rgba(164, 31, 33, 1));
        background: linear-gradient(90deg, rgba(164, 31, 34, 0.3), rgba(164, 31, 33, 1));
    }
    #VC-custom-bangk #recipeCarousel{
        width: 47.5% !important;
        height: 400px !important;
    }
    #VC-custom-bangk #recipeCarousel .carousel-item {
        height: 400px !important;
    }
    #VC-custom-bangk #backgroundright-bgk {
        width: 36% !important;
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url(https://w.ladicdn.com/s1100x750/5c7362c6c417ab07e5196b05/cv19_261s-20200823132902.jpg);
        background-position: center center;
        background-repeat: repeat;
    }
    #VC-custom-bangk #backgroundright-bgk #HEADLINE39 {
        width: 100%;
        height: 100%;
        position: relative;
        background: rgba(164, 31, 35, 0.9);
        background: -webkit-linear-gradient(180deg , rgba(164, 31, 35, 0.9), rgba(124, 20, 22, 1.0));
        background: linear-gradient(180deg , rgba(164, 31, 35, 0.9), rgba(124, 20, 22, 1.0));
    }
    #VC-custom-bangk #backgroundright-bgk #HEADLINE39 .ladi-headline.ladi-transition{
        margin: 8% 5% 0;
        font: inherit;
        position: absolute;
        font-family: "Oswald", sans-serif;
        color: rgb(255, 255, 255);
        font-size: 36px;
        line-height: 1.4;
    }
    #VC-custom-bangk #backgroundright-bgk #LINE40{
        margin: 35px 36px 0px;
        position: absolute;
        width: 48px;
    }
    #VC-custom-bangk #backgroundright-bgk #LINE40 > .ladi-line{
        width: 100%;
        position: absolute;
        z-index: 29;
    }
    #VC-custom-bangk #backgroundright-bgk #LINE40 > .ladi-line > .ladi-line-container{
        border-top: 3px solid rgb(255, 236, 0);
        border-right: 3px solid rgb(255, 236, 0);
        border-bottom: 3px solid rgb(255, 236, 0);
        border-left: 0px;
        border-bottom: 0;
        border-right: 0;
        width: 100%;
        height: 100%;
    }
    #VC-custom-bangk span#custom-kienthuc {
        width: 40px !important;
        height: 40px !important;
        border-radius: 0 !important;
        background-size: 50% 100% !important;
        background-color: rgba(255,255,255,0.2) !important;
        border: none !important;
    }
    @media (max-width: 768px) {
        .carousel-inner .carousel-item > div {
            display: none;
        }
        .carousel-inner .carousel-item > div:first-child {
            display: block;
        }
    }
    .carousel-inner .carousel-item.active,
    .carousel-inner .carousel-item-next,
    .carousel-inner .carousel-item-prev {
        display: flex;
    }
    @media (min-width: 768px) {
        
        .carousel-inner .carousel-item-right.active,
        .carousel-inner .carousel-item-next {
        transform: translateX(33.333%);
        }
        
        .carousel-inner .carousel-item-left.active, 
        .carousel-inner .carousel-item-prev {
        transform: translateX(-33.333%);
        }
    }
    .carousel-inner .carousel-item-right,
    .carousel-inner .carousel-item-left{ 
        transform: translateX(0);
    }

    /* css nhà tài trợ */
    .banner-ntt{
        display: flex;
        justify-content: center;
        flex-direction: column;
        place-items: center;
    }
    .banner-ntt h3.banner{
        font-family: "Oswald", sans-serif;
        color: rgb(122, 20, 22);
        font-size: 48px !important;
        text-align: center;
        line-height: 1.6;
        margin: 0;
        font: inherit;
    }
    .banner-ntt h3.xct{
        color: rgb(132, 132, 132);
        font-size: 14px;
        text-align: center;
        line-height: 1.6;
        margin: 0;
    }
    .linentt {
        margin-top: 20px;
        width: 73px;
        border-top: 3px solid rgb(255, 235, 0);
        border-right: 3px solid rgb(255, 235, 0);
        border-bottom: 3px solid rgb(255, 235, 0);
        border-left: 0px !important;
        border-bottom: 0!important;
        border-right: 0!important;
    }
    #VC-custom-bangk .slick-slide,
    #VC-custom-ntt .slick-slide {
        margin: 25px;
        display: flex !important;
        flex-direction: column;
        justify-content: center;
    }
    #VC-custom-bangk .slick-track,
    #VC-custom-ntt .slick-track{
        height: 250px;
    }
    #VC-custom-bangk .slick-prev,
    #VC-custom-ntt .slick-prev{
        width: 40px !important;
        height: 40px !important;
        z-index: 29;
        left: -5px;
        outline: none !important;
        border: none !important;
    }
    #VC-custom-bangk .slick-prev:before,
    #VC-custom-ntt .slick-prev:before{
        content: "\f053";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
    }
    #VC-custom-bangk .slick-next,
    #VC-custom-ntt .slick-next {
        width: 40px !important;
        height: 40px !important;
        z-index: 29;
        right: -6px;
        outline: none !important;
        border: none !important;
    }
    #VC-custom-bangk .slick-next:before,
    #VC-custom-ntt .slick-next:before {
        content: "\f054";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
    }
    #VC-custom-bangk .slick-prev:hover,
    #VC-custom-ntt .slick-prev:hover,
    #VC-custom-bangk .slick-next:hover,
    #VC-custom-ntt .slick-next:hover {
        border-radius: 0 !important;
        background-size: 50% 100% !important;
        background-color: rgba(255,255,255,0.2) !important;
        border: none !important;
    }

    /* Hình ảnh dự thi*/
    #Carouselhinhanhduthi .slick-slide img {
        width: 880px;
    }
    #Carouselhinhanhduthi .slick-slide {
        text-align: center;
        text-align: -webkit-center;
    }
    #Carouselhinhanhduthi .slick-prev {
        width: 40px !important;
        height: 40px !important;
        z-index: 29;
        left: 16.5%;
        outline: none !important;
        border: none !important;
    }
    #Carouselhinhanhduthi .slick-next {
        width: 40px !important;
        height: 40px !important;
        z-index: 29;
        right: 16.5%;
        outline: none !important;
        border: none !important;
    }
    #Carouselhinhanhduthi .slick-prev:before {
        content: "\f053";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
    }
    #Carouselhinhanhduthi .slick-next:before {
        content: "\f054";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
    }
    #Carouselhinhanhduthi .slick-prev:hover,
    #Carouselhinhanhduthi .slick-next:hover {
        border-radius: 0 !important;
        background-size: 50% 100% !important;
        background-color: rgba(255,255,255,0.2) !important;
        border: none !important;
    }

    /* Đăng Ký Tham Gia Ngay*/
    #VC-custom-dangky {
        height: 750px;
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
    #VC-custom-dangky .ladi-section-background {
        background-color: rgb(164, 31, 33);
        position: absolute;
        width: 100%;
        height: inherit;
    }
    #VC-custom-dangky .ladi-overlay {
        position: absolute;
        width: 100%;
        height: inherit;
        background-size: cover;
        background-attachment: scroll;
        background-origin: content-box;
        background-image: url(https://w.ladicdn.com/s350x1050/5c7362c…/untitled-2-20200822125029.png);
        background-position: center top;
        background-repeat: repeat;
        mix-blend-mode: multiply;
        will-change: transform, opacity;
    }
    #VC-custom-dangky .ladi-container {
        height: inherit;
        display: flex;
        flex-direction: column;
    }
    #VC-custom-dangky .ladi-container #HEADLINE465 h3 span {
        font-weight: bold;
        color: rgb(255, 236, 0);
        font-family: Muli, sans-serif;
    }
    #VC-custom-dangky .ladi-container #HEADLINE465 h3 {
        position: relative;
        color: rgb(228, 228, 228);
        font-size: 16px;
        font-style: italic;
        text-align: center;
        line-height: 1.6;
        font-weight: 400;
    }
    #VC-custom-dangky .ladi-container #HEADLINE526 h3 {
        font-family: "Oswald", sans-serif;
        color: rgb(255, 236, 0);
        font-size: 23px;
        text-align: center;
        line-height: 1.6;
        position: relative;
        font-weight: inherit;
    }
    #VC-custom-dangky .ladi-container #HEADLINE525 h3 {
        position: relative;
        color: rgb(228, 228, 228);
        font-size: 16px;
        text-align: center;
        line-height: 1.6;
        font-weight: 400;
    }
    #VC-custom-dangky .ladi-container #GROUP760 {
        margin-top: 183px;
    }
    #VC-custom-dangky .ladi-container #GROUP760 .ladi-group {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        text-align: -webkit-center;
    }
    #VC-custom-dangky .ladi-container #GROUP760 .ladi-group #BOX744 {
        position: absolute;
        width: 650px;
        height: inherit;
        background-color: rgb(255, 255, 255);
    }
    #VC-custom-dangky .ladi-container #GROUP760 .ladi-group #HEADLINE403 .ladi-headline {
        font-family: "Oswald", sans-serif;
        color: rgb(164, 31, 33);
        font-size: 26px;
        text-align: center;
        line-height: 1.6;
        mix-blend-mode: multiply;
    }
    #VC-custom-dangky .ladi-container #GROUP760 .ladi-group #BUTTON738:hover {
        transform: scale(1.05);
        -webkit-transform: scale(1.05);
    }
    #VC-custom-dangky .ladi-container #GROUP760 .ladi-group #BUTTON738 {
        mix-blend-mode: multiply;
        width: 20%;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgb(164, 31, 33);
        border-color: rgb(255, 235, 0);
        border-width: 2px;
        color: rgb(255, 236, 0);
        font-size: 18px;
        font-weight: 500;
        text-align: center;
        line-height: 1.6;
        transition: all 150ms linear 0s;
    }
    #VC-custom-dangky .ladi-container #GROUP760 .ladi-group #HEADLINE759 {
        width: 50%;
    }
    #VC-custom-dangky .ladi-container #GROUP760 .ladi-group #HEADLINE759 .ladi-headline {
        mix-blend-mode: multiply;
        color: rgb(132, 132, 132);
        font-size: 15px;
        text-align: center;
        line-height: 1.4;
        font-weight: 400;
        padding: 0 10%;
    }
    #VC-custom-dangky .ladi-container #IMAGE401 {
        display: flex;
        justify-content: center;
    }
    #VC-custom-dangky .ladi-container #IMAGE401 .ladi-image {
        width: 650px;
        height: 365px;
        animation-name: fadeInUp;
        -webkit-animation-name: fadeInUp;
        animation-delay: 0s;
        -webkit-animation-delay: 0s;
        animation-duration: 1s;
        -webkit-animation-duration: 1s;
        animation-iteration-count: 1;
        -webkit-animation-iteration-count: 1;
        z-index: 29;
        position: absolute;
    }
    #VC-custom-dangky .ladi-container #IMAGE401 .ladi-image .ladi-image-background {
        position: relative;
        background-image: url(https://w.ladicdn.com/s950x700/5c7362c6c417ab07e5196b05/asset-33x-20200821032937.png);
        background-repeat: no-repeat;
        background-position: left top;
        background-size: contain;
        background-attachment: scroll;
        background-origin: content-box;
        margin: 0 auto;
        width: 100%;
        height: 100%;
        pointer-events: none;
        top: -165px;
        left: 20px;
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
    jQuery( function($){
        $(document).ready(function() {
            $('#recipeCarousel').carousel({
                interval: false
            });

            $('.carousel .carousel-item').each(function(){
                var minPerSlide = 3;
                var next = $(this).next();
                if (!next.length) {
                next = $(this).siblings(':first');
                }
                next.children(':first-child').clone().appendTo($(this));
                
                for (var i=0;i<minPerSlide;i++) {
                    next=next.next();
                    if (!next.length) {
                        next = $(this).siblings(':first');
                    }
                    
                    next.children(':first-child').clone().appendTo($(this));
                }
            });

            $('#recipeCarouselntt').slick({
                slidesToShow: 4,
                slidesToScroll: 1
            });

            $('#Carouselthongtinbaotri').slick({
                slidesToShow: 4,
                slidesToScroll: 1
            });

            $('#Carouselhinhanhduthi').slick({
                speed: 300,
                slidesToShow: 1,
            });

        });
    });
</script>
<?php 