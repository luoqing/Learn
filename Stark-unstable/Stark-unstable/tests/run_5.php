<?php

$g_count = 0;



function run($worker, $data) {
    global $g_count;
    $g_count++;
    
    $queueKey="test:redis";
    $worker->queue->push($worker, $data);
    echo "Worker {$worker->index} current: {$g_count} data:{$data}\r\n";
    usleep(rand(0, 1000) * 1000);
}

