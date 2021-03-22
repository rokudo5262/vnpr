<?php

?>

<div class="wud-postbox wud-settings-roles">
    <h2><?php echo esc_html( $tab_name ); ?></h2>
    <div class="postbox-wrapper">
        <div class="nav nav-tabs" id="roles-tab" role="tablist">

			<?php
			$tab_count = 0;
			foreach ( $roles as $key => $role ) {
				$a_class = '';
				if ( $tab_count == 0 ) {
					$a_class = 'active';
				}
				echo '<a class="nav-item nav-link ' . $a_class . '" id="nav-' . $key . '-tab" href="#role-' . $key . '" data-toggle="tab"> ' . $role['name'] . ' </a> ';
				$tab_count ++;
			}
			?>

        </div>
        <div class="tab-content" id="roles-tabcontent">

			<?php
			$role_count = 0;


			foreach ( $roles as $key => $role ) {
				?>
                <div class="tab-pane fade <?php echo ( $role_count == 0 ) ? 'show active' : ''; ?>"
                     id="role-<?php echo esc_attr( $key ); ?>">
					<?php


					$caps = wud_get_caps();

					$selected = array();
					foreach ( $caps as $key2 => $cap ) {
						if ( isset( $role['capabilities'][ $key2 ] ) ) {
							$selected[] = $key2;
						}
					}

					$options = array(
						'type'        => 'checkbox',
						'name'        => $model->get_input_name( 'roles' ) . '[' . $key . '][]',
						'value'       => $selected,
						'options'     => $caps,
						'label_class' => 'control-label',
						'class'       => 'form-control',
						'wrapper'     => 'no',
						'desc'        => '',
					);

					$form->get_field( $options );

					$role_count ++;
					?>
                </div>
			<?php } ?>

        </div>
    </div>
</div>