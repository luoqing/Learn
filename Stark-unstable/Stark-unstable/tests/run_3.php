<?php

$g_count = 0;

function init($worker) {

    global $g_count;
    $g_count = rand(0, 100000);
    echo "Worker {$worker->index} will begin from {$g_count}\r\n";

}

function run($worker, $data) {

    global $g_count;

    echo "Worker {$worker->index} current: {$g_count} data: {$data}\r\n";

    usleep(rand(0, 1000) * 1000);
}

// pop data from queue
function pop($worker) {

    global $g_count;
    $g_count++;
    $data = "xiaoqingqing is a beautiful girl";

    return $data;
}


function complete($worker) {

    global $g_count;

    echo "Worker {$worker->index} end at {$g_count}\r\n";

}
