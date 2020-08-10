<?php
$config = require('init.php');
$lib = new \Vimeo\Vimeo($config['client_id'], $config['client_secret']);

if (!empty($config['access_token'])) {
    $lib->setToken($config['access_token']);
    $user = $lib->request('/me');
} else {
    $user = $lib->request('/users/ifew');
}

if(isset($_GET['upload'])&& ($_GET['upload'] == 'yes')) {
    // echo "<h1>Upload Video</h1>";
    $response = $lib->upload('sample_vdo/file_example_MP4_1920_18MG.mp4', [
        'name' => 'Test Upload VDO via API',
        'description' => 'Using PHP from Vimeo API Official',
        'privacy' => [
            'view' => 'disable'
        ]
    ]);
    //reference https://developer.vimeo.com/api/reference/videos#upload_video
    // echo "<h1>Respond Uploaded Video</h1>";
    // print_r($response);

    $response_explode = explode("/", $response);
    $id = $response_explode[2];

    echo $id;
}

if(isset($_GET['status'])&& ($_GET['status'] == 'yes')) {
    // echo "<h1>Upload Video</h1>";
    $response = $lib->request("/videos/{$_POST['vdo_id']}");
    //reference https://developer.vimeo.com/api/reference/videos#upload_video
    // echo "<h1>Respond Uploaded Video</h1>";
    //print_r($response);
    $response_explode = $response;
    $status = $response_explode['body']['upload']['status'];

    echo $status;
}

if(isset($_GET['download'])&& ($_GET['download'] == 'yes')) {
    // echo "<h1>Upload Video</h1>";
    $response = $lib->request("/videos/{$_POST['vdo_id']}");
    //reference https://developer.vimeo.com/api/reference/videos#upload_video
    // echo "<h1>Respond Uploaded Video</h1>";
    // print_r($response);

    $response_explode = $response;
    $file = "<a href=\"".$response_explode['body']['download'][1]['link']."\">1920x1080p</a><br/>";
    $file .= "<a href=\"".$response_explode['body']['download'][2]['link']."\">426x240p</a><br/>";
    $file .= "<a href=\"".$response_explode['body']['download'][3]['link']."\">1280x720p</a><br/>";

    echo $file;
}