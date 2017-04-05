<?php
require 'core/autoloader.php';
use socketHttp\socketHttp;

$client = new socketHttp();
echo $client->socketGet('programas');
