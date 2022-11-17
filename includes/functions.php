<?php
function load_scripts()
{
    wp_enqueue_script('graph-rank-math', GRM_URL . 'dist/bundle.js', ['jquery', 'wp-element'], wp_rand(), true);
    wp_localize_script('graph-rank-math', 'appLocalizer', [
        'apiUrl' => home_url('/wp-json'),
        'nonce' => wp_create_nonce('wp_rest'),
    ]);
}

function grm_add_dashboard_widgets()
{
    wp_add_dashboard_widget('dashboard_widget', 'Graph Team Rank Math', 'dashboard_widget_function');
}

function dashboard_widget_function($post, $callback_args)
{
    echo '<div class="wrap"><div id="grm-graph-app"></div></div>';
}

function grm_create_db()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'grm_graph_analysis';

    $sql = "CREATE TABLE $table_name (
		`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `page_name` varchar(255) NOT NULL,
        `views` int(11) DEFAULT NULL,
        `period` int(11) DEFAULT NULL,
        PRIMARY KEY (`id`)
	) $charset_collate;
    INSERT INTO $table_name (`page_name`, `views`, `period`)   
    VALUES ('PAGE A', 400, 1), 
	   ('PAGE B', 200, 1), 
		('PAGE C', 600, 1), 
		('PAGE D', 100, 1), 
		('PAGE A', 200, 2), 
		('PAGE B', 700, 2),
		('PAGE C', 100, 2),
		('PAGE D', 500, 2),
		('PAGE A', 800, 3),
		('PAGE B', 100, 3),
		('PAGE C', 300, 3),
		('PAGE D', 200, 3);
    
    ";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

function grm_remove_db() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'grm_graph_analysis';
    $sql = "DROP TABLE IF EXISTS $table_name";
    $wpdb->query($sql);
    delete_option("grm_db_version");
}   