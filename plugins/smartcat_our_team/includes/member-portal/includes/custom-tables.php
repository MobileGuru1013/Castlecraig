<?php

namespace ots_pro\portal;


function create_tables() {

    global $wpdb;

    $q = array(

        "CREATE TABLE {$wpdb->prefix}team_post_likes (
            id            INT         AUTO_INCREMENT,
            post_id       INT         NOT NULL,
            user_id       INT         NOT NULL,
            date_created  TIMESTAMP   DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id)
        )",

        "CREATE TABLE {$wpdb->prefix}team_post_views (
            id            INT         AUTO_INCREMENT,
            post_id       INT         NOT NULL,
            user_id       INT         NOT NULL,
            date_created  TIMESTAMP   DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id)
        )",

        "CREATE TABLE {$wpdb->prefix}team_comments (
            id                INT         AUTO_INCREMENT,
            post_id           INT         NOT NULL,
            author_id         INT         NOT NULL,
            content           LONGTEXT,
            comment_date      TIMESTAMP   DEFAULT CURRENT_TIMESTAMP,
            comment_date_gmt  TIMESTAMP,
            PRIMARY KEY  (id)
        )"

    );

    // Pull in dbDelta
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );


    foreach ( $q as $create ) {
        dbDelta( $create );
    }

}

add_action( 'admin_init', 'ots_pro\portal\create_tables' );