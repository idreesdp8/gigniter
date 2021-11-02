<?php

defined('BASEPATH') or exit('No direct script access allowed');
//server.php
// require dirname(__DIR__) . '/vendor/autoload.php';

include 'vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use MyApp\Chat;


    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new Chat()
            )
        ),
        8080
    );

    $server->run();

    echo json_encode($server);

?>