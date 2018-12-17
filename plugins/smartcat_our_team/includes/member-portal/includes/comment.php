<?php

namespace ots_pro\portal;


function insert_comment( $comment ) {

    global $wpdb;

    $data = array(
        'id'               => isset( $comment['id'] )        ? absint( $comment['id'] )      : '',
        'post_id'          => isset( $comment['post_id'] )   ? absint( $comment['post_id'] ) : '',
        'author_id'        => isset( $comment['author_id'] ) ? absint( $comment['author_id'] ) : '',
        'content'          => isset( $comment['content'] )   ? stripslashes_deep( sanitize_text_field( $comment['content'] ) ) : '',

        'comment_date'     => isset( $comment['comment_date'] )     ? sanitize_text_field( $comment['comment_date'] )     : current_time( 'mysql' ),
        'comment_date_gmt' => isset( $comment['comment_date_gmt'] ) ? sanitize_text_field( $comment['comment_date_gmt'] ) : current_time( 'mysql', 1 ),
    );

    if ( $wpdb->insert( "{$wpdb->prefix}team_comments", $data ) ) {
        return $wpdb->insert_id;
    }

    return false;

}


function get_comment( $comment_id ) {

    global $wpdb;

    $sql = "SELECT * 
            FROM {$wpdb->prefix}team_comments
            WHERE id = %d";

    $comment = $wpdb->get_row( $wpdb->prepare( $sql, $comment_id ) );

    if ( $comment ) {
        return new Comment( $comment );
    }

    return false;

}


function get_post_comments( $args = array() ) {

    global $wpdb;

    $post = get_post( $args['post_id'] );

    if ( $post ) {

        $defaults = array(
            'post_id' => $post->ID,
            'orderby' => 'comment_date',
            'order'   => 'desc',
            'limit'   => 10,
            'page'    => 1,
            'offset'  => 0
        );

        $args = wp_parse_args( $args, $defaults );

        $sql = "SELECT * 
                FROM {$wpdb->prefix}team_comments
                WHERE post_id = %d 
                ORDER BY " . esc_sql( $args['orderby'] ) . " " . esc_sql( $args['order'] );

        if ( $args['limit'] > 0 ) {
            $sql .= " LIMIT " . esc_sql( $args['limit'] );
        }

        if ( $args['offset'] > 0 ) {
            $sql .= " OFFSET " . esc_sql( ( $args['limit'] * ( $args['page'] - 1 ) + $args['offset'] ) );
        }


        unset( $args['limit'] );
        unset( $args['offset'] );
        unset( $args['page'] );
        unset( $args['order'] );
        unset( $args['orderby'] );


        $comments = $wpdb->get_results( $wpdb->prepare( $sql, array_values( $args ) ) );

        if ( !empty( $comments ) ) {

            $objects = array();

            foreach ( $comments as $comment ) {
                $objects[] = new Comment( $comment );
            }

            return $objects;

        }

    }

    return array();

}


function count_post_comments( $post ) {

    global $wpdb;

    $post = get_post( $post );

    if ( $post ) {

        $sql = "SELECT COUNT( * )
                FROM {$wpdb->prefix}team_comments
                WHERE post_id = %d ";

        return $wpdb->get_var( $wpdb->prepare( $sql, $post->ID ) );

    }

    return 0;

}
