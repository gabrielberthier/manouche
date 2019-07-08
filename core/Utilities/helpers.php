<?php

define("CONFIG", require './config/config.php');

/**
 * Redirect to a new page.
 *
 * @param  string $path
 */
function redirect($path)
{
    header("Location: /{$path}");
}
/**
 * provides a dump & die helper
 */
if (!function_exists('dd')) {
    function dd()
    {
        $args = func_get_args();
        call_user_func_array('dump', $args);
        die();
    }
}

/**
 * provides a dump helper
 */
if (!function_exists('d')) {
    function d()
    {
        $args = func_get_args();
        call_user_func_array('dump', $args);
    }
}
/**
 * returns the value stored in config file
 *
 * @param string $key
 * @return mixed
 */
function env(string $key){
    return CONFIG[$key];
}

/**
 * returns the value stored in config file
 *
 * @param string $key
 * @return mixed
 */
function configs(string $key){
    return CONFIG[$key];
}
/**
 * provides a hashed string
 *
 * @param string $password
 * @param array $options
 * @return string
 */
function manoucheHash(string $password, array $options = ["cost" => 8]) : string
{
    return password_hash($password, PASSWORD_BCRYPT, $options);
}

/**
 * Checks if passwords match
 *
 * @param string $plainText
 * @param string $hash
 * @return bool
 */
function manoucheCheck(string $plainText, string $hash) : bool
{
    return password_verify($plainText, $hash);
}