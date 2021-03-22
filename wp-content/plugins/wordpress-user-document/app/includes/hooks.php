<?php
/**
 * @version    $Id$
 * @package    WordPress User Document
 * @author     ZuFusion
 * @copyright  Copyright (C) 2020 ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Container hook.
 *
 * @see wud_output_container_start()
 * @see wud_output_container_end()
 */
add_action( 'wud_before_container', 'wud_output_container_start' );
add_action( 'wud_after_container', 'wud_output_container_end' );

/**
 * Main content hook.
 *
 * @see wud_output_before_main_content()
 * @see wud_output_after_main_content()
 */
add_action( 'wud_before_main_content', 'wud_output_before_main_content' );
add_action( 'wud_after_main_content', 'wud_output_after_main_content' );

/**
 * Main content header hook
 */
add_action( 'wud_archive_main_header', 'wud_output_main_content_header' );

/**
 * Output pagination
 *
 * @see wud_output_no_documents_found()
 */

add_action( 'wud_after_document_loop', 'wud_output_pagination' );

/**
 * No documents found hook.
 *
 * @see wud_output_no_documents_found()
 */

add_action( 'wud_no_documents_found', 'wud_documents_toolbar' );
add_action( 'wud_no_documents_found', 'wud_output_no_documents_found' );
add_action( 'wud_doc_shortcode_author_loop_no_results', 'wud_documents_toolbar' );
add_action( 'wud_doc_shortcode_author_loop_no_results', 'wud_output_no_documents_found' );
add_action( 'wud_doc_shortcode_documents_loop_no_results', 'wud_documents_toolbar' );
add_action( 'wud_doc_shortcode_documents_loop_no_results', 'wud_output_no_documents_found' );


/**
 * Sidebar left hook.
 *
 * @see wud_output_siderbar_right()
 */

add_action( 'wud_sidebar_left', 'wud_output_siderbar_left' );

/**
 * Sidebar right hook.
 *
 * @see wud_output_siderbar_right()
 */

add_action( 'wud_sidebar_right', 'wud_output_siderbar_right' );

/**
 * Pagination for shortcode.
 *
 * @see wud_output_siderbar()
 */

add_action( 'wud_doc_after_loop', 'wud_output_pagination' );


/**
 * My Account.
 */

add_action( 'wud_account_navigation', 'wud_nav_account_content' );
add_action( 'wud_account_content', 'wud_account_content' );
add_action( 'wud_account_create-document_endpoint', 'wud_account_create_document' );
add_action( 'wud_account_edit-document_endpoint', 'wud_account_edit_document' );

/**
 * Toolbar of my document hook
 *
 * @see wud_my_documents_toolbar()
 */
add_action( 'wud_doc_shortcode_before_documents_loop', 'wud_documents_toolbar', 10 );
add_action( 'wud_doc_shortcode_before_author_loop', 'wud_documents_toolbar', 10 );
add_action( 'wud_before_document_loop', 'wud_documents_toolbar', 10 );


