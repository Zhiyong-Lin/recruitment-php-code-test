<?php

namespace App\Service;

use think\facade\Log;

class AppLogger
{
    const TYPE_LOG4PHP = 'log4php';
    const TYPE_THINK_LOG = 'think-log';

    private $logger;
    private $_type = self::TYPE_LOG4PHP;

    public function __construct($type = self::TYPE_LOG4PHP) {
        $this->_type = $type;
        if ($type == self::TYPE_LOG4PHP) {
            $this->logger = \Logger::getLogger("Log");
        }else if($type == self::TYPE_THINK_LOG){
            Log::init([
                'default'	=>	'file',
                'channels'	=>	[
                    'file'	=>	[
                        'type'	=>	'file',
                        'realtime_write'    =>    true,
                        'path'	=>	'./logs/',
                    ],
                ],
            ]);
            $this->logger = '\think\facade\Log';
        }
    }

    private function _preHook($msg){
        if($this->_type == self::TYPE_LOG4PHP){
            return $msg;
        }
        return strtoupper($msg);
    } // _pre

    private function _afterHook(){
        if($this->_type == self::TYPE_LOG4PHP){
            return ;
        }
        call_user_func(array($this->logger, 'save'));
    } // _afterHook()

    private function _log($methodName, $msg){
        call_user_func(array($this->logger, $methodName), $this->_preHook($msg));
        $this->_afterHook();
    } // _log()

    public function info($message = '')
    {
        $this->_log('info', $message);
    }

    public function debug($message = '')
    {
        $this->_log('debug', $message);
    }

    public function error($message = '')
    {
        $this->_log('error', $message);
    }
}
