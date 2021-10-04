<?php
/**
 * Plugin Name: TNA Password Message
 * Plugin URI: https://github.com/nationalarchives/tna-password-message
 * Description: Custom retrieve password message
 * Version: 1.0
 * Author: Chris Bishop @ TNA
 * Author URI: https://github.com/nationalarchives
 * License: GPL2
 */

add_filter( 'wp_mail_content_type', 'wp_email_content_type_html' );

function wp_email_content_type_html() {

    return 'text/html';
}

add_filter('retrieve_password_message', 'custom_password_reset', 10, 4);

function custom_password_reset( $message, $key, $user_login, $user_data )    {

    $message =  __( '<h1>Password reset</h1>' );
    $message .=  __( '<p>Someone has requested a password reset for the following account:</p>' );
    $message .= '<p>' . sprintf(__('%s'), $user_data->user_email) . '</p>';
    $message .= __( '<p>If this was a mistake, just ignore this email and nothing will happen.</p>' );
    $message .= __( '<p>To reset your password, visit the following address:</p>' );
    $message .= network_site_url('wp-login.php?action=rp&key=' . rawurlencode($key) . '&login=' . rawurlencode($user_login), 'login');

    return $message;
}
