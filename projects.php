<?php

# Turn off all error reporting
// error_reporting(1);

# curl https://php.loadfunc.com/load_func.php --output load_func.php
# php projects.php
include 'load_func.php';

function handleError($errno, $errstr, $errfile, $errline)
{
    def_json('',
            [
            'error'=> $errno,
            'errstr'=> $errstr,
//             'errfile'=> $errfile,
//             'errline'=> $errline
            ],
        function ($json) {
            // show header with json data
            echo $json;
        }
    );
}
set_error_handler("handleError");

header('Content-Type: application/json');

# Webs service with JSON
try {

    # Load functions from remote/local
    load_func(['https://php.letjson.com/let_json.php', 'https://php.defjson.com/def_json.php'], function ($func_url_array) {

            // encode data to json
            def_json('', $func_url_array, function ($json) {

                // show header with json data
                echo $json;
            });
    });

} catch (ErrorException $e) {

    def_json('', ['error'=> $e->getMessage()], function ($json) {
        // show header with json data
        echo $json;
    });
}
# Set HTTP response status code to: 500 - Internal Server Error
//http_response_code(500);

?>

