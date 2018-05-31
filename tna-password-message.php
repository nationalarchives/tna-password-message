<?php
/**
 * Plugin Name: TNA Password Message
 * Plugin URI: https://github.com/nationalarchives/tna-password-message
 * Description: Custom retrieve password message
 * Version: 0.1
 * Author: Chris Bishop @ TNA
 * Author URI: https://github.com/nationalarchives
 * License: GPL2
 */

add_filter('retrieve_password_message', 'custom_password_reset', 10, 4);

function custom_password_reset( $message, $key, $user_login, $user_data )    {

    $message =  __( 'Someone has requested a password reset for the following account:' ) . "\r\n\r\n";
    $message .= sprintf(__('%s'), $user_data->user_email) . "\r\n\r\n";
    $message .= __( 'If this was a mistake, just ignore this email and nothing will happen.' )  . "\r\n\r\n";
    $message .= __( 'To reset your password, visit the following address:' )  . "\r\n\r\n";
    $message .= network_site_url('wp-login.php?action=rp&key=$key&login=' . rawurlencode($user_login), 'login');

    return $message;
}