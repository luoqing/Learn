<?php
namespace Stark\Daemon\Queue;

class RedisQueue extends Base {
    protected $_serverConfigs = false;
    protected $_queueKey = false;
    protected $_host = false;
    protected $_port = false;
    private $_redis = null;

    public function init(\Stark\Daemon\Worker $worker) {
        //连接服务器
        $this->_redis = new \Redis();
        $this->_redis->connect($this->_host, $this->_port);
        $this->_redis->rpush($this->_queueKey, "you are a beautiful girl!"); 
    }

    public function pop(\Stark\Daemon\Worker $worker) {

          $data = $this->_redis->lpop($this->_queueKey);
          return $data;
 //       return '{"time":' . microtime(true) . '}';
    }

    public function push(\Stark\Daemon\Worker $worker, $data) {

          echo "push data - {$this->_queueKey} - {$data}\r\n";
          return $this->_redis->rpush($this->_queueKey, $data);
 //       return '{"time":' . microtime(true) . '}';
    }


    public function complete(\Stark\Daemon\Worker $worker) {
        //关闭链接
        $this->_redis->close();
    }


}
