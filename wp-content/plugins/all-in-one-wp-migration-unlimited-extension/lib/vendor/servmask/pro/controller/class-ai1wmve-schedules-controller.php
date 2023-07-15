<?php
/**
 * Copyright (C) 2014-2023 ServMask Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * ███████╗███████╗██████╗ ██╗   ██╗███╗   ███╗ █████╗ ███████╗██╗  ██╗
 * ██╔════╝██╔════╝██╔══██╗██║   ██║████╗ ████║██╔══██╗██╔════╝██║ ██╔╝
 * ███████╗█████╗  ██████╔╝██║   ██║██╔████╔██║███████║███████╗█████╔╝
 * ╚════██║██╔══╝  ██╔══██╗╚██╗ ██╔╝██║╚██╔╝██║██╔══██║╚════██║██╔═██╗
 * ███████║███████╗██║  ██║ ╚████╔╝ ██║ ╚═╝ ██║██║  ██║███████║██║  ██╗
 * ╚══════╝╚══════╝╚═╝  ╚═╝  ╚═══╝  ╚═╝     ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Kangaroos cannot jump here' );
}

if ( ! class_exists( 'Ai1wmve_Schedules_Controller' ) ) {

	class Ai1wmve_Schedules_Controller {


		public static function index() {
			$action   = isset( $_GET['action'] ) ? $_GET['action'] : null;
			$event_id = isset( $_GET['event_id'] ) ? $_GET['event_id'] : null;

			switch ( $action ) {
				case 'edit-event':
				case 'create-event':
					$events = new Ai1wmve_Schedule_Events();
					$event  = $events->find_or_new( $event_id );

					global $wpdb;

					if ( empty( $wpdb->use_mysqli ) ) {
						$mysql = new Ai1wm_Database_Mysql( $wpdb );
					} else {
						$mysql = new Ai1wm_Database_Mysqli( $wpdb );
					}

					// Include table prefixes
					if ( ai1wm_table_prefix() ) {
						$mysql->add_table_prefix_filter( ai1wm_table_prefix() );

						// Include table prefixes (Webba Booking)
						foreach ( array( 'wbk_services', 'wbk_days_on_off', 'wbk_locked_time_slots', 'wbk_appointments', 'wbk_cancelled_appointments', 'wbk_email_templates', 'wbk_service_categories', 'wbk_gg_calendars', 'wbk_coupons' ) as $table_name ) {
							$mysql->add_table_prefix_filter( $table_name );
						}
					}

					Ai1wm_Template::render(
						'schedules/create-edit',
						array(
							'event'  => $event,
							'tables' => $mysql->get_tables(),
						),
						AI1WMVE_TEMPLATES_PATH
					);
					break;

				default:
					$events = new Ai1wmve_Schedule_Events();
					Ai1wm_Template::render(
						'schedules/index',
						array( 'events' => $events->all() ),
						AI1WMVE_TEMPLATES_PATH
					);
			}
		}

		public static function delete() {
			ai1wm_setup_environment();

			// Set params
			if ( empty( $params ) ) {
				$params = stripslashes_deep( $_POST );
			}

			// Set secret key
			$secret_key = null;
			if ( isset( $params['secret_key'] ) ) {
				$secret_key = trim( $params['secret_key'] );
			}

			// Check for event_id
			if ( ! isset( $params['event_id'] ) ) {
				ai1wm_json_response( array( 'errors' => __( 'Unable to find event', AI1WM_PLUGIN_NAME ) ) );
				exit;
			}

			try {
				// Ensure that unauthorized people cannot access delete action
				ai1wm_verify_secret_key( $secret_key );
			} catch ( Ai1wm_Not_Valid_Secret_Key_Exception $e ) {
				exit;
			}

			try {
				$events = new Ai1wmve_Schedule_Events();
				$events->delete( $params['event_id'] );
			} catch ( Ai1wmve_Schedules_Exception $e ) {
				ai1wm_json_response( array( 'errors' => array( $e->getMessage() ) ) );
				exit;
			}

			ai1wm_json_response( array( 'errors' => array() ) );
			exit;
		}


		public static function event_log() {
			ai1wm_setup_environment();

			// Set params
			if ( empty( $params ) ) {
				$params = stripslashes_deep( $_POST );
			}

			// Set secret key
			$secret_key = null;
			if ( isset( $params['secret_key'] ) ) {
				$secret_key = trim( $params['secret_key'] );
			}

			// Check for event_id
			if ( ! isset( $params['event_id'] ) ) {
				ai1wm_json_response( array( 'errors' => __( 'Unable to find event', AI1WM_PLUGIN_NAME ) ) );
				exit;
			}

			try {
				// Ensure that unauthorized people cannot access delete action
				ai1wm_verify_secret_key( $secret_key );
			} catch ( Ai1wm_Not_Valid_Secret_Key_Exception $e ) {
				exit;
			}

			try {
				$events = new Ai1wmve_Schedule_Events();
				$event  = $events->find( $params['event_id'] );
				ai1wm_json_response( $event->logs() );
				exit;
			} catch ( Ai1wmve_Schedules_Exception $e ) {
				ai1wm_json_response( array( 'errors' => array( $e->getMessage() ) ) );
				exit;
			}

			ai1wm_json_response( array( 'errors' => array() ) );
			exit;
		}

		public static function save( $params = array() ) {
			ai1wm_setup_environment();
			// Set params
			if ( empty( $params ) ) {
				$params = stripslashes_deep( $_POST );
			}

			$params['repeating']   = ! isset( $params['do-not-repeat'] );
			$params['incremental'] = isset( $params['incremental'] );

			$events = new Ai1wmve_Schedule_Events();
			$events->save( $params );

			// Set message
			Ai1wm_Message::flash( 'schedules', __( 'Your changes have been saved.', AI1WM_PLUGIN_NAME ) );

			static::redirect_to_index();
		}

		public static function redirect_to_index() {
			// Redirect to schedules list page
			wp_redirect( network_admin_url( 'admin.php?page=ai1wmve_schedules' ) );
			exit;
		}

		public static function buttons() {
			$buttons = array();
			foreach ( apply_filters( 'ai1wm_export_buttons', array() ) as $button ) {
				$button = str_replace( ' target="_blank"', '', $button );
				$button = str_replace( '<a', '<option', $button );
				$button = str_replace( '</a', '</option', $button );
				$button = str_replace( 'href=', 'data-link=', $button );
				$button = str_replace( 'id="ai1wm-export-', 'value="', $button );

				$buttons[] = $button;
			}

			return $buttons;
		}

		public static function manual_run() {
			ai1wm_setup_environment();

			// Set params
			if ( empty( $params ) ) {
				$params = stripslashes_deep( $_POST );
			}

			// Set secret key
			$secret_key = null;
			if ( isset( $params['secret_key'] ) ) {
				$secret_key = trim( $params['secret_key'] );
			}

			// Check for event_id
			if ( ! isset( $params['event_id'] ) ) {
				ai1wm_json_response( array( 'errors' => __( 'Unable to find event', AI1WM_PLUGIN_NAME ) ) );
				exit;
			}

			try {
				// Ensure that unauthorized people cannot access delete action
				ai1wm_verify_secret_key( $secret_key );
			} catch ( Ai1wm_Not_Valid_Secret_Key_Exception $e ) {
				exit;
			}

			try {
				$events = new Ai1wmve_Schedule_Events();
				$event  = $events->find( $params['event_id'] );
				$event->schedule_now();
			} catch ( Ai1wmve_Schedules_Exception $e ) {
				ai1wm_json_response( array( 'errors' => array( $e->getMessage() ) ) );
				exit;
			}

			ai1wm_json_response( array( 'errors' => array() ) );
			exit;
		}

		public static function run( $event_id ) {
			$events = new Ai1wmve_Schedule_Events();
			if ( $event = $events->find( $event_id ) ) {
				return $event->run();
			}

			return file_put_contents( AI1WM_STORAGE_PATH . DIRECTORY_SEPARATOR . 'cron.log', 'Event not found ' . $event_id . PHP_EOL, FILE_APPEND );
		}

		public static function log_success( $params ) {
			if ( isset( $params['event_id'] ) ) {
				$event_id = $params['event_id'];
				$events   = new Ai1wmve_Schedule_Events();
				if ( $event = $events->find( $event_id ) ) {
					$event->mark_success( $params );
				}
			}
		}

		public static function log_failed( $params ) {
			if ( isset( $params['event_id'] ) ) {
				$event_id = $params['event_id'];
				$events   = new Ai1wmve_Schedule_Events();
				if ( $event = $events->find( $event_id ) ) {
					$message = isset( $params['error_message'] ) ? $params['error_message'] : __( 'Unknown cron error', AI1WM_PLUGIN_NAME );
					$event->mark_failed( $message );
				}
			}
		}
	}
}
