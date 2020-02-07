<?php
defined('BASEPATH') OR exit('No direct script access allowed');

(new Symfony\Component\Dotenv\Dotenv())->load(__DIR__.'/../../.env');

$config['host'] = '127.0.0.1';
$config['password'] = $_ENV['REDIS_PASSWORD'];
$config['port'] = 6379;
$config['timeout'] = 0;
