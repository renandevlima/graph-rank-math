<?php
/**
 * This file will create Custom Rest API End Points.
 */
class WP_React_Settings_Rest_Route
{

    public function __construct()
    {
        add_action('rest_api_init', [$this, 'create_rest_routes']);
    }

    public function create_rest_routes()
    {
        register_rest_route('grm/v1', '/views-per-page', [
            'methods' => 'GET',
            'callback' => [$this, 'get_views'],
            'permission_callback' => [$this, 'get_views_permission']
        ]);
    }

    public function get_views($req)
    {
        if (!isset($req["period"]) || $req["period"] > 3) {
            return rest_ensure_response([
                "status" => 0,
                "message" => "Period is not setted up."
            ]);
        }

        global $wpdb;
        $table_name = $wpdb->prefix . 'grm_graph_analysis';
        $period = $req["period"];
        $sql = "SELECT * FROM $table_name WHERE `period` = $period";

        return rest_ensure_response([
            "status" => 1,
            "message" => "Success",
            "data" => $wpdb->get_results($sql)
        ]);

    }

    public function get_views_permission()
    {
        return true;
    }
}
new WP_React_Settings_Rest_Route();