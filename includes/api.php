<?php
/**
 * WP REST API
 * Route is located at wp-json/c-info/data/
 * @package WP_API
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'WP_REST' ) ) :


    /**
     * WP REST Menus class.
     *
     * WP API support for WP API v2.
     *
     * @package WP_API
     * @since 1.2.0
     */
    class WP_REST {


	    /**
	     * Get WP API namespace.
	     *
	     * @since 1.2.0
	     * @return string
	     */
        public static function get_api_namespace() {
            return 'wp/';
        }


	    /**
	     * Get WP API namespace.
	     *
	     * @since 1.2.1
	     * @return string
	     */
	    public static function get_plugin_namespace() {
		    return 'c-info/';
	    }


        /**
         * Register routes for WP API.
         *
         * @since  1.2.0
         */
        public function register_routes() {

            register_rest_route( self::get_plugin_namespace(), '/data', array(
                array(
                    'methods'  => WP_REST_Server::READABLE,
                    'callback' => array( $this, 'get_data' ),
                )
            ) );
            register_rest_route( self::get_plugin_namespace(), '/cdata', array(
                array(
                    'methods'  => WP_REST_Server::READABLE,
                    'callback' => array( $this, 'get_content_data' ),
                )
            ) );
        }


        /**
         * Get data.
         *
         * @since  1.2.0
         * @return array All registered data
         */
        public static function get_data() {

            $rest_url = trailingslashit( get_rest_url() . self::get_plugin_namespace() . '/data/' );

            $options = get_option( 'c_info_generator_settings_fi' );
            $data[ 'fi' ]['header'] = $options['header_fi'];
            $data[ 'fi' ]['intro'] = $options['intro_fi'];
            $data[ 'fi' ]['maker'] = $options['maker_fi'];
            $data[ 'fi' ]['maker_material'] = array_merge([""],explode(",", $options['maker_title_fi']));
            $data[ 'fi' ]['material_choice'] = array_merge([""],explode(",", $options['material_choice_fi']));
            $data[ 'fi' ]['maker_choice'] =  array_merge([""],explode(",", $options['maker_choice_fi']));
            $data[ 'fi' ]['rights'] = $options['rights_fi'];
            $data[ 'fi' ]['right_title'] = $options['right_title_fi'];
            $data[ 'fi' ]['text_title'] = $options['text_title_fi'];
            $data[ 'fi' ]['video_title'] = $options['video_title_fi'];
            $data[ 'fi' ]['sound_title'] = $options['sound_title_fi'];
            $data[ 'fi' ]['text_rights'] =  array_merge([""],explode("\r\n", $options['text_rights_fi']));
            $data[ 'fi' ]['video_rights'] =  array_merge([""],explode("\r\n", $options['video_rights_fi']));
            $data[ 'fi' ]['sound_rights'] =  array_merge([""],explode("\r\n", $options['sound_rights_fi']));
            $data[ 'fi' ]['reporting'] = $options['reporting_fi'];
            $data[ 'fi' ]['description'] = $options['description_fi'];

            $options = get_option( 'c_info_generator_settings_en' );
            $data[ 'en' ]['header'] = $options['header_en'];
            $data[ 'en' ]['intro'] = $options['intro_en'];
            $data[ 'en' ]['maker'] = $options['maker_en'];
            $data[ 'en' ]['maker_material'] = array_merge([""],explode(",", $options['maker_title_en']));
            $data[ 'en' ]['material_choice'] = array_merge([""],explode(",", $options['material_choice_en']));
            $data[ 'en' ]['maker_choice'] = array_merge([""],explode(",", $options['maker_choice_en']));
            $data[ 'en' ]['rights'] = $options['rights_en'];
            $data[ 'en' ]['right_title'] = $options['right_title_en'];
            $data[ 'en' ]['text_title'] = $options['text_title_en'];
            $data[ 'en' ]['video_title'] = $options['video_title_en'];
            $data[ 'en' ]['sound_title'] = $options['sound_title_en'];
            $data[ 'en' ]['text_rights'] = array_merge([""],explode("\r\n", $options['text_rights_en']));
            $data[ 'en' ]['video_rights'] = array_merge([""],explode("\r\n", $options['video_rights_en']));
            $data[ 'en' ]['sound_rights'] = array_merge([""],explode("\r\n", $options['sound_rights_en']));
            $data[ 'en' ]['reporting'] = $options['reporting_en'];
            $data[ 'en' ]['description'] = $options['description_en'];

            $options = get_option( 'c_info_generator_settings_sv' );
            $data[ 'sv' ]['header'] = $options['header_sv'];
            $data[ 'sv' ]['intro'] = $options['intro_sv'];
            $data[ 'sv' ]['maker'] = $options['maker_sv'];
            $data[ 'sv' ]['maker_material'] = array_merge([""],explode(",", $options['maker_title_sv']));
            $data[ 'sv' ]['material_choice'] = array_merge([""],explode(",", $options['material_choice_sv']));
            $data[ 'sv' ]['maker_choice'] = array_merge([""],explode(",", $options['maker_choice_sv']));
            $data[ 'sv' ]['rights'] = $options['rights_sv'];
            $data[ 'sv' ]['right_title'] = $options['right_title_sv'];
            $data[ 'sv' ]['text_title'] = $options['text_title_sv'];
            $data[ 'sv' ]['video_title'] = $options['video_title_sv'];
            $data[ 'sv' ]['sound_title'] = $options['sound_title_sv'];
            $data[ 'sv' ]['text_rights'] = array_merge([""],explode("\r\n", $options['text_rights_sv']));
            $data[ 'sv' ]['video_rights'] = array_merge([""],explode("\r\n", $options['video_rights_sv']));
            $data[ 'sv' ]['sound_rights'] = array_merge([""],explode("\r\n", $options['sound_rights_sv']));
            $data[ 'sv' ]['reporting'] = $options['reporting_sv'];
            $data[ 'sv' ]['description'] = $options['description_sv'];

            return $data;
 
        }

        public static function get_content_data() {

            $rest_url = trailingslashit( get_rest_url() . self::get_plugin_namespace() . '/data/' );

            $options = get_option( 'c_info_generator_content_settings_fi' );
            $data[ 'fi' ]['header'] = $options['content_header_fi'];
            $data[ 'fi' ]['intro'] = $options['content_intro_fi'];
            $data[ 'fi' ]['maker'] = $options['content_maker_fi'];
            $data[ 'fi' ]['maker_material'] = array_merge([""],explode(",", $options['content_maker_title_fi']));
            $data[ 'fi' ]['material_choice'] = array_merge([""],explode(",", $options['content_material_choice_fi']));
            $data[ 'fi' ]['maker_choice'] =  array_merge([""],explode(",", $options['content_maker_choice_fi']));
            $data[ 'fi' ]['rights'] = $options['content_rights_fi'];
            $data[ 'fi' ]['right_title'] = $options['content_right_title_fi'];
            $data[ 'fi' ]['text_title'] = $options['content_text_title_fi'];
            $data[ 'fi' ]['video_title'] = $options['content_video_title_fi'];
            $data[ 'fi' ]['sound_title'] = $options['content_sound_title_fi'];
            $data[ 'fi' ]['text_rights'] =  array_merge([""],explode("\r\n", $options['content_text_rights_fi']));
            $data[ 'fi' ]['video_rights'] =  array_merge([""],explode("\r\n", $options['content_video_rights_fi']));
            $data[ 'fi' ]['sound_rights'] =  array_merge([""],explode("\r\n", $options['content_sound_rights_fi']));
            $data[ 'fi' ]['reporting'] = $options['content_reporting_fi'];
            $data[ 'fi' ]['description'] = $options['content_description_fi'];

            $options = get_option( 'c_info_generator_content_settings_en' );
            $data[ 'en' ]['header'] = $options['content_header_en'];
            $data[ 'en' ]['intro'] = $options['content_intro_en'];
            $data[ 'en' ]['maker'] = $options['content_maker_en'];
            $data[ 'en' ]['maker_material'] = array_merge([""],explode(",", $options['content_maker_title_en']));
            $data[ 'en' ]['material_choice'] = array_merge([""],explode(",", $options['content_material_choice_en']));
            $data[ 'en' ]['maker_choice'] = array_merge([""],explode(",", $options['content_maker_choice_en']));
            $data[ 'en' ]['rights'] = $options['content_rights_en'];
            $data[ 'en' ]['right_title'] = $options['content_right_title_en'];
            $data[ 'en' ]['text_title'] = $options['content_text_title_en'];
            $data[ 'en' ]['video_title'] = $options['content_video_title_en'];
            $data[ 'en' ]['sound_title'] = $options['content_sound_title_en'];
            $data[ 'en' ]['text_rights'] = array_merge([""],explode("\r\n", $options['content_text_rights_en']));
            $data[ 'en' ]['video_rights'] = array_merge([""],explode("\r\n", $options['content_video_rights_en']));
            $data[ 'en' ]['sound_rights'] = array_merge([""],explode("\r\n", $options['content_sound_rights_en']));
            $data[ 'en' ]['reporting'] = $options['content_reporting_en'];
            $data[ 'en' ]['description'] = $options['content_description_en'];

            $options = get_option( 'c_info_generator_content_settings_sv' );
            $data[ 'sv' ]['header'] = $options['content_header_sv'];
            $data[ 'sv' ]['intro'] = $options['content_intro_sv'];
            $data[ 'sv' ]['maker'] = $options['content_maker_sv'];
            $data[ 'sv' ]['maker_material'] = array_merge([""],explode(",", $options['content_maker_title_sv']));
            $data[ 'sv' ]['material_choice'] = array_merge([""],explode(",", $options['content_material_choice_sv']));
            $data[ 'sv' ]['maker_choice'] = array_merge([""],explode(",", $options['content_maker_choice_sv']));
            $data[ 'sv' ]['rights'] = $options['content_rights_sv'];
            $data[ 'sv' ]['right_title'] = $options['content_right_title_sv'];
            $data[ 'sv' ]['text_title'] = $options['content_text_title_sv'];
            $data[ 'sv' ]['video_title'] = $options['content_video_title_sv'];
            $data[ 'sv' ]['sound_title'] = $options['content_sound_title_sv'];
            $data[ 'sv' ]['text_rights'] = array_merge([""],explode("\r\n", $options['content_text_rights_sv']));
            $data[ 'sv' ]['video_rights'] = array_merge([""],explode("\r\n", $options['content_video_rights_sv']));
            $data[ 'sv' ]['sound_rights'] = array_merge([""],explode("\r\n", $options['content_sound_rights_sv']));
            $data[ 'sv' ]['reporting'] = $options['content_reporting_sv'];
            $data[ 'sv' ]['description'] = $options['content_description_sv'];

            return $data;
 
        }

    }

endif;