<?php
namespace Stark\Core;

class Options {
    public function __construct($options = array()) {
        echo date('r') . " | Options.php | Options::construct | get options - " . json_encode($options) . PHP_EOL;
        $this->setOptions($options);
    }

    protected function setOptions($options) {
        var_dump($options);

        if (is_array($options) == false && empty($options)) {
            return;
        }
        
        foreach ($options as $key => $value) {
            $methodName = '_set' . ucfirst($key) . 'Options';
            if (method_exists($this, $methodName)) {
                 echo date('r') . " | " . "Options.php | setOptions  | set key type otions - {$key} - {$methodName} - " . json_encode(array($value)) . PHP_EOL;
                if (call_user_func_array(array($this, $methodName), array($value)) == false) {
                    throw new \Stark\Daemon\Exception\Options("Set option failed, option:{$key}");
                } else {
                    continue;
                }
            }

               
            $property = "_{$key}";
            if (isset($this->$property) == false) throw new \Stark\Daemon\Exception\Options("Set option failed, option:{$key}");
            $this->$property = $value; //TODO:value type
            echo date('r') . " | " . "Options.php | setOptions | set property - {$property} - {$value}" . PHP_EOL;
        }

        return true;
    }
}
