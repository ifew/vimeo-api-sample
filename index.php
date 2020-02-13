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

$vdo = $lib->request('/videos/385198817');
echo "<h1>Get VDO</h1>";
print_r($vdo);


foreach($listvdo["body"]["data"] as $live) {
    if($live["type"] == "live") {
        echo "<h1>Lastest Online - ".$live["name"]."</h1>";
        print_r($live);
    }
}

echo "<h1>Embed Event recurring 20653</h1>";
echo '<iframe src="https://vimeo.com/event/20653/embed" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
echo '<iframe src="https://player.vimeo.com/video/385234735" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
    <p><a href="https://vimeo.com/385234735">Test Live Recurring (Not set date)</a> from <a href="https://vimeo.com/unet">Unilever</a> on <a href="https://vimeo.com">Vimeo</a>.</p>';