<?php

namespace Tests\Unit\Http\Middleware;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Matthewbdaly\LaravelDynamicServing\Http\Middleware\DetectMobile;
use Illuminate\Http\Request;
use Mockery as m;

class DetectMobileTest extends TestCase
{
    /**
     * Test it adds the Vary header
     *
     * @return void
     */
    public function testAddsVaryHeader()
    {
        $agent = m::mock('Jenssegers\Agent\Agent');
        $session = m::mock('Illuminate\Contracts\Session\Session');
        $session->shouldReceive('exists')
                ->with('mobile')
                ->once()
                ->andReturn(true);
        $middleware = new DetectMobile($agent, $session);
        $response = m::mock('Illuminate\Http\Response');
        $response->shouldReceive('setVary')
                 ->with('User-Agent')
                 ->once()
                 ->andReturn($response);
        $request = Request::create('http://example.com/admin', 'GET');
        $middleware->handle($request, function () use ($response) {
            return $response;
        });
    }
}
