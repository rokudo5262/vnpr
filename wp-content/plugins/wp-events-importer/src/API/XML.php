<?php

/**
 * WPEventsImporter icalApi Importer Class
 *
 * @package wpeventsimporter
 */

namespace WPEventsImporter\API;

if ( ! class_exists( "SimpleXMLElement" ) || class_exists( "WPEventsImporter\\API\\XML" ) ) return;

use SimpleXMLElement;

class XML
{
	protected $results = [];

	protected $results_count = 0;



	function load_xml( $filename )
	{
		$is_url = false;

		if ( substr_count( $filename, '://' ) ) {
			$is_url = true;
		}

		if ( $is_url ) {
			$remote_file	= wp_remote_get( $filename );
			$response_code	= wp_remote_retrieve_response_code( $remote_file );

			if ( ! in_array( $response_code, array( 200, 201 ) ) ) {
				return false;
			}
		} elseif ( ! file_exists( $filename ) ) {
			return false;
		}

		$sXML = new SimpleXMLElement( $filename, 0, true );

		if ( empty( $sXML ) || ! isset( $sXML->channel ) ) {
			return false;
		}

		$items	= $sXML->channel->item;

		foreach ( $items as $item_key => $item_obj ) {
			$post_data = [
				'id'			=> $item_obj->id->__toString(),
				'title'			=> $item_obj->title->__toString(),
				'description'	=> $item_obj->description->__toString(),
				'content'		=> $item_obj->children( 'content', true )->encoded->__toString(),
				'link'			=> $item_obj->link->__toString(),
				'pubDate'		=> $item_obj->pubDate->__toString(),
				'creator'		=> $item_obj->children( 'dc', true )->creator->__toString(),
				'guid'			=> $item_obj->guid->__toString()
			];

			$categories = [];

			if ( isset( $item_obj->category[ 'nicename' ] ) ) {
				foreach ( $item_obj->category as $category ) {
					$nicename		= $category[ 'nicename' ]->__toString();
					$categories[]	= [
						'name'		=> $category->__toString(),
						'shortname'	=> $nicename
					];
				}
			}

			$item_obj = $item_obj->children( 'wp', true );
			$event_id = $item_obj->post_id->__toString();

			foreach ( $item_obj->postmeta as $meta_obj ) {
				$meta_obj = $meta_obj->children( 'wp', true );

				if ( substr( $meta_obj->meta_key->__toString(), 0, 17 ) === 'wpeventsimporter_' ) {
					if ( $meta_obj->meta_key->__toString() === 'wpeventsimporter_event_id' ) {
						$event_id = $meta_obj->meta_value->__toString();
					}

					continue;
				}

				$meta_data[ $meta_obj->meta_key->__toString() ] = $meta_obj->meta_value->__toString();
			}

			$this->results[] = (object)[
				'id'			=> $event_id ,
				'post'			=> $post_data,
				'meta'			=> $meta_data,
				'categories'	=> $categories,
			];
			$this->results_count++;
		}

		return $this;
	}



	function get_results()
	{
		if ( $this->results_count > 0 ) {
			return $this->results;
		}

		return false;
	}



	function get_count()
	{
		return $this->results_count;
	}
}
