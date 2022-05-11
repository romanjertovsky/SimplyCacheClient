<?php

/** @var string $json */

header('Content-type: application/json');
include 'headers_cors.php';
print $json;
