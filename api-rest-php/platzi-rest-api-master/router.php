<?php

$matches = [];

if (preg_match('/\/([^\/]+)\/([^\/]+)/', $_SERVER["REQUEST_URI"], $matches)) {
    $_GET['resource_user'] = $matches[1];
    $_GET['resource_id'] = $matches[2];

    error_log( print_r($matches, 1) );
    require 'controller/ControllerUsers.php';
} elseif ( preg_match('/\/([^\/]+)\/?/', $_SERVER["REQUEST_URI"], $matches) ) {
    $_GET['resource_user'] = $matches[1];
    error_log( print_r($matches, 1) );

    require 'controller/ControllerUsers.php';
} else {

    error_log('No matches');
    http_response_code( 404 );
}