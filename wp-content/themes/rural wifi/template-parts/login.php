<?php
/**
 * Template Name: Login
 * Created by PhpStorm.
 * User: VIcky
 * Date: 9/30/2016
 * Time: 2:01 AM
 */

if($_POST) {

    global $wpdb;

    //We shall SQL escape all inputs
    $username = $wpdb->escape($_REQUEST['username']);
    $password = $wpdb->escape($_REQUEST['password']);
    $remember = $wpdb->escape($_REQUEST['rememberme']);

    if($remember) $remember = "true";
    else $remember = "false";

    $login_data = array();
    $login_data['user_login'] = $username;
    $login_data['user_password'] = $password;
    $login_data['remember'] = $remember;

    $user_verify = wp_signon( $login_data, false );

    if ( is_wp_error($user_verify) )
    {
        header("Location: " . home_url() . "/login/error/");
        // Note, I have created a page called "Error" that is a child of the login page to handle errors. This can be anything, but it seemed a good way to me to handle errors.
    } else {
        echo "<script type='text/javascript'>window.location='". home_url() ."'</script>";
        exit();
    }

} else {

    // No login details entered - you should probably add some more user feedback here, but this does the bare minimum

    echo "<p>Invalid login details</p>";

}
?>