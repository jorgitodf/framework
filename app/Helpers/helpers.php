<?php

function base_url() {

    $base_url = 'http';
    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") $base_url .= "s";
    $base_url .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") $base_url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
    else $base_url .= $_SERVER["SERVER_NAME"];
    $base_url."/";

    return $base_url;
}