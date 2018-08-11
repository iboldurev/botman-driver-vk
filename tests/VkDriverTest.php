<?php

namespace Tests;

use BotMan\Drivers\VK\VkDriver;
use Mockery;
use BotMan\BotMan\Http\Curl;
use PHPUnit_Framework_TestCase;
use Symfony\Component\HttpFoundation\Request;

class VkDriverTest extends PHPUnit_Framework_TestCase
{
    protected $vkConfig = [
        'vk' => [
            'token' => 'VK-TOKEN',
            'group_id' => '12345',
            'verification' => 'VK-VERIFICATION',
        ],
    ];

    public function tearDown()
    {
        Mockery::close();
    }

    private function getDriver($responseData, $htmlInterface = null)
    {
        $request = Mockery::mock(Request::class.'[getContent]');
        $request->shouldReceive('getContent')->andReturn(json_encode($responseData));

        if ($htmlInterface === null) {
            $htmlInterface = Mockery::mock(Curl::class);
        }

        return new VkDriver($request, [], $htmlInterface);
    }

    /** @test */
    public function it_returns_the_driver_name()
    {
        $driver = $this->getDriver([]);
        $this->assertSame('VK', $driver->getName());
    }
}