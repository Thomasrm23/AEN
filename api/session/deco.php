<?php
session_start();
$_SESSION= array();
session_destroy();
http_response_code(200);
die();