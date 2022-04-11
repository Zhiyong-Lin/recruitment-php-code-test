<?php

namespace Test\Demo;

use PHPUnit\Framework\TestCase;

use App\App\Demo;
use App\App\HttpRequest;
use App\Service\AppLogger;

/**
 * Class DemoTest
 */
class DemoTest extends TestCase {

    private $usrInfoObj= [
        'error' => 0,
        'data' => [
            'id' => 1,
            'username' => 'hello world'
        ]
    ];

    protected function setUp(): void {
        $this->logger = new AppLogger();
        $this->stubReq = $this->createStub(HttpRequest::class);
        $this->stubReq->method('get')->willReturn(json_encode($this->usrInfoObj));
        $this->demo = new Demo($this->logger, $this->stubReq);
    } // setUp()

    public function testFoo(){
        $this->assertEquals('bar', $this->demo->foo(), 'foo will return bar');
    }

    public function testGetUserInfo(){
        $res = $this->demo->get_user_info();
        $this->assertNotNull($res);

        $this->assertArrayHasKey('id', $res);
        $this->assertArrayHasKey('username', $res);
    } // testGetUserInfo()
}
