<?php

namespace Test\Service;

use PHPUnit\Framework\TestCase;
use App\Service\AppLogger;
use think\facade\Log;

/**
 * Class ProductHandlerTest
 */
class AppLoggerTest extends TestCase
{

    public function testInfoLog()
    {
        $this->_log(new AppLogger('log4php'));
        $this->_log(new AppLogger('think-log'));

    }

    private function _log($logger){
        $logger->info('This is INFO log message');
        $logger->error('This is ERROR log message');
        $logger->debug('This is DEBUG log message');
    }

}
