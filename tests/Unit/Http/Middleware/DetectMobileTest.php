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

    /**
     * Test sets field for mobile
     *
     * @return void
     */
    public function testSetsFieldForMobile()
    {
        $agent = m::mock('Jenssegers\Agent\Agent');
        $agent->shouldReceive('isMobile')->once()->andReturn(true);
        $session = m::mock('Illuminate\Contracts\Session\Session');
        $session->shouldReceive('exists')
                ->with('mobile')
                ->once()
                ->andReturn(false);
        $session->shouldReceive('put')
                ->with('mobile', true)
                ->once();
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

    /**
     * Test sets field for tablet
     *
     * @return void
     */
    public function testSetsFieldForTablet()
    {
        $agent = m::mock('Jenssegers\Agent\Agent');
        $agent->shouldReceive('isMobile')->once()->andReturn(false);
        $agent->shouldReceive('isTablet')->once()->andReturn(true);
        $session = m::mock('Illuminate\Contracts\Session\Session');
        $session->shouldReceive('exists')
                ->with('mobile')
                ->once()
                ->andReturn(false);
        $session->shouldReceive('put')
                ->with('mobile', true)
                ->once();
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

    /**
     * Test sets field for desktop
     *
     * @return void
     */
    public function testSetsFieldForDesktop()
    {
        $agent = m::mock('Jenssegers\Agent\Agent');
        $agent->shouldReceive('isMobile')->once()->andReturn(false);
        $agent->shouldReceive('isTablet')->once()->andReturn(false);
        $session = m::mock('Illuminate\Contracts\Session\Session');
        $session->shouldReceive('exists')
                ->with('mobile')
                ->once()
                ->andReturn(false);
        $session->shouldReceive('put')
                ->with('mobile', false)
                ->once();
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
