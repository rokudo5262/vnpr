<?php
$licenses_options = array();

$licenses_options[''] = esc_attr__( 'No license', 'wud' );

if ( ! empty( $licenses ) ) {

	foreach ( $licenses as $row ) {
		$licenses_options[ $row->ID ] = $row->name;
	}
}

$field_options = array(
	'type'    => 'select',
	'name'    => 'wud_doc_license',
	'value'   => $doc['license'],
	'options' => $licenses_options,
	'label'   => esc_attr__( 'Select license', 'wud' ),
	'class'   => '',
	'desc'    => '',
);
$form->get_field( $field_options );