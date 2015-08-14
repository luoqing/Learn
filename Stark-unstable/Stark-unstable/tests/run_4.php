<?php

$g_count = 0;
$g_redis = null;

function init($worker) {

    global $g_count;
    global $g_redis;
    $g_count = rand(0, 100000);

    $g_redis = new Redis();   
    $g_redis->connect('127.0.0.1');
    $queue_key = 'test:redis';

    $data = "u r so beautiful";
    $g_redis->rpush($queue_key,$data);

    echo "Worker {$worker->index} will begin from {$g_count}\r\n";

}

function run($worker, $data) {

    global $g_count;

    echo "Worker {$worker->index} current: {$g_count} data: {$data}\r\n";

    usleep(rand(0, 1000) * 1000);
}

// pop data from queue
function pop($worker) {

    global $g_count, $g_redis;
    $g_count++;

    $queue_key = 'test:redis';
    $data = $g_redis->lpop($queue_key);
    return $data;
}


function complete($worker) {

    global $g_count, $g_redis;

    $g_redis->close();
    echo "Worker {$worker->index} end at {$g_count}\r\n";

}
