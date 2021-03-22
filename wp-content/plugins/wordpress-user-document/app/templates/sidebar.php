
<!-- sidebar -->
<aside class="main-sidebar <?php echo wud_sidebar_class(); ?>" role="complementary">

    <?php if ( is_active_sidebar( 'document-sidebar' ) ) { ?>
        <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'document-sidebar' ) ) ?>
        <?php } ?>

</aside>
<!-- /sidebar -->
<?php


?>


