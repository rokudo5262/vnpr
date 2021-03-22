<div class="nx-analytics-menu">
    <form action="<?php echo admin_url( 'admin.php?page=nx-analytics' ); ?>" method="GET" class="nx-analytics-form" id="nx-analytics-form">
        <?php wp_nonce_field( '_nx_analytics_nonce' ); ?>
        <div class="nx-analytics-form-field nx_notificationx">
            <label for="nx_notificationx"><?php _e( 'Select Notification', 'notificationx-pro' ); ?></label>
            <select id="nx_notificationx" multiple="multiple" name="notificationx[]">
                <?php 
                    $selected_notificationx = [ 'all' ];
                    $selected = $all_separate_selected = '';
                    $selected_all = false;
                    if( isset( $_GET['notificationx'] ) && ! empty( $_GET['notificationx'] ) ) {
                        $selected_notificationx = explode(',', $_GET['notificationx']);
                    }
                    if( in_array( 'all', $selected_notificationx ) ) {
                        $selected = 'selected="true"';
                        $selected_all = true;
                    }
                    if( in_array( 'all_separate', $selected_notificationx ) ) {
                        $all_separate_selected = 'selected="true"';
                        $all_separate_selected_all = true;
                    }
                ?>
                <option <?php echo $selected; ?> value="all"><?php _e('All Combined', 'notificationx-pro'); ?></option>
                <option <?php echo $all_separate_selected; ?> value="all_separate"><?php _e('All Separated', 'notificationx-pro'); ?></option>
                <?php 
                    if( ! empty( self::$notificationx ) ) {
                        $selected = '';
                        foreach( self::$notificationx as $notificationx ) {
                            if( in_array( $notificationx->ID, $selected_notificationx ) ) {
                                $selected = 'selected="true"';
                                if( $selected_all ) {
                                    $selected = '';
                                }
                            }
                            echo '<option '. $selected .' value="'. $notificationx->ID .'">'. $notificationx->post_title .'</option>';
                            $selected = '';
                        }
                    }
                ?>
            </select>
        </div>

        <div class="nx-analytics-form-field">
            <label for="nx_start_date"><?php _e( 'Start Date', 'notificationx-pro' ); ?></label>
            <input id="nx_start_date" placeholder="<?php _e( 'Start Date', 'notificationx-pro' ); ?>" type="text" name="start_date">
        </div>
        <div class="nx-analytics-form-field">
            <label for="nx_end_date"><?php _e( 'End Date', 'notificationx-pro' ); ?></label>
            <input id="nx_end_date" placeholder="<?php _e( 'End Date', 'notificationx-pro' ); ?>" type="text" name="end_date">
        </div>
        <div class="nx-analytics-form-field nx_comparison_factor">
            <label for="nx_comparison_factor"><?php _e( 'Comparison Factor', 'notificationx-pro' ); ?></label>
            <select id="nx_comparison_factor"  multiple="multiple" name="comparison_factor[]">
                <?php 
                    $comparison_factors = [ 'views' ];
                    $selected = '';
                    if( isset( $_GET['comparison_factor'] ) && ! empty( $_GET['comparison_factor'] ) ) {
                        $comparison_factors = explode(',', $_GET['comparison_factor']);
                    }
                    foreach( $comparison_factor_list as $factor_key => $factor ) {
                        if( in_array( trim( $factor_key ), $comparison_factors ) ) {
                            $selected = 'selected="true"';
                        }
                        echo '<option '. $selected .' value="'. $factor_key .'">'. __( $factor , 'notificationx-pro' ) .'</option>';
                        $selected = '';
                    }
                ?>
            </select>
        </div>
        <input id="nx_analytics_submit" class="btn-settings nx-settings-button" type="submit" value="<?php _e('Submit', 'notificationx-pro'); ?>">
    </form>
</div>
<div class="nx-canvas-area">
    <canvas id="nx_canvas"></canvas>
</div>