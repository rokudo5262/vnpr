<div class="wud-statistics">
    <ul>
        <li class="statistics-item">
            <span class="stat-title"><?php esc_html_e( 'Views', 'wud' ); ?></span>
            <span class="stat-numbers"><?php echo wud_format_count( $statistics['views'] ); ?></span>
        </li>
        <li class="statistics-item">
            <span class="stat-title"><?php esc_html_e( 'Likes', 'wud' ); ?></span>
            <span class="stat-numbers"><?php echo wud_format_count( $statistics['likes'] ); ?></span>
        </li>
        <li class="statistics-item">
            <span class="stat-title"><?php esc_html_e( 'Documents', 'wud' ); ?></span>
            <span class="stat-numbers"><?php echo wud_format_count( $statistics['total'] ); ?></span>
        </li>
    </ul>
</div>