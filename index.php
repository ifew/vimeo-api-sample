<?php
$config = require('init.php');
$lib = new \Vimeo\Vimeo($config['client_id'], $config['client_secret']);

if (!empty($config['access_token'])) {
    $lib->setToken($config['access_token']);
    $user = $lib->request('/me');
} else {
    $user = $lib->request('/users/ifew');
}

echo "<h1>Get Profiles</h1>";
print_r($user);

$listvdo = $lib->request('/me/videos');
echo "<h1>List VDO</h1>";
print_r($listvdo);

$vdo = $lib->request('/videos/379951962');
echo "<h1>Get VDO</h1>";
print_r($vdo);
