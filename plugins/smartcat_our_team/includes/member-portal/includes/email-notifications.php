<?php

namespace ots_pro\portal;


function send_welcome_email( $member, array $replace ) {

    $recipient = $member->email;
    $subject   = __( 'Welcome', 'ots-pro' );
    $content   = trim( get_option( Options::WELCOME_EMAIL ) );

    return send_mail( $recipient, $subject, $content, $replace );

}


function send_password_reset_email( $member, array $replace ) {

    $recipient = $member->email;
    $subject   = __( 'Your password has been reset', 'ots-pro' );
    $content   = trim( get_option( Options::PASSWORD_RESET_EMAIL ) );

    return send_mail( $recipient, $subject, $content, $replace );

}


function send_mail( $recipient, $subject, $content, array $replace, array $args = array() ) {

    if ( is_email( $recipient ) ) {

        $from_name  = trim( get_option( Options::OUTGOING_EMAIL_NAME ) );
        $from_email = trim( get_option( Options::OUTGOING_EMAIL_ADDRESS ) );

        $defaults = array(
            'headers' => array(
                'Content-Type: text/html; charset=UTF-8',
                "From: $from_name <$from_email>"
            )
        );

        $args = wp_parse_args( $args, $defaults );

        foreach ( $replace as $key => $value ) {
            $content = str_replace( "[$key]", $value, $content );
        }

        return wp_mail( $recipient, $subject, $content, $args['headers'] );

    }

    return false;

}